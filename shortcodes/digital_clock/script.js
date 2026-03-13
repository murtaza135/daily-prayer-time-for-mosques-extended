class DigitalClock {
  static setTime() {
    const now = new Date();
    const timeElement = document.querySelectorAll(".dpte-digital-clock .dpte-digital-clock-text");
    const timeString = DateTimeUtils.formatDateToTimeWithSeconds(now);
    timeElement.forEach((element) => {
      element.textContent = timeString;
    });
  }
}

addEventListener("DOMContentLoaded", () => {
  DigitalClock.setTime();
  setInterval(DigitalClock.setTime, 1000);
});
