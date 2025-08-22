function parseTimerIntoMilliseconds(timer, fallback) {
  const timerNumber = Number(timer);
  const timerValidated = !Number.isNaN(timerNumber) ? timerNumber : fallback;
  const timerInMilliseconds = timerValidated * 60 * 1000;
  return timerInMilliseconds;
}

function isZawal(prayer) {
  if (!prayer) return false;
  if (prayer.name.toLowerCase() !== "zuhr") return false;
  const now = new Date();
  const diff = prayer.begins - now;
  const zawalTimer = parseTimerIntoMilliseconds(DPTENotificationBannerOptions.ZAWAL_TIMER);
  return 0 < diff && diff <= zawalTimer;
}

function displayNotificationMessage() {
  const notificationBannerElement = document.querySelector(".dpte-notification-banner");
  const notificationTextElement = document.querySelector(".dpte-notification-banner .dpte-notification-text");

  if (!!notificationBannerElement && !!notificationTextElement) {
    const prayer = dptCache.getCurrentPrayer();
    const { name, jamah, diff, timeRemaining, waitingForJamah } = prayer;

    if (isZawal(prayer)) {
      notificationBannerElement.classList.add("error");
      notificationBannerElement.classList.remove("active");
      notificationTextElement.textContent = "Zawal - Prohibited Salah Time.";
      return;
    }

    const iqamahTimer = parseTimerIntoMilliseconds(DPTENotificationBannerOptions.IQAMAH_TIMER);
    if (waitingForJamah && 0 < diff && diff <= iqamahTimer) {
      notificationBannerElement.classList.remove("error");
      notificationBannerElement.classList.add("active");
      notificationTextElement.textContent = `${name} Jama'ah in ${timeRemaining.slice(3)}`;
      return;
    }

    const jamahTimer = parseTimerIntoMilliseconds(DPTENotificationBannerOptions.JAMAH_TIMER);
    const jamahDiff = jamah - new Date();
    if (!waitingForJamah && -jamahTimer <= jamahDiff && jamahDiff < 0) {
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
