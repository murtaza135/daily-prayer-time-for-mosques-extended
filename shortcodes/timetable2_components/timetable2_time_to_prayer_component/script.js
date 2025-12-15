class Timetable2TimeToPrayerComponent {
  static setTimeRemaining() {
    const currentPrayer = dptCache.getCurrentPrayer();
    const nextPrayerNameElement = document.querySelectorAll(".dpte-timetable2-time-to-prayer-component .dpte-timetable2-next-prayer-name");
    const nextPrayerRemainingTimeElement = document.querySelectorAll(".dpte-timetable2-time-to-prayer-component .dpte-timetable2-next-prayer-remaining-time");

    if (!currentPrayer) {
      nextPrayerNameElement.forEach((element) => {
        element.textContent = "Time to Salah ";
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = "";
      });
    } else if (currentPrayer.waitingForJamah) {
      nextPrayerNameElement.forEach((element) => {
        element.textContent = `${currentPrayer.name} Jama'ah in `;
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = currentPrayer.timeRemaining;
      });
    } else {
      nextPrayerNameElement.forEach((element) => {
        const nextPrayerName = dptCache.getNextPrayerName(currentPrayer.name);
        const nextPrayerNameCapitalised = nextPrayerName.charAt(0).toUpperCase() + nextPrayerName.slice(1);
        element.textContent = `Time to ${nextPrayerNameCapitalised} `;
      });
      nextPrayerRemainingTimeElement.forEach((element) => {
        element.textContent = currentPrayer.timeRemaining;
      });
    }
  }
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    Timetable2TimeToPrayerComponent.setTimeRemaining();
    setInterval(Timetable2TimeToPrayerComponent.setTimeRemaining, 1000);
  });
});
