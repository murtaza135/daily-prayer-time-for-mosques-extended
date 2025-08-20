const IQAMAH_TIMER = 5 * 60 * 1000; /* 5 minutes */
const JAMAH_TIMER = 5 * 60 * 1000; /* 5 minutes */

function displayNotificationMessage() {
  const notificationBannerElement = document.querySelector(".dpte-notification-banner");
  const notificationTextElement = document.querySelector(".dpte-notification-banner .dpte-notification-text");

  if (!!notificationBannerElement && !!notificationTextElement) {
    const { name, jamah, diff, timeRemaining, waitingForJamah } = dptCache.getCurrentPrayer();

    if (name.toLowerCase() === "zuhr" && dptCache.isZawal()) {
      notificationBannerElement.classList.add("error");
      notificationBannerElement.classList.remove("active");
      notificationTextElement.textContent = "Zawal - Prohibited Salah Time.";
      return;
    }

    if (waitingForJamah && 0 < diff && diff <= IQAMAH_TIMER) {
      notificationBannerElement.classList.remove("error");
      notificationBannerElement.classList.add("active");
      notificationTextElement.textContent = `${name} Jama'ah in ${timeRemaining.slice(3)}`;
      return;
    }

    const jamahDiff = jamah - new Date();
    if (!waitingForJamah && -JAMAH_TIMER <= jamahDiff && jamahDiff < 0) {
      notificationBannerElement.classList.remove("error");
      notificationBannerElement.classList.add("active");
      notificationTextElement.textContent = `${name} Jama'ah Time.`;
      return;
    }
  }

  notificationBannerElement?.classList.remove("active");
  notificationBannerElement?.classList.remove("error");
}


addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    displayNotificationMessage();
    setInterval(displayNotificationMessage, 1000);
  });
});
