class TimetableComponents {
  static setPrayerTimes() {
    ["today", "tomorrow", "next"].forEach((timeType) => {
      const rootTimetableElement = document.querySelectorAll(`.dpte-timetable-prayer-time-component[data-timetype="${timeType}"]`);

      rootTimetableElement.forEach((root) => {
        const fajr = dptCache.getPrayer("fajr", timeType);
        const fajrStartElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-fajr .dpte-prayer-start");
        const fajrPrayerElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-fajr .dpte-prayer-prayer");
        if (!!fajr && !!fajrStartElement && !!fajrPrayerElement) {
          fajrStartElement.textContent = DateTimeUtils.formatDateToTime(fajr.begins);
          fajrPrayerElement.textContent = DateTimeUtils.formatDateToTime(fajr.jamah);
        }

        const sunrise = dptCache.getPrayer("sunrise", timeType);
        const sunriseElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-sunrise .dpte-prayer-start");
        if (!!sunrise && !!sunriseElement) {
          sunriseElement.textContent = DateTimeUtils.formatDateToTime(sunrise.begins);
        }

        const zuhr = dptCache.getPrayer("zuhr", timeType);
        const zuhrStartElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-zuhr .dpte-prayer-start");
        const zuhrPrayerElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-zuhr .dpte-prayer-prayer");
        if (!!zuhr && !!zuhrStartElement && !!zuhrPrayerElement) {
          zuhrStartElement.textContent = DateTimeUtils.formatDateToTime(zuhr.begins);
          zuhrPrayerElement.textContent = DateTimeUtils.formatDateToTime(zuhr.jamah);
        }

        const asr = dptCache.getPrayer("asr", timeType);
        const asrStartElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-asr .dpte-prayer-start");
        const asrPrayerElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-asr .dpte-prayer-prayer");
        if (!!asr && !!asrStartElement && !!asrPrayerElement) {
          asrStartElement.textContent = DateTimeUtils.formatDateToTime(asr.begins);
          asrPrayerElement.textContent = DateTimeUtils.formatDateToTime(asr.jamah);
        }

        const maghrib = dptCache.getPrayer("maghrib", timeType);
        const maghribStartElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-maghrib .dpte-prayer-start");
        const maghribPrayerElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-maghrib .dpte-prayer-prayer");
        if (!!maghrib && !!maghribStartElement && !!maghribPrayerElement) {
          maghribStartElement.textContent = DateTimeUtils.formatDateToTime(maghrib.begins);
          maghribPrayerElement.textContent = DateTimeUtils.formatDateToTime(maghrib.jamah);
        }

        const isha = dptCache.getPrayer("isha", timeType);
        const ishaStartElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-isha .dpte-prayer-start");
        const ishaPrayerElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-isha .dpte-prayer-prayer");
        if (!!isha && !!ishaStartElement && !!ishaPrayerElement) {
          ishaStartElement.textContent = DateTimeUtils.formatDateToTime(isha.begins);
          ishaPrayerElement.textContent = DateTimeUtils.formatDateToTime(isha.jamah);
        }

        const jumah = dptCache.data.jumah;
        const jumahElement = root.querySelector(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-jumah .dpte-prayer-start");
        if (!!jumah && jumah.length > 0 && !!jumahElement) {
          const jumahText = jumah.join(" & ");
          jumahElement.textContent = jumahText;
        }
      });
    });
  }

  static getPrayerElement(prayer) {
    if (!prayer) return [];
    const prayerName = prayer.toLowerCase();
    if (prayerName === "fajr") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-fajr");
    if (prayerName === "sunrise") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-sunrise");
    if (prayerName === "zuhr") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-zuhr");
    if (prayerName === "asr") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-asr");
    if (prayerName === "maghrib") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-maghrib");
    if (prayerName === "isha") return document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-isha");
    return [];
  }

  static setActivePrayer() {
    const currentPrayer = dptCache.getCurrentPrayer();
    if (!currentPrayer) return;
    const currentPrayerElement = Timetable.getPrayerElement(currentPrayer.name);

    const fajrElement = document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-fajr");
    const sunriseElement = document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-sunrise");
    const zuhrElement = document.querySelectorAll(".dpte-timetable-prayer-time-componen.dpte-timetable-prayer-time-component-zuhr");
    const asrElement = document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-asr");
    const maghribElement = document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-maghrib");
    const ishaElement = document.querySelectorAll(".dpte-timetable-prayer-time-component.dpte-timetable-prayer-time-component-isha");

    fajrElement.forEach((element) => element.classList.remove("active"));
    sunriseElement.forEach((element) => element.classList.remove("active"));
    zuhrElement.forEach((element) => element.classList.remove("active"));
    asrElement.forEach((element) => element.classList.remove("active"));
    maghribElement.forEach((element) => element.classList.remove("active"));
    ishaElement.forEach((element) => element.classList.remove("active"));

    currentPrayerElement.forEach((element) => {
      if (currentPrayer.name.toLowerCase() !== "sunrise") {
        element.classList.add("active");
      }
    });
  }

  static setJumah() {
    const zuhrPrayerTitle = document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
    const isFriday = new Date().getDay() === 5;
    zuhrPrayerTitle.forEach((element) => {
      element.textContent = isFriday ? "Jumu'ah" : "Zuhr";
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    TimetableComponents.setPrayerTimes();
    setTimeout(TimetableComponents.setPrayerTimes, 1000);
    setTimeout(TimetableComponents.setPrayerTimes, 2500);
    setInterval(TimetableComponents.setPrayerTimes, 5 * 60 * 1000 /* 5 minute */);

    TimetableComponents.setActivePrayer();
    setTimeout(TimetableComponents.setActivePrayer, 1000);
    setTimeout(TimetableComponents.setActivePrayer, 2500);
    setInterval(TimetableComponents.setActivePrayer, 1 * 60 * 1000 /* 1 minute */);
  });

  TimetableComponents.setJumah();
  setTimeout(TimetableComponents.setJumah, 1000);
  setTimeout(TimetableComponents.setJumah, 2500);
  setInterval(TimetableComponents.setJumah, 15 * 60 * 1000 /* 15 minutes */);
});
