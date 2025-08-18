function setTimeRemainingMessage() {
  const currentPrayer = dptCache.getCurrentPrayer();
  const timeRemainingHeader = document.querySelector(".dpte-clock .dpte-time-remaining-header");
  const timeRemainingValue = document.querySelector(".dpte-clock .dpte-time-remaining-value");
  if (!timeRemainingHeader || !timeRemainingValue) return;

  if (!currentPrayer) {
    timeRemainingHeader.textContent = "";
    timeRemainingValue.textContent = "";
  } else if (currentPrayer.waitingForJamah) {
    timeRemainingHeader.textContent = `${currentPrayer.name} Jama'ah in:`;
    timeRemainingValue.textContent = currentPrayer.timeRemaining;
  } else {
    timeRemainingHeader.textContent = `${currentPrayer.name} time left:`;
    timeRemainingValue.textContent = currentPrayer.timeRemaining;
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
  setTimeRemainingMessage();
  setInterval(setTimeRemainingMessage, 1000);
  setClock();
  setInterval(setClock, 1000);
});
