function setTodaysDateGregorian() {
  const today = new Date();
  const todayString = `${today.getDate()} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;
  const todayElement = document.querySelector(".dpte-timetable-date .dpte-timetable-date-gregorian");
  if (!!todayElement) {
    todayElement.textContent = todayString;
  }
}

function setTodaysDateIslamic() {
  const todayString = dptCache.data?.hijri_date;
  const todayElement = document.querySelector(".dpte-timetable-date .dpte-timetable-date-islamic");
  if (!!todayElement && !!todayString) {
    todayElement.textContent = todayString;
  }
}

addEventListener("DOMContentLoaded", () => {
  setTodaysDateGregorian();
  setTimeout(setTodaysDateGregorian, 1000);
  setTimeout(setTodaysDateGregorian, 2500);
  setInterval(setTodaysDateGregorian, 60 * 1000 /* 1 minute */);

  dptCache.ensurePrayerData().then(() => {
    setTodaysDateIslamic();
    setTimeout(setTodaysDateIslamic, 1000);
    setTimeout(setTodaysDateIslamic, 2500);
    setInterval(setTodaysDateIslamic, 60 * 1000 /* 1 minute */);
  });
});
