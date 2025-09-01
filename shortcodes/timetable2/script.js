class Timetable2 {
  static setPrayerTimes() {
    ["today", "tomorrow", "next"].forEach((timeType) => {
      const rootTimetableElement = document.querySelectorAll(`.dpte-timetable2[data-timetype="${timeType}"]`);

      rootTimetableElement.forEach((root) => {
        const fajr = dptCache.getPrayer("fajr", timeType);
        const fajrStartElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-fajr .dpte-prayer-start");
        const fajrPrayerElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-fajr .dpte-prayer-prayer");
        if (!!fajr && !!fajrStartElement && !!fajrPrayerElement) {
          fajrStartElement.textContent = DateTimeUtils.formatDateToTime(fajr.begins);
          fajrPrayerElement.textContent = DateTimeUtils.formatDateToTime(fajr.jamah);
        }

        const sunrise = dptCache.getPrayer("sunrise", timeType);
        const sunriseElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-sunrise .dpte-prayer-prayer");
        if (!!sunrise && !!sunriseElement) {
          sunriseElement.textContent = DateTimeUtils.formatDateToTime(sunrise.begins);
        }

        const zuhr = dptCache.getPrayer("zuhr", timeType);
        const zuhrStartElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-zuhr .dpte-prayer-start");
        const zuhrPrayerElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-zuhr .dpte-prayer-prayer");
        if (!!zuhr && !!zuhrStartElement && !!zuhrPrayerElement) {
          zuhrStartElement.textContent = DateTimeUtils.formatDateToTime(zuhr.begins);
          zuhrPrayerElement.textContent = DateTimeUtils.formatDateToTime(zuhr.jamah);
        }

        const asr = dptCache.getPrayer("asr", timeType);
        const asrStartElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-asr .dpte-prayer-start");
        const asrPrayerElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-asr .dpte-prayer-prayer");
        if (!!asr && !!asrStartElement && !!asrPrayerElement) {
          asrStartElement.textContent = DateTimeUtils.formatDateToTime(asr.begins);
          asrPrayerElement.textContent = DateTimeUtils.formatDateToTime(asr.jamah);
        }

        const maghrib = dptCache.getPrayer("maghrib", timeType);
        const maghribStartElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-maghrib .dpte-prayer-start");
        const maghribPrayerElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-maghrib .dpte-prayer-prayer");
        if (!!maghrib && !!maghribStartElement && !!maghribPrayerElement) {
          maghribStartElement.textContent = DateTimeUtils.formatDateToTime(maghrib.begins);
          maghribPrayerElement.textContent = DateTimeUtils.formatDateToTime(maghrib.jamah);
        }

        const isha = dptCache.getPrayer("isha", timeType);
        const ishaStartElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-isha .dpte-prayer-start");
        const ishaPrayerElement = root.querySelector(".dpte-timetable2 .dpte-timetable2-isha .dpte-prayer-prayer");
        if (!!isha && !!ishaStartElement && !!ishaPrayerElement) {
          ishaStartElement.textContent = DateTimeUtils.formatDateToTime(isha.begins);
          ishaPrayerElement.textContent = DateTimeUtils.formatDateToTime(isha.jamah);
        }
      });
    });
  }

  static getPrayerElement(prayer) {
    if (!prayer) return [];
    const prayerName = prayer.toLowerCase();
    if (prayerName === "fajr") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-fajr");
    if (prayerName === "sunrise") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-sunrise");
    if (prayerName === "zuhr") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-zuhr");
    if (prayerName === "asr") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-asr");
    if (prayerName === "maghrib") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-maghrib");
    if (prayerName === "isha") return document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-isha");
    return [];
  }

  static setActivePrayer() {
    const currentPrayer = dptCache.getCurrentPrayer();
    if (!currentPrayer) return;
    const currentPrayerElement = Timetable2.getPrayerElement(currentPrayer.name);

    const fajrElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-fajr");
    const sunriseElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-sunrise");
    const zuhrElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-zuhr");
    const asrElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-asr");
    const maghribElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-maghrib");
    const ishaElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-isha");

    fajrElement.forEach((element) => element.classList.remove("active"));
    sunriseElement.forEach((element) => element.classList.remove("active"));
    zuhrElement.forEach((element) => element.classList.remove("active"));
    asrElement.forEach((element) => element.classList.remove("active"));
    maghribElement.forEach((element) => element.classList.remove("active"));
    ishaElement.forEach((element) => element.classList.remove("active"));

    currentPrayerElement.forEach((element) => {
      if (element.dataset.timetype === "next" || element.dataset.timetype === "today") {
        element.classList.add("active");
      }
    });
  }

  static setJumah() {
    const zuhrPrayerTitle = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-zuhr .dpte-prayer-title");
    const isFriday = new Date().getDay() === 5;
    zuhrPrayerTitle.forEach((element) => {
      element.textContent = isFriday ? "Jumu'ah" : "Zuhr";
    });
  }

  static setTime() {
    const now = new Date();
    const timeElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-time");
    const timeString = DateTimeUtils.formatDateToTime(now);
    timeElement.forEach((element) => {
      element.textContent = timeString;
    });
  }

  static setDate() {
    const now = new Date();

    const dateElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-date");
    // TODO change to same type of code in timetable_date shortcode, and move into DateTimeUtils
    const dateStringParts = now.toLocaleDateString("en-GB", { weekday: "long", day: "numeric", month: "long", year: "numeric" }).split(" ");
    const dateString = `${dateStringParts[0]} ${DateTimeUtils.addOrdinalSuffix(dateStringParts[1])} ${dateStringParts[2]} ${dateStringParts[3]}`;
    dateElement.forEach((element) => {
      element.textContent = dateString;
    });
  }

  static setTimeRemaining() {
    const currentPrayer = dptCache.getCurrentPrayer();
    const nextPrayerNameElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-next-prayer-name");
    const nextPrayerRemainingTimeElement = document.querySelectorAll(".dpte-timetable2 .dpte-timetable2-next-prayer-remaining-time");

    if (!currentPrayer) {
      nextPrayerNameElement.forEach((element) => {
        element.textContent = "Time to Salah ...";
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = "";
      });
    } else if (currentPrayer.waitingForJamah) {
      nextPrayerNameElement.forEach((element) => {
        element.textContent = `${currentPrayer.name} Jama'ah in ...`;
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = currentPrayer.timeRemaining;
      });
    } else {
      nextPrayerNameElement.forEach((element) => {
        const nextPrayerName = dptCache.getNextPrayerName(currentPrayer.name);
        const nextPrayerNameCapitalised = nextPrayerName.charAt(0).toUpperCase() + nextPrayerName.slice(1);
        element.textContent = `Time to ${nextPrayerNameCapitalised} ...`;
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = currentPrayer.timeRemaining;
      });
    }
  }
}


addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    Timetable2.setPrayerTimes();
    setTimeout(Timetable2.setPrayerTimes, 1000);
    setTimeout(Timetable2.setPrayerTimes, 2500);
    setInterval(Timetable2.setPrayerTimes, 5 * 60 * 1000 /* 5 minute */);

    Timetable2.setActivePrayer();
    setTimeout(Timetable2.setActivePrayer, 1000);
    setTimeout(Timetable2.setActivePrayer, 2500);
    setInterval(Timetable2.setActivePrayer, 1 * 60 * 1000 /* 1 minute */);

    Timetable2.setTimeRemaining();
    setInterval(Timetable2.setTimeRemaining, 1000);

    Timetable2.setJumah();
    setTimeout(Timetable2.setJumah, 1000);
    setTimeout(Timetable2.setJumah, 2500);
    setInterval(Timetable2.setJumah, 15 * 60 * 1000 /* 15 minutes */);

    Timetable2.setDate();
    setTimeout(Timetable2.setDate, 1000);
    setTimeout(Timetable2.setDate, 2500);
    setInterval(Timetable2.setDate, 1 * 60 * 1000 /* 1 minute */);

    Timetable2.setTime();
    setInterval(Timetable2.setTime, 1000);
  });
});
