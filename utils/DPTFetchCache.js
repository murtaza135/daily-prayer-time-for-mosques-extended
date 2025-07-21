class DPTFetchCache {
  constructor() {
    this.data = null;
    this.prayerTimes = null;
  }

  async fetchPrayerData() {
    try {
      const res = await fetch(`${window.location.origin}/wp-json/dpt/v1/prayertime?filter=today`);
      const data = await res.json();
      this.data = data[0];
    } catch {
      this.data = null;
    }
  }

  extractPrayerTimes() {
    if (!!this.data) {
      this.prayerTimes = [
        { name: "Fajr", begins: DateTimeUtils.timeStringToDate(this.data.fajr_begins), jamah: DateTimeUtils.timeStringToDate(this.data.fajr_jamah) },
        { name: "Zuhr", begins: DateTimeUtils.timeStringToDate(this.data.zuhr_begins), jamah: DateTimeUtils.timeStringToDate(this.data.zuhr_jamah) },
        { name: "Asr", begins: DateTimeUtils.timeStringToDate(this.data.asr_mithl_1 ?? this.data.asr_mithl_2), jamah: DateTimeUtils.timeStringToDate(this.data.asr_jamah) },
        { name: "Maghrib", begins: DateTimeUtils.timeStringToDate(this.data.maghrib_begins), jamah: DateTimeUtils.timeStringToDate(this.data.maghrib_jamah) },
        { name: "Isha", begins: DateTimeUtils.timeStringToDate(this.data.isha_begins), jamah: DateTimeUtils.timeStringToDate(this.data.isha_jamah) },
        { name: "Fajr", begins: DateTimeUtils.timeStringToDate(this.data.tomorrow.fajr_begins, true), jamah: null }, // tomorrow's Fajr
      ];
    } else {
      this.prayerTimes = null;
    }
  }

  async refetchPrayerTimes() {
    await this.fetchPrayerData();
    this.extractPrayerTimes();
  }

  getNextPrayerAndTime() {
    if (!this.prayerTimes) return null;
    const now = new Date();

    for (let i = 0; i < this.prayerTimes.length - 2; i++) {
      const { name, begins, jamah } = this.prayerTimes[i];
      const end = this.prayerTimes[i + 1].begins;

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
}

window.dptFetchCache = new DPTFetchCache();
