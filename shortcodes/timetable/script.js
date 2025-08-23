function setPrayerTimes() {
  const fajr = dptCache.getPrayer("fajr");
  const fajrStartElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-fajr .dpte-prayer-start");
  const fajrPrayerElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-fajr .dpte-prayer-prayer");
  if (!!fajr) {
    fajrStartElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(fajr.begins);
    });
    fajrPrayerElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(fajr.jamah);
    });
  }

  const sunrise = dptCache.getPrayer("sunrise");
  const sunriseElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-sunrise .dpte-prayer-start");
  if (!!sunrise) {
    sunriseElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(sunrise.begins);
    });
  }

  const zuhr = dptCache.getPrayer("zuhr");
  const zuhrStartElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-start");
  const zuhrPrayerElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-prayer");
  if (!!zuhr) {
    zuhrStartElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(zuhr.begins);
    });
    zuhrPrayerElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(zuhr.jamah);
    });
  }

  const asr = dptCache.getPrayer("asr");
  const asrStartElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-asr .dpte-prayer-start");
  const asrPrayerElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-asr .dpte-prayer-prayer");
  if (!!asr) {
    asrStartElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(asr.begins);
    });
    asrPrayerElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(asr.jamah);
    });
  }

  const maghrib = dptCache.getPrayer("maghrib");
  const maghribStartElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-maghrib .dpte-prayer-start");
  const maghribPrayerElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-maghrib .dpte-prayer-prayer");
  if (!!maghrib) {
    maghribStartElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(maghrib.begins);
    });
    maghribPrayerElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(maghrib.jamah);
    });
  }

  const isha = dptCache.getPrayer("isha");
  const ishaStartElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-isha .dpte-prayer-start");
  const ishaPrayerElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-isha .dpte-prayer-prayer");
  if (!!isha) {
    ishaStartElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(isha.begins);
    });
    ishaPrayerElement.forEach((element) => {
      element.textContent = DateTimeUtils.formatDateToTime(isha.jamah);
    });
  }

  const jumah = dptCache.data.jumah;
  const jumahElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-jumah .dpte-prayer-start");
  if (!!jumah && jumah.length > 0) {
    const jumahText = jumah.join(" | ");
    jumahElement.forEach((element) => {
      element.textContent = jumahText;
    });
  }
}

function getPrayerElement(prayer) {
  if (!prayer) return [];
  const prayerName = prayer.toLowerCase();
  if (prayerName === "fajr") return document.querySelectorAll(".dpte-timetable .dpte-timetable-fajr");
  if (prayerName === "sunrise") return document.querySelectorAll(".dpte-timetable .dpte-timetable-sunrise");
  if (prayerName === "zuhr") return document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr");
  if (prayerName === "asr") return document.querySelectorAll(".dpte-timetable .dpte-timetable-asr");
  if (prayerName === "maghrib") return document.querySelectorAll(".dpte-timetable .dpte-timetable-maghrib");
  if (prayerName === "isha") return document.querySelectorAll(".dpte-timetable .dpte-timetable-isha");
  return [];
}

function setActivePrayer() {
  const currentPrayer = dptCache.getCurrentPrayer();
  if (!currentPrayer) return;
  const currentPrayerElement = getPrayerElement(currentPrayer.name);

  const fajrElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-fajr");
  const sunriseElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-sunrise");
  const zuhrElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr");
  const asrElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-asr");
  const maghribElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-maghrib");
  const ishaElement = document.querySelectorAll(".dpte-timetable .dpte-timetable-isha");

  fajrElement.forEach((element) => element.classList.remove("active"));
  sunriseElement.forEach((element) => element.classList.remove("active"));
  zuhrElement.forEach((element) => element.classList.remove("active"));
  asrElement.forEach((element) => element.classList.remove("active"));
  maghribElement.forEach((element) => element.classList.remove("active"));
  ishaElement.forEach((element) => element.classList.remove("active"));

  currentPrayerElement.forEach((element) => {
    element.classList.add("active");
  });
}

function setJumah() {
  const zuhrPrayerTitle = document.querySelectorAll(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
  const isFriday = new Date().getDay() === 5;
  zuhrPrayerTitle.forEach((element) => {
    element.textContent = isFriday ? "Jumu'ah" : "Zuhr";
  });
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    setPrayerTimes();
    setTimeout(setPrayerTimes, 1000);
    setTimeout(setPrayerTimes, 2500);
    setInterval(setPrayerTimes, 5 * 60 * 1000 /* 5 minute */);

    setActivePrayer();
    setTimeout(setActivePrayer, 1000);
    setTimeout(setActivePrayer, 2500);
    setInterval(setActivePrayer, 1 * 60 * 1000 /* 1 minute */);
  });

  setJumah();
  setTimeout(setJumah, 1000);
  setTimeout(setJumah, 2500);
  setInterval(setJumah, 15 * 60 * 1000 /* 15 minutes */);
});
