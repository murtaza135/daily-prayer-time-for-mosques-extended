function setJumah() {
  const zuhrPrayerTitle = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
  const isFriday = new Date().getDay() === 5;
  if (!!zuhrPrayerTitle) {
    zuhrPrayerTitle.textContent = isFriday ? "Jumah" : "Zuhr";
  }
}

function setTodaysDateGregorian() {
  const today = new Date();
  const todayString = `${today.getDate()} ${DateTimeUtils.months[today.getMonth()]} ${today.getFullYear()}`;
  const todayElement = document.querySelector(".dpte-timetable .dpte-timetable-date-gregorian");
  if (!!todayElement) {
    todayElement.textContent = todayString;
  }
}

function setTodaysDateIslamic() {
  const todayString = dptFetchCache.data?.hijri_date_convert;
  const todayElement = document.querySelector(".dpte-timetable .dpte-timetable-date-islamic");
  if (!!todayElement && !!todayString) {
    todayElement.textContent = todayString;
  }
}

addEventListener("DOMContentLoaded", () => {
  function setAllElements() {
    setJumah();
    setTodaysDateGregorian();
    setTodaysDateIslamic();
  };

  dptFetchCache.refetchPrayerTimes().then(() => setAllElements());
  setInterval(setAllElements, 60 * 60 * 1000 /* 1 hour */);
});
