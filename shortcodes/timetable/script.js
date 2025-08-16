const TIMETABLE_DATA_REFETCH_INTERVAL = 10 * 60 * 1000 /* 10 minutes */;

function setJumah() {
  const zuhrPrayerTitle = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
  const isFriday = new Date().getDay() === 5;
  if (!!zuhrPrayerTitle) {
    zuhrPrayerTitle.textContent = isFriday ? "Jumah" : "Zuhr";
  }
}

function getPrayerElement(prayer) {
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
  const currentPrayerElement = getPrayerElement(currentPrayer);

  document.querySelector(".dpte-timetable .dpte-timetable-fajr").classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-sunrise").classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-zuhr").classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-asr").classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-maghrib").classList.remove("active");
  document.querySelector(".dpte-timetable .dpte-timetable-isha").classList.remove("active");

  currentPrayerElement.classList.add("active");
}

addEventListener("DOMContentLoaded", () => {
  dptCache.initialize().then(() => {
    setActivePrayer();
    setInterval(setActivePrayer, 60 * 1000 /* 1 minute */);
    setJumah();
    setInterval(setJumah, 15 * 60 * 1000 /* 15 minutes */);
  });
  dptCache.updateEvery(TIMETABLE_DATA_REFETCH_INTERVAL);
});
