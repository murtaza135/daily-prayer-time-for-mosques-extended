class Timetable2PrayerTimeComponent {
  static setPrayerTimes() {
    ["today", "tomorrow", "next"].forEach((timeType) => {
      const rootTimetableElement = document.querySelectorAll(`.dpte-timetable2-prayer-time-component[data-timetype="${timeType}"]`);

      rootTimetableElement.forEach((root) => {
        const fajr = dptCache.getPrayer("fajr", timeType);
        const fajrStartElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-fajr .dpte-prayer-start");
        const fajrPrayerElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-fajr .dpte-prayer-prayer");
        if (!!fajr && !!fajrStartElement && !!fajrPrayerElement) {
          fajrStartElement.textContent = DateTimeUtils.formatDateToTime(fajr.begins);
          fajrPrayerElement.textContent = DateTimeUtils.formatDateToTime(fajr.jamah);
        }

        const sunrise = dptCache.getPrayer("sunrise", timeType);
        const sunriseElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-sunrise .dpte-prayer-prayer");
        if (!!sunrise && !!sunriseElement) {
          sunriseElement.textContent = DateTimeUtils.formatDateToTime(sunrise.begins);
        }

        const zuhr = dptCache.getPrayer("zuhr", timeType);
        const zuhrStartElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-zuhr .dpte-prayer-start");
        const zuhrPrayerElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-zuhr .dpte-prayer-prayer");
        const zuhrPrayerTitle = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable-zuhr .dpte-prayer-title");
        if (!!zuhr && !!zuhrStartElement && !!zuhrPrayerElement) {
          zuhrStartElement.textContent = DateTimeUtils.formatDateToTime(zuhr.begins);
          zuhrPrayerElement.textContent = DateTimeUtils.formatDateToTime(zuhr.jamah);
          if (!!zuhrPrayerTitle) zuhrPrayerTitle.textContent = zuhr.name;
        }

        const asr = dptCache.getPrayer("asr", timeType);
        const asrStartElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-asr .dpte-prayer-start");
        const asrPrayerElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-asr .dpte-prayer-prayer");
        if (!!asr && !!asrStartElement && !!asrPrayerElement) {
          asrStartElement.textContent = DateTimeUtils.formatDateToTime(asr.begins);
          asrPrayerElement.textContent = DateTimeUtils.formatDateToTime(asr.jamah);
        }

        const maghrib = dptCache.getPrayer("maghrib", timeType);
        const maghribStartElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-maghrib .dpte-prayer-start");
        const maghribPrayerElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-maghrib .dpte-prayer-prayer");
        if (!!maghrib && !!maghribStartElement && !!maghribPrayerElement) {
          maghribStartElement.textContent = DateTimeUtils.formatDateToTime(maghrib.begins);
          maghribPrayerElement.textContent = DateTimeUtils.formatDateToTime(maghrib.jamah);
        }

        const isha = dptCache.getPrayer("isha", timeType);
        const ishaStartElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-isha .dpte-prayer-start");
        const ishaPrayerElement = root.querySelector(".dpte-timetable2-prayer-time-component .dpte-timetable2-isha .dpte-prayer-prayer");
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
    if (prayerName === "fajr") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-fajr");
    if (prayerName === "sunrise") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-sunrise");
    if (prayerName === "zuhr") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-zuhr");
    if (prayerName === "asr") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-asr");
    if (prayerName === "maghrib") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-maghrib");
    if (prayerName === "isha") return document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-isha");
    return [];
  }

  static setActivePrayer() {
    const currentPrayer = dptCache.getCurrentPrayer();
    if (!currentPrayer) return;
    const currentPrayerElement = Timetable2PrayerTimeComponent.getPrayerElement(currentPrayer.name);
    const allPrayerElements = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-prayer");

    const fajrElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-fajr");
    const sunriseElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-sunrise");
    const zuhrElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-zuhr");
    const asrElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-asr");
    const maghribElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-maghrib");
    const ishaElement = document.querySelectorAll(".dpte-timetable2-prayer-time-component .dpte-timetable2-isha");

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

    allPrayerElements.forEach((element) => {
      if (element.dataset.alwaysactive === "true") {
        element.classList.add("active");
      }
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    Timetable2PrayerTimeComponent.setPrayerTimes();
    setTimeout(Timetable2PrayerTimeComponent.setPrayerTimes, 1000);
    setTimeout(Timetable2PrayerTimeComponent.setPrayerTimes, 2500);
    setInterval(Timetable2PrayerTimeComponent.setPrayerTimes, 5 * 60 * 1000 /* 5 minute */);

    Timetable2PrayerTimeComponent.setActivePrayer();
    setTimeout(Timetable2PrayerTimeComponent.setActivePrayer, 1000);
    setTimeout(Timetable2PrayerTimeComponent.setActivePrayer, 2500);
    setInterval(Timetable2PrayerTimeComponent.setActivePrayer, 1 * 60 * 1000 /* 1 minute */);
  });
});
