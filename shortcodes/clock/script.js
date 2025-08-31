function setTimeRemainingMessage() {
  const currentPrayer = dptCache.getCurrentPrayer();
  const timeRemainingHeader = document.querySelectorAll(".dpte-clock .dpte-time-remaining-header");
  const timeRemainingValue = document.querySelectorAll(".dpte-clock .dpte-time-remaining-value");
  if (timeRemainingHeader.length === 0 || timeRemainingValue.length === 0) return;

  if (!currentPrayer) {
    timeRemainingHeader.forEach((element) => {
      element.textContent = "";
    });
    timeRemainingValue.forEach((element) => {
      element.textContent = "";
    });
  } else if (currentPrayer.waitingForJamah) {
    timeRemainingHeader.forEach((element) => {
      element.textContent = `${currentPrayer.name} Jama'ah in:`;
    });
    timeRemainingValue.forEach((element) => {
      element.textContent = currentPrayer.timeRemaining;
    });
  } else {
    timeRemainingHeader.forEach((element) => {
      const nextPrayerName = dptCache.getNextPrayerName(currentPrayer.name);
      const nextPrayerNameCapitalised = nextPrayerName.charAt(0).toUpperCase() + nextPrayerName.slice(1);
      element.textContent = `Time to ${nextPrayerNameCapitalised}:`;
    });
    timeRemainingValue.forEach((element) => {
      element.textContent = currentPrayer.timeRemaining;
    });
  }
}

// @source: clock adapted from https://www.youtube.com/watch?v=nVGhXcMROfU
function setClock() {
  const now = new Date();
  const hours = now.getHours();
  const minutes = now.getMinutes();
  const seconds = now.getSeconds();

  const hoursRotation = (hours * 30) + (minutes * 6) / 12;
  const minutesRotation = minutes * 6;
  const secondsRotation = seconds * 6;

  const hoursHand = document.querySelectorAll(".dpte-clock .dpte-hand-hours");
  const minutesHand = document.querySelectorAll(".dpte-clock .dpte-hand-minutes");
  const secondsHand = document.querySelectorAll(".dpte-clock .dpte-hand-seconds");

  hoursHand.forEach((element) => {
    element.style.transform = `rotate(${hoursRotation}deg)`;
  });
  minutesHand.forEach((element) => {
    element.style.transform = `rotate(${minutesRotation}deg)`;
  });
  secondsHand.forEach((element) => {
    element.style.transform = `rotate(${secondsRotation}deg)`;
  });
}

addEventListener("DOMContentLoaded", () => {
  dptCache.ensurePrayerData().then(() => {
    setTimeRemainingMessage();
    setTimeout(setTimeRemainingMessage, 1000);
    setTimeout(setTimeRemainingMessage, 2500);
    setInterval(setTimeRemainingMessage, 1000);

    setClock();
    setTimeout(setClock, 1000);
    setTimeout(setClock, 2500);
    setInterval(setClock, 1000);
  });
});
