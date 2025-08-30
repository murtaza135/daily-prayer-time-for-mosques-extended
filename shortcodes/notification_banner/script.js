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

function setNotificationState(element, state) {
  switch (state) {
    case "active":
      element.classList.remove("error");
      element.classList.add("active");
      break;
    case "error":
      element.classList.remove("active");
      element.classList.add("error");
      break;
    case "hidden":
      element.classList.remove("active");
      element.classList.remove("error");
      break;
    default:
      break;
  }
}

function displayNotificationMessage() {
  const notificationBannerElement = document.querySelectorAll(".dpte-notification-banner");

  if (notificationBannerElement.length > 0) {
    const prayer = dptCache.getCurrentPrayer();
    const { name, jamah, diff, timeRemaining, waitingForJamah } = prayer;

    if (isZawal(prayer)) {
      notificationBannerElement.forEach((element) => {
        if (element.dataset.zawaltimer === "true") {
          const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
          if (!!textElement) textElement.textContent = "Zawal - Prohibited Salah Time.";
          setNotificationState(element, "error");
        } else {
          setNotificationState(element, "hidden");
        }
      });
      return;
    }

    const iqamahTimer = parseTimerIntoMilliseconds(DPTENotificationBannerOptions.IQAMAH_TIMER);
    if (waitingForJamah && 0 < diff && diff <= iqamahTimer) {
      notificationBannerElement.forEach((element) => {
        if (element.dataset.iqamahtimer === "true") {
          const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
          if (!!textElement) textElement.textContent = `${name} Jama'ah in ${timeRemaining.slice(3)}`;
          setNotificationState(element, "active");
        } else {
          setNotificationState(element, "hidden");
        }
      });
      return;
    }

    const jamahTimer = parseTimerIntoMilliseconds(DPTENotificationBannerOptions.JAMAH_TIMER);
    const jamahDiff = jamah - new Date();
    if (!waitingForJamah && -jamahTimer <= jamahDiff && jamahDiff < 0) {
      notificationBannerElement.forEach((element) => {
        if (element.dataset.jamahtimer === "true") {
          const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
          if (!!textElement) textElement.textContent = `${name} Jama'ah Time.`;
          setNotificationState(element, "active");
        } else {
          setNotificationState(element, "hidden");
        }
      });
      return;
    }
  }

  notificationBannerElement.forEach((element) => {
    setNotificationState(element, "hidden");
  });
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    displayNotificationMessage();
    setInterval(displayNotificationMessage, 1000);
  });
});
