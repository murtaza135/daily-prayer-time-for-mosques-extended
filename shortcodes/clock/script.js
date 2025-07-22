const REFETCH_PRAYER_DATA_INTERVAL = 10 * 60 * 1000 /* 10 minutes */;
const TIME_UNTIL_JAMAH_MESSAGE = (name) => `${name} Jama'ah in:`;
const TIME_UNTIL_PRAYER_END_MESSAGE = (name) => `${name} time left:`;

function setTimeRemainingMessage() {
  const nextPrayerAndTime = dptFetchCache.getNextPrayerAndTime();
  const timeRemainingHeader = document.querySelector(".dpte-clock .dpte-time-remaining-header");
  const timeRemainingValue = document.querySelector(".dpte-clock .dpte-time-remaining-value");
  if (!timeRemainingHeader || !timeRemainingValue) return;

  if (!nextPrayerAndTime) {
    timeRemainingHeader.textContent = "";
    timeRemainingValue.textContent = "";
  } else if (nextPrayerAndTime.waitingForJamah) {
    timeRemainingHeader.textContent = TIME_UNTIL_JAMAH_MESSAGE(nextPrayerAndTime.name);
    timeRemainingValue.textContent = nextPrayerAndTime.timeRemaining;
  } else {
    timeRemainingHeader.textContent = TIME_UNTIL_PRAYER_END_MESSAGE(nextPrayerAndTime.name);
    timeRemainingValue.textContent = nextPrayerAndTime.timeRemaining;
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

  const hoursHand = document.querySelector(".dpte-clock .dpte-hand-hours");
  const minutesHand = document.querySelector(".dpte-clock .dpte-hand-minutes");
  const secondsHand = document.querySelector(".dpte-clock .dpte-hand-seconds");

  if (!!hoursHand) hoursHand.style.transform = `rotate(${hoursRotation}deg)`;
  if (!!minutesHand) minutesHand.style.transform = `rotate(${minutesRotation}deg)`;
  if (!!secondsHand) secondsHand.style.transform = `rotate(${secondsRotation}deg)`;
}

addEventListener("DOMContentLoaded", () => {
  function setAllElements() {
    setTimeRemainingMessage();
    setClock();
  }

  dptFetchCache.refetchPrayerTimes();
  setInterval(dptFetchCache.refetchPrayerTimes, REFETCH_PRAYER_DATA_INTERVAL);
  setInterval(setAllElements, 1000);
});
