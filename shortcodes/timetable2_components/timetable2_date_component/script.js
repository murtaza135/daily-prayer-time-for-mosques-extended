class Timetable2DateComponent {
  static setTime() {
    const now = new Date();
    const timeElement = document.querySelectorAll(".dpte-timetable2-date-component .dpte-timetable2-time");
    const timeString = DateTimeUtils.formatDateToTime(now);
    timeElement.forEach((element) => {
      element.textContent = timeString;
    });
  }

  static setDateGregorian() {
    const now = new Date();
    const dateElement = document.querySelectorAll(".dpte-timetable2-date-component .dpte-timetable2-date");
    // TODO change to same type of code in timetable_date shortcode, and move into DateTimeUtils
    const dateStringParts = now.toLocaleDateString("en-GB", { weekday: "long", day: "numeric", month: "long", year: "numeric" }).split(" ");
    const dateString = `${dateStringParts[0]} ${DateTimeUtils.addOrdinalSuffix(dateStringParts[1])} ${dateStringParts[2]} ${dateStringParts[3]}`;
    dateElement.forEach((element) => {
      element.textContent = dateString;
    });
  }

  static setDateIslamic() {
    const now = new Date();
    const dateElement = document.querySelectorAll(".dpte-timetable2-date-component .dpte-timetable2-date");
    // TODO change to same type of code in timetable_date shortcode, and move into DateTimeUtils
    const dateStringParts = now.toLocaleDateString("en-GB", { weekday: "long", day: "numeric", month: "long", year: "numeric" }).split(" ");
    const todayStringGregorian = `${dateStringParts[0]} ${DateTimeUtils.addOrdinalSuffix(dateStringParts[1])} ${dateStringParts[2]} ${dateStringParts[3]}`;
    const todayStringIslamic = dptCache.data?.hijri_date ?? todayStringGregorian;
    dateElement.forEach((element) => {
      element.textContent = todayStringIslamic;
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  const currentDateType = { value: "islamic" };

  dptCache.ensurePrayerData().then(() => {
    function setDateText() {
      if (currentDateType.value === "islamic") {
        currentDateType.value = "gregorian";
        Timetable2DateComponent.setDateGregorian();
      } else {
        currentDateType.value = "islamic";
        Timetable2DateComponent.setDateIslamic();
      }
    }

    setTimeout(setDateText, 2500);
    setInterval(setDateText, 10000 /* 10 seconds */);
  });

  Timetable2DateComponent.setDateGregorian();
  setTimeout(Timetable2DateComponent.setDateGregorian, 1000);

  Timetable2DateComponent.setTime();
  setInterval(Timetable2DateComponent.setTime, 1000);
});
