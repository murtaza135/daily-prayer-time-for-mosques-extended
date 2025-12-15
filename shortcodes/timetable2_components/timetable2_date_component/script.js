class Timetable2DateComponent {
  static setTime() {
    const now = new Date();
    const timeElement = document.querySelectorAll(".dpte-timetable2-date-component .dpte-timetable2-time");
    const timeString = DateTimeUtils.formatDateToTime(now);
    timeElement.forEach((element) => {
      element.textContent = timeString;
    });
  }

  static setDate() {
    const now = new Date();
    const dateElement = document.querySelectorAll(".dpte-timetable2-date-component .dpte-timetable2-date");
    // TODO change to same type of code in timetable_date shortcode, and move into DateTimeUtils
    const dateStringParts = now.toLocaleDateString("en-GB", { weekday: "long", day: "numeric", month: "long", year: "numeric" }).split(" ");
    const dateString = `${dateStringParts[0]} ${DateTimeUtils.addOrdinalSuffix(dateStringParts[1])} ${dateStringParts[2]} ${dateStringParts[3]}`;
    dateElement.forEach((element) => {
      element.textContent = dateString;
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  Timetable2DateComponent.setDate();
  setTimeout(Timetable2DateComponent.setDate, 1000);
  setTimeout(Timetable2DateComponent.setDate, 2500);
  setInterval(Timetable2DateComponent.setDate, 1 * 60 * 1000 /* 1 minute */);

  Timetable2DateComponent.setTime();
  setInterval(Timetable2DateComponent.setTime, 1000);
});
