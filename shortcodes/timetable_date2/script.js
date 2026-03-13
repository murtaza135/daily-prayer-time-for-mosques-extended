class TimetableDate {
  static setDateGregorian() {
    const today = new Date();
    const todayString = `${DateTimeUtils.addOrdinalSuffix(today.getDate())} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;
    const dateElement = document.querySelectorAll(".dpte-timetable-date2 .dpte-timetable-date2-text");
    dateElement.forEach((element) => {
      element.textContent = todayString;
    });
  }

  static setDateIslamic() {
    const today = new Date();
    const todayStringGregorian = `${DateTimeUtils.addOrdinalSuffix(today.getDate())} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;
    const todayStringIslamic = dptCache.data?.hijri_date ?? "";
    const dateElement = document.querySelectorAll(".dpte-timetable-date2 .dpte-timetable-date2-text");
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
        TimetableDate.setDateGregorian();
      } else {
        currentDateType.value = "islamic";
        TimetableDate.setDateIslamic();
      }
    }

    setTimeout(setDateText, 1000);
    setInterval(setDateText, 10000);
  });
});
