function setDateGregorian() {
  const today = new Date();
  const todayString = `${today.getDate()} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;

  const tomorrow = new Date();
  tomorrow.setDate(today.getDate() + 1);
  const tomorrowString = `${tomorrow.getDate()} ${DateTimeUtils.MONTHS[tomorrow.getMonth()]} ${tomorrow.getFullYear()}`;

  const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-gregorian");
  dateElement.forEach((element) => {
    if (element.dataset.day === "tomorrow") {
      element.textContent = tomorrowString;
    } else {
      element.textContent = todayString;
    }
  });
}

function setDateIslamic() {
  const todayString = dptCache.data?.hijri_date;
  const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-islamic");
  if (!!todayString) {
    dateElement.forEach((element) => {
      element.textContent = todayString;
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  setDateGregorian();
  setTimeout(setDateGregorian, 1000);
  setTimeout(setDateGregorian, 2500);
  setInterval(setDateGregorian, 60 * 1000 /* 1 minute */);

  dptCache.ensurePrayerData().then(() => {
    setDateIslamic();
    setTimeout(setDateIslamic, 1000);
    setTimeout(setDateIslamic, 2500);
    setInterval(setDateIslamic, 60 * 1000 /* 1 minute */);
  });
});
