const REFETCH_PRAYER_DATA_INTERVAL = 10 * 60 * 1000 /* 10 minutes */;
const TIME_UNTIL_JAMAH_MESSAGE = (name) => `${name} jamaa'ah in:`;
const TIME_UNTIL_PRAYER_END_MESSAGE = (name) => `${name} time left:`;

const clockState = {
  prayerTimes: null
};

function timeStringToDate(timeString, tomorrow = false) {
  const [h, m, s] = timeString.split(":").map(Number);
  const now = new Date();
  const date = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, s);
  if (tomorrow) date.setDate(date.getDate() + 1);
  return date;
}

async function fetchPrayerData() {
  try {
    // TODO change url
    const res = await fetch('http://test-wp.local/wp-json/dpt/v1/prayertime?filter=today');
    const data = await res.json();
    return data[0];
  } catch {
    return null;
  }
}

function extractPrayerTimes(data) {
  if (!data) return null;
  return [
    { name: "Fajr", begins: timeStringToDate(data.fajr_begins), jamah: timeStringToDate(data.fajr_jamah) },
    { name: "Zuhr", begins: timeStringToDate(data.zuhr_begins), jamah: timeStringToDate(data.zuhr_jamah) },
    { name: "Asr", begins: timeStringToDate(data.asr_mithl_1 ?? data.asr_mithl_2), jamah: timeStringToDate(data.asr_jamah) },
    { name: "Maghrib", begins: timeStringToDate(data.maghrib_begins), jamah: timeStringToDate(data.maghrib_jamah) },
    { name: "Isha", begins: timeStringToDate(data.isha_begins), jamah: timeStringToDate(data.isha_jamah) },
    { name: "Fajr", begins: timeStringToDate(data.tomorrow.fajr_begins, true), jamah: null }, // tomorrow's Fajr
  ];
}

async function fetchAndCachePrayerTimes() {
  const data = await fetchPrayerData();
  const prayerTimes = extractPrayerTimes(data);
  clockState.prayerTimes = prayerTimes;
}

function getNextPrayerAndTime(prayerTimes) {
  if (!prayerTimes) return null;
  const now = new Date();

  for (let i = 0; i < prayerTimes.length - 2; i++) {
    const { name, begins, jamah } = prayerTimes[i];
    const end = prayerTimes[i + 1].begins;

    // If now is after start but before jamaat → time to jamaat
    if (now >= begins && now < jamah) {
      const diff = jamah - now;
      const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
      const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
      const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
      return { name, timeRemaining: `${hours}:${minutes}:${seconds}`, waitingForJamah: true };
    }

    // If now is before start, this is the next prayer
    if (now < end) {
      const diff = end - now;
      const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
      const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
      const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
      return { name, timeRemaining: `${hours}:${minutes}:${seconds}`, waitingForJamah: false };
    }
  }

  return null;
}

function setTimeRemainingMessage(nextPrayerAndTime) {
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

fetchAndCachePrayerTimes();
setInterval(fetchAndCachePrayerTimes, REFETCH_PRAYER_DATA_INTERVAL);

setInterval(() => {
  const nextPrayerAndTime = getNextPrayerAndTime(clockState.prayerTimes);
  setTimeRemainingMessage(nextPrayerAndTime);
  setClock();
}, 1000);
