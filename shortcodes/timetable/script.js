function setJumah() {
  const zuhrPrayerTitle = document.querySelector(".dpte-timetable .dpte-timetable-zuhr .dpte-prayer-title");
  const isFriday = new Date().getDay() === 5;
  if (!!zuhrPrayerTitle) {
    zuhrPrayerTitle.textContent = isFriday ? "Jumah" : "Zuhr";
  }
}

addEventListener("DOMContentLoaded", () => {
  function setAllElements() {
    setJumah();
  };

  dptFetchCache.refetchPrayerTimes().then(() => setAllElements());
  setInterval(setAllElements, 60 * 60 * 1000 /* 1 hour */);
});
