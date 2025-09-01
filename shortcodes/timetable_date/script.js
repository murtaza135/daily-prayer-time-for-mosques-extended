class TimetableDate {
  static setDateGregorian() {
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

  static setDateIslamic() {
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
}

addEventListener("DOMContentLoaded", () => {
  TimetableDate.setDateGregorian();
  setTimeout(TimetableDate.setDateGregorian, 1000);
  setTimeout(TimetableDate.setDateGregorian, 2500);
  setInterval(TimetableDate.setDateGregorian, 60 * 1000 /* 1 minute */);

  TimetableDate.setDateIslamic();
  setTimeout(TimetableDate.setDateIslamic, 1000);
  setTimeout(TimetableDate.setDateIslamic, 2500);
  setInterval(TimetableDate.setDateIslamic, 60 * 1000 /* 1 minute */);
});
