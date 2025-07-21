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

  hoursHand.style.transform = `rotate(${hoursRotation}deg)`;
  minutesHand.style.transform = `rotate(${minutesRotation}deg)`;
  secondsHand.style.transform = `rotate(${secondsRotation}deg)`;
}

setInterval(setClock, 1000);
