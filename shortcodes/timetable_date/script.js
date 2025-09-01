function setDateGregorian() {
  const today = new Date();
  const todayString = `${DateTimeUtils.addOrdinalSuffix(today.getDate())} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;

  const tomorrow = new Date();
  tomorrow.setDate(today.getDate() + 1);
  const tomorrowString = `${DateTimeUtils.addOrdinalSuffix(tomorrow.getDate())} ${DateTimeUtils.MONTHS[tomorrow.getMonth()]} ${tomorrow.getFullYear()}`;

  const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-gregorian");
  dateElement.forEach((element) => {
    if (element.dataset.day === "today") {
      element.textContent = todayString;
    } else if (element.dataset.day === "tomorrow") {
      element.textContent = tomorrowString;
    } else {
      element.textContent = "";
    }
  });
}

function setDateIslamic() {
  const todayString = DateTimeUtils.calculateIslamicDate(0);
  const tomorrowString = DateTimeUtils.calculateIslamicDate(1);
  const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-islamic");
  dateElement.forEach((element) => {
    if (element.dataset.day === "today") {
      element.textContent = todayString;
    } else if (element.dataset.day === "tomorrow") {
      element.textContent = tomorrowString;
    } else {
      element.textContent = "";
    }
  });
}

addEventListener("DOMContentLoaded", () => {
  setDateGregorian();
  setTimeout(setDateGregorian, 1000);
  setTimeout(setDateGregorian, 2500);
  setInterval(setDateGregorian, 60 * 1000 /* 1 minute */);

  setDateIslamic();
  setTimeout(setDateIslamic, 1000);
  setTimeout(setDateIslamic, 2500);
  setInterval(setDateIslamic, 60 * 1000 /* 1 minute */);
});
