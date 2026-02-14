class TimetableDate {
  static setDateGregorian() {
    const today = new Date();
    const todayString = `${DateTimeUtils.addOrdinalSuffix(today.getDate())} ${DateTimeUtils.MONTHS[today.getMonth()]} ${today.getFullYear()}`;
    const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-gregorian");
    dateElement.forEach((element) => {
      element.textContent = todayString;
    });
  }

  static setDateIslamic() {
    console.log(dptCache.data);
    const todayString = dptCache.data?.hijri_date ?? "";
    const dateElement = document.querySelectorAll(".dpte-timetable-date .dpte-timetable-date-islamic");
    dateElement.forEach((element) => {
      element.textContent = todayString;
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    TimetableDate.setDateGregorian();
    setTimeout(TimetableDate.setDateGregorian, 1000);
    setTimeout(TimetableDate.setDateGregorian, 2500);
    setInterval(TimetableDate.setDateGregorian, 60 * 1000 /* 1 minute */);

    TimetableDate.setDateIslamic();
    setTimeout(TimetableDate.setDateIslamic, 1000);
    setTimeout(TimetableDate.setDateIslamic, 2500);
    setInterval(TimetableDate.setDateIslamic, 60 * 1000 /* 1 minute */);
  });
});
