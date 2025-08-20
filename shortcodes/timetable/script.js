function setPrayerTimes() {
  const fajr = dptCache.getPrayer("fajr");
  const fajrStartElement = document.querySelector(".dpte-timetable .dpte-timetable-fajr .dpte-prayer-start");
  const fajrPrayerElement = document.querySelector(".dpte-timetable .dpte-timetable-fajr .dpte-prayer-prayer");
  if (!!fajr && !!fajrStartElement && !!fajrPrayerElement) {
    fajrStartElement.textContent = DateTimeUtils.formatDateToTime(fajr.begins);
    fajrPrayerElement.textContent = DateTimeUtils.formatDateToTime(fajr.jamah);
  }

  const sunrise = dptCache.getPrayer("sunrise");
  const sunriseElement = document.querySelector(".dpte-timetable .dpte-timetable-sunrise .dpte-prayer-start");
  if (!!sunrise && !!sunriseElement) {
    sunriseElement.textContent = DateTimeUtils.formatDateToTime(sunrise.begins);
  }

  const zuhr = dptCache.getPrayer("zuhr");
  const zuhrStartElement = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-start");
  const zuhrPrayerElement = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-prayer");
  if (!!zuhr && !!zuhrStartElement && !!zuhrPrayerElement) {
    zuhrStartElement.textContent = DateTimeUtils.formatDateToTime(zuhr.begins);
    zuhrPrayerElement.textContent = DateTimeUtils.formatDateToTime(zuhr.jamah);
  }

  const asr = dptCache.getPrayer("asr");
  const asrStartElement = document.querySelector(".dpte-timetable .dpte-timetable-asr .dpte-prayer-start");
  const asrPrayerElement = document.querySelector(".dpte-timetable .dpte-timetable-asr .dpte-prayer-prayer");
  if (!!asr && !!asrStartElement && !!asrPrayerElement) {
    asrStartElement.textContent = DateTimeUtils.formatDateToTime(asr.begins);
    asrPrayerElement.textContent = DateTimeUtils.formatDateToTime(asr.jamah);
  }

  const maghrib = dptCache.getPrayer("maghrib");
  const maghribStartElement = document.querySelector(".dpte-timetable .dpte-timetable-maghrib .dpte-prayer-start");
  const maghribPrayerElement = document.querySelector(".dpte-timetable .dpte-timetable-maghrib .dpte-prayer-prayer");
  if (!!maghrib && !!maghribStartElement && !!maghribPrayerElement) {
    maghribStartElement.textContent = DateTimeUtils.formatDateToTime(maghrib.begins);
    maghribPrayerElement.textContent = DateTimeUtils.formatDateToTime(maghrib.jamah);
  }

  const isha = dptCache.getPrayer("isha");
  const ishaStartElement = document.querySelector(".dpte-timetable .dpte-timetable-isha .dpte-prayer-start");
  const ishaPrayerElement = document.querySelector(".dpte-timetable .dpte-timetable-isha .dpte-prayer-prayer");
  if (!!isha && !!ishaStartElement && !!ishaPrayerElement) {
    ishaStartElement.textContent = DateTimeUtils.formatDateToTime(isha.begins);
    ishaPrayerElement.textContent = DateTimeUtils.formatDateToTime(isha.jamah);
  }

  const jumah = dptCache.data.jumah;
  const jumahElement = document.querySelector(".dpte-timetable .dpte-timetable-jumah .dpte-prayer-start");
  if (!!jumah && jumah.length > 0 && !!jumahElement) {
    jumahElement.textContent = jumah.join(" | ");
  }
}

function getPrayerElement(prayer) {
  if (!prayer) return null;
  const prayerName = prayer.toLowerCase();
  if (prayerName === "fajr") return document.querySelector(".dpte-timetable .dpte-timetable-fajr");
  if (prayerName === "sunrise") return document.querySelector(".dpte-timetable .dpte-timetable-sunrise");
  if (prayerName === "zuhr") return document.querySelector(".dpte-timetable .dpte-timetable-zuhr");
  if (prayerName === "asr") return document.querySelector(".dpte-timetable .dpte-timetable-asr");
  if (prayerName === "maghrib") return document.querySelector(".dpte-timetable .dpte-timetable-maghrib");
  if (prayerName === "isha") return document.querySelector(".dpte-timetable .dpte-timetable-isha");
  return null;
}

function setActivePrayer() {
  const currentPrayer = dptCache.getCurrentPrayer();
  if (!currentPrayer) return;
  const currentPrayerElement = getPrayerElement(currentPrayer.name);

  document.querySelector(".dpte-timetable .dpte-timetable-fajr")?.classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-sunrise")?.classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-zuhr")?.classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-asr")?.classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-maghrib")?.classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-isha")?.classList.remove("active");

  currentPrayerElement?.classList.add("active");
}

function setJumah() {
  const zuhrPrayerTitle = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
  const isFriday = new Date().getDay() === 5;
  if (!!zuhrPrayerTitle) {
    zuhrPrayerTitle.textContent = isFriday ? "Jumu'ah" : "Zuhr";
  }
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
