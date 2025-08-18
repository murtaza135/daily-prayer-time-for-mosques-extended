const TIMETABLE_DATE_DATA_REFETCH_INTERVAL = 60 * 60 * 1000; /* 1 hour */

function setTodaysDateGregorian() {
  const today = new Date();
  const todayString = `${today.getDate()} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;
  const todayElement = document.querySelector(".dpte-timetable-date .dpte-timetable-date-gregorian");
  if (!!todayElement) {
    todayElement.textContent = todayString;
  }
}

function setTodaysDateIslamic() {
  const todayString = dptCache.data?.hijri_date_convert;
  const todayElement = document.querySelector(".dpte-timetable-date .dpte-timetable-date-islamic");
  if (!!todayElement && !!todayString) {
    todayElement.textContent = todayString;
  }
}

addEventListener("DOMContentLoaded", () => {
  function setAllElements() {
    setTodaysDateGregorian();
    setTodaysDateIslamic();
  };

  dptCache.initialize().then(() => {
    setAllElements();
    setInterval(setAllElements, 60 * 1000 /* 1 minute */);
  });
  dptCache.updateEvery(TIMETABLE_DATE_DATA_REFETCH_INTERVAL);
});
