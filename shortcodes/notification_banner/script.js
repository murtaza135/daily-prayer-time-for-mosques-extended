class NotificationBanner {
  static parseTimerIntoMilliseconds(timer, fallback) {
    const timerNumber = Number(timer);
    const timerValidated = !Number.isNaN(timerNumber) ? timerNumber : fallback;
    const timerInMilliseconds = timerValidated * 60 * 1000;
    return timerInMilliseconds;
  }

  static isMorningMakroohTime(prayer) {
    if (!prayer) return false;
    if (prayer.name.toLowerCase() !== "sunrise") return false;
    const now = new Date();
    const diff = now - prayer.begins;
    const morningMakroohTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.MORNING_MAKROOH_TIMER);
    return 0 < diff && diff <= morningMakroohTimer;
  }

  static isZawal(prayer) {
    if (!prayer) return false;
    if (prayer.name.toLowerCase() !== "sunrise") return false;
    const now = new Date();
    const diff = prayer.end - now;
    const zawalMakroohTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.ZAWAL_MAKROOH_TIMER);
    return 0 < diff && diff <= zawalMakroohTimer;
  }

  static isEveningMakroohTime(prayer) {
    if (!prayer) return false;
    if (prayer.name.toLowerCase() !== "asr") return false;
    const now = new Date();
    const diff = prayer.end - now;
    const eveningMakroohTimer = NotificationBanner.parseTimerIntoMilliseconds(DPTENotificationBannerOptions.EVENING_MAKROOH_TIMER);
    return 0 < diff && diff <= eveningMakroohTimer;
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
      if (!prayer) return;
      const { name, jamah, diff, timeRemaining, waitingForJamah } = prayer;

      if (NotificationBanner.isMorningMakroohTime(prayer)) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.morningMakroohTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            const message = (element.dataset.morningMakroohTimerMessage ?? "").replaceAll("{{timer}}", timeRemaining.slice(3));
            if (!!textElement) textElement.textContent = message;
            NotificationBanner.setNotificationState(element, "error");
          } else {
            NotificationBanner.setDefaultMessage(element, prayer);
          }
        });
        return;
      }

      if (NotificationBanner.isZawal(prayer)) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.zawalMakroohTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            const message = (element.dataset.zawalMakroohTimerMessage ?? "").replaceAll("{{timer}}", timeRemaining.slice(3));
            if (!!textElement) textElement.textContent = message;
            NotificationBanner.setNotificationState(element, "error");
          } else {
            NotificationBanner.setDefaultMessage(element, prayer);
          }
        });
        return;
      }

      if (NotificationBanner.isEveningMakroohTime(prayer)) {
        notificationBannerElement.forEach((element) => {
          if (element.dataset.eveningMakroohTimerActive === "true") {
            const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
            const message = (element.dataset.eveningMakroohTimerMessage ?? "").replaceAll("{{timer}}", timeRemaining.slice(3));
            if (!!textElement) textElement.textContent = message;
            NotificationBanner.setNotificationState(element, "error");
          } else {
            NotificationBanner.setDefaultMessage(element, prayer);
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
            NotificationBanner.setDefaultMessage(element, prayer);
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
            NotificationBanner.setDefaultMessage(element, prayer);
          }
        });
        return;
      }

      notificationBannerElement.forEach((element) => {
        NotificationBanner.setDefaultMessage(element, prayer);
      });
    }
  }

  static setDefaultMessage(element, prayer) {
    const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
    if (!!textElement) {
      if (element.dataset.defaultMessageType === "message") {
        textElement.textContent = element.dataset.defaultMessage;
      } else if (element.dataset.defaultMessageType === "timer") {
        if (prayer.waitingForJamah) {
          // TODO if jumah, only show "Jumu'ah", not "Jumu'ah Jama'ah"?
          textElement.textContent = `${prayer.name} Jama'ah in ${prayer.timeRemaining}`;
        } else {
          const nextPrayerName = dptCache.getNextPrayerName(prayer.name);
          const nextPrayerNameCapitalised = nextPrayerName.charAt(0).toUpperCase() + nextPrayerName.slice(1);
          textElement.textContent = `${nextPrayerNameCapitalised} starts in ${prayer.timeRemaining}`;
        }
      } else {
        textElement.textContent = "Welcome.";
      }
      NotificationBanner.setNotificationState(element, "active");
    } else {
      NotificationBanner.setNotificationState(element, "hidden");
    }
  }

  static displayDailyMessage() {
    const prayer = dptCache.getCurrentPrayer();
    if (NotificationBanner.isMorningMakroohTime(prayer)) return false;
    if (NotificationBanner.isZawal(prayer)) return false;
    if (NotificationBanner.isEveningMakroohTime(prayer)) return false;
    const dayNumber = new Date().getDate();
    const message = DPTENotificationBannerOptions.DAILY_MESSAGES[dayNumber] ?? "";
    if (!message) return false;

    const notificationBannerElement = document.querySelectorAll(".dpte-notification-banner");
    let result = false;
    notificationBannerElement.forEach((element) => {
      const textElement = element.querySelector(".dpte-notification-banner .dpte-notification-text");
      if (!textElement) return;
      textElement.textContent = message;
      result = true;
    });

    return result;
  }
}

addEventListener("DOMContentLoaded", () => {
  const currentDisplay = { value: "notificationMessage", interval: 0 };

  dptCache.ensurePrayerData().then(() => {
    function setDisplay() {
      currentDisplay.interval++;
      if (currentDisplay.interval === 10) {
        currentDisplay.interval = 0;
        if (currentDisplay.value === "dailyMessage") {
          currentDisplay.value = "notificationMessage";
        } else {
          currentDisplay.value = "dailyMessage";
        }
      }

      if (currentDisplay.value === "notificationMessage") {
        NotificationBanner.displayNotificationMessage();
      } else {
        const result = NotificationBanner.displayDailyMessage();
        if (!result) NotificationBanner.displayNotificationMessage();
      }
    }

    NotificationBanner.displayNotificationMessage();
    setInterval(setDisplay, 1000);
  });
});
