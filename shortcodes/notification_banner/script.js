class NotificationBanner {
  static parseTimerIntoMilliseconds(timer, fallback) {
    const timerNumber = Number(timer);
    const timerValidated = !Number.isNaN(timerNumber) ? timerNumber : fallback;
    const timerInMilliseconds = timerValidated * 60 * 1000;
    return timerInMilliseconds;
  }

  static isZawal(prayer) {
    if (!prayer) return false;
    if (prayer.name.toLowerCase() !== "sunrise") return false;
    const now = new Date();
    const diff = prayer.end - now;
    const zawalTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.ZAWAL_TIMER);
    return 0 < diff && diff <= zawalTimer;
  }

  static setNotificationState(element, state) {
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

  static displayNotificationMessage() {
    const notificationBannerElement = document.querySelectorAll(".dpte-notification-banner");

    if (notificationBannerElement.length > 0) {
      const prayer = dptCache.getCurrentPrayer();
      const { name, jamah, diff, timeRemaining, waitingForJamah } = prayer;

      if (NotificationBanner.isZawal(prayer)) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.zawalTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            if (!!textElement) textElement.textContent = "Zawal - Prohibited Salah Time.";
            NotificationBanner.setNotificationState(element, "error");
          } else {
            NotificationBanner.setNotificationState(element, "hidden");
          }
        });
        return;
      }

      const iqamahTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.IQAMAH_TIMER);
      if (waitingForJamah && 0 < diff && diff <= iqamahTimer) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.iqamahTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            if (!!textElement) textElement.textContent = `${name} Jama'ah in ${timeRemaining.slice(3)}`;
            NotificationBanner.setNotificationState(element, "active");
          } else {
            NotificationBanner.setNotificationState(element, "hidden");
          }
        });
        return;
      }

      const jamahTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.JAMAH_TIMER);
      const jamahDiff = jamah - new Date();
      if (!waitingForJamah && -jamahTimer <= jamahDiff && jamahDiff < 0) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.jamahTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            if (!!textElement) textElement.textContent = `${name} Jama'ah Time.`;
            NotificationBanner.setNotificationState(element, "active");
          } else {
            NotificationBanner.setNotificationState(element, "hidden");
          }
        });
        return;
      }
    }

    notificationBannerElement.forEach((element) => {
      NotificationBanner.setNotificationState(element, "hidden");
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    NotificationBanner.displayNotificationMessage();
    setInterval(NotificationBanner.displayNotificationMessage, 1000);
  });
});
