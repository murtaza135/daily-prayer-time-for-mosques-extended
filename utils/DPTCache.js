class DPTCache {
  static REFETCH_INTERVAL_TIME = 10 * 60 * 1000; /* 10 minutes */

  static PRAYER_INDEX = {
    fajr: 0,
    sunrise: 1,
    zuhr: 2,
    asr: 3,
    maghrib: 4,
    isha: 5,
  };

  constructor() {
    this.data = null;
    this.isFetching = false;

    this.loadPrayerData();
    this.intervalId = setInterval(() => this.reloadPrayerData(), DPTCache.REFETCH_INTERVAL_TIME);
  }

  destroy() {
    clearInterval(this.intervalId);
  }

  async _fetchPrayerData() {
    const res = await fetch(`${window.location.origin}/wp-json/dpt/v1/prayertime?filter=today`);
    const data = await res.json();
    if (!res.ok) return null;
    return data[0];
  }

  _extractPrayerData(data) {
    if (!!data) {
      const yesterdaysPrayers = !!this.data
        ? data.d_date === this.data.date
          ? this.data.yesterday
          : this.data.today
        : null;

      const todaysPrayers = [
        {
          name: "Fajr",
          begins: new Date(`${data.d_date}T${data.fajr_begins}Z`),
          jamah: new Date(`${data.d_date}T${data.fajr_jamah}Z`),
          end: new Date(`${data.d_date}T${data.sunrise}Z`),
        },
        {
          name: "Sunrise",
          begins: new Date(`${data.d_date}T${data.sunrise}Z`),
          jamah: new Date(`${data.d_date}T${data.sunrise}Z`),
          end: new Date(`${data.d_date}T${data.zuhr_begins}Z`),
        },
        {
          name: "Zuhr",
          begins: new Date(`${data.d_date}T${data.zuhr_begins}Z`),
          jamah: new Date(`${data.d_date}T${data.zuhr_jamah}Z`),
          end: new Date(`${data.d_date}T${data.asr_mithl_1}Z`),
        },
        {
          name: "Asr",
          begins: new Date(`${data.d_date}T${data.asr_mithl_1}Z`),
          jamah: new Date(`${data.d_date}T${data.asr_jamah}Z`),
          end: new Date(`${data.d_date}T${data.maghrib_begins}Z`),
        },
        {
          name: "Maghrib",
          begins: new Date(`${data.d_date}T${data.maghrib_begins}Z`),
          jamah: new Date(`${data.d_date}T${data.maghrib_jamah}Z`),
          end: new Date(`${data.d_date}T${data.isha_begins}Z`),
        },
        {
          name: "Isha",
          begins: new Date(`${data.d_date}T${data.isha_begins}Z`),
          jamah: new Date(`${data.d_date}T${data.isha_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.fajr_begins}Z`),
        },
      ];

      const tomorrowsPrayers = [
        {
          name: "Fajr",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.fajr_begins}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.fajr_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.sunrise}Z`),
        },
        {
          name: "Sunrise",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.sunrise}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.sunrise}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.zuhr_begins}Z`),
        },
        {
          name: "Zuhr",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.zuhr_begins}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.zuhr_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.asr_mithl_1}Z`),
        },
        {
          name: "Asr",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.asr_mithl_1}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.asr_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.maghrib_begins}Z`),
        },
        {
          name: "Maghrib",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.maghrib_begins}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.maghrib_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T${data.tomorrow.isha_begins}Z`),
        },
        {
          name: "Isha",
          begins: new Date(`${data.tomorrow.d_date}T${data.tomorrow.isha_begins}Z`),
          jamah: new Date(`${data.tomorrow.d_date}T${data.tomorrow.isha_jamah}Z`),
          end: new Date(`${data.tomorrow.d_date}T23:59:59.999Z`), // gets re-set to the correct end time when `tomorrow` becomes `today`
        },
      ];

      const allPrayers = !!yesterdaysPrayers
        ? yesterdaysPrayers.concat(todaysPrayers).concat(tomorrowsPrayers)
        : todaysPrayers.concat(tomorrowsPrayers);

      return {
        date: data.d_date,
        hijri_date: data.hijri_date_convert,
        yesterday: yesterdaysPrayers,
        today: todaysPrayers,
        tomorrow: tomorrowsPrayers,
        all: allPrayers,
      };
    }

    return null;
  }

  async reloadPrayerData() {
    if (!this.isFetching) {
      this.isFetching = true;
      const data = await this._fetchPrayerData();
      this.data = this._extractPrayerData(data);
      this.isFetching = false;
    }
  }

  async loadPrayerData() {
    if (!this.data) {
      await this.reloadPrayerData();
    }
  }

  getCurrentPrayer() {
    if (!this.data) return null;
    const now = new Date();

    for (let i = 0; i < this.data.all.length - 1; i++) {
      const { name, begins, jamah, end } = this.data.all[i];

      // If now is after start but before jamaat, then return time to jamaat
      if (begins <= now && now < jamah) {
        const diff = jamah - now;
        const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
        const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
        const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
        const timeRemaining = `${hours}:${minutes}:${seconds}`;
        return { name, begins, jamah, end, timeRemaining, waitingForJamah: true };
      }

      // If now is after jamaat but before end, then return the time to next prayer
      if (jamah <= now && now < end) {
        const diff = end - now;
        const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
        const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
        const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
        const timeRemaining = `${hours}:${minutes}:${seconds}`;
        return { name, begins, jamah, end, timeRemaining, waitingForJamah: false };
      }
    }

    // if first prayer (fajr) is after `now`, without any previous prayers available,
    // then its past midnight with fresh new prayers, therefore it must be Isha time
    const { begins: end } = this.data.all[0];
    if (now < end) {
      const diff = end - now;
      const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
      const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
      const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
      const timeRemaining = `${hours}:${minutes}:${seconds}`;
      return { name: "Isha", begins: now, jamah: now, end, timeRemaining, waitingForJamah: false };
    }

    return null;
  }

  getPrayer(name) {
    if (!this.data) return null;
    const now = new Date();

    const index = DPTCache.PRAYER_INDEX[name];
    const times = !!this.data.yesterday[index]
      ? [this.data.yesterday[index], this.data.today[index], this.data.tomorrow[index]]
      : [this.data.today[index], this.data.tomorrow[index]];

    for (let i = 0; i < times.length; i++) {
      const { name, begins, jamah, end } = times[i];
      if (now < end) return { name, begins, jamah, end };
    }

    return null;
  }

  getFajrPrayer() {
    return this.getPrayer("fajr");
  }

  getSunrise() {
    return this.getPrayer("sunrise");
  }

  getZuhrPrayer() {
    return this.getPrayer("zuhr");
  }

  getAsrPrayer() {
    return this.getPrayer("asr");
  }

  getMaghribPrayer() {
    return this.getPrayer("maghrib");
  }

  getIshaPrayer() {
    return this.getPrayer("isha");
  }

  isZawal() {
    const zuhr = this.getZuhrPrayer();
    if (!zuhr) return false;
    const now = new Date();
    const EXPECTED_DIFFERENCE = 20 * 60 * 1000; /* 20 minutes */
    const actualDifference = zuhr - now;
    return 0 < actualDifference && actualDifference <= EXPECTED_DIFFERENCE;
  }
}

window.dptCache = new DPTCache();
