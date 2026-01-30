class DateTimeUtils {
  static MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  static ISLAMIC_MONTHS = ["Muharram", "Safar", "Rabi ul-Awwal", "Rabi ul-Thani", "Jumada al-Ula", "Jumada al-Thaniyah", "Rajab", "Sha'ban", "Ramadan", "Shawwal", "Dhul Qa'ada", "Dhul Hijja"];

  static formatDiffToTime(diff) {
    const hours = `${Math.floor(diff / (1000 * 60 * 60))}`.padStart(2, "0");
    const minutes = `${Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60))}`.padStart(2, "0");
    const seconds = `${Math.floor((diff % (1000 * 60)) / 1000)}`.padStart(2, "0");
    return `${hours}:${minutes}:${seconds}`;
  }

  static formatDateToTime(date) {
    const hours = `${date.getHours()}`.padStart(2, "0");
    const minutes = `${date.getMinutes()}`.padStart(2, "0");
    return `${hours}:${minutes}`;
  }

  // @source: https://www.w3resource.com/javascript-exercises/fundamental/javascript-fundamental-exercise-122.php
  static addOrdinalSuffix(num) {
    const int = parseInt(num);
    const digits = [int % 10, int % 100];
    const ordinals = ['st', 'nd', 'rd', 'th'];
    const oPattern = [1, 2, 3, 4];
    const tPattern = [11, 12, 13, 14, 15, 16, 17, 18, 19];
    return oPattern.includes(digits[0]) && !tPattern.includes(digits[1])
      ? int + ordinals[digits[0] - 1]
      : int + ordinals[3];
  }

  // @source https://www.al-habib.info/islamic-calendar/hijricalendartext.htm
  static _gmod(n, m) {
    return ((n % m) + m) % m;
  }

  // @source https://www.al-habib.info/islamic-calendar/hijricalendartext.htm
  static _kuwaitiCalendar(adjust) {
    let today = new Date();
    if (adjust) {
      const adjustmili = 1000 * 60 * 60 * 24 * adjust;
      const todaymili = today.getTime() + adjustmili;
      today = new Date(todaymili);
    }
    let day = today.getDate();
    let month = today.getMonth();
    let year = today.getFullYear();
    let m = month + 1;
    let y = year;
    if (m < 3) {
      y -= 1;
      m += 12;
    }

    let a = Math.floor(y / 100.);
    let b = 2 - a + Math.floor(a / 4.);
    if (y < 1583) b = 0;
    if (y == 1582) {
      if (m > 10) b = -10;
      if (m == 10) {
        b = 0;
        if (day > 4) b = -10;
      }
    }

    const jd = Math.floor(365.25 * (y + 4716)) + Math.floor(30.6001 * (m + 1)) + day + b - 1524;

    b = 0;
    if (jd > 2299160) {
      a = Math.floor((jd - 1867216.25) / 36524.25);
      b = 1 + a - Math.floor(a / 4.);
    }
    const bb = jd + b + 1524;
    let cc = Math.floor((bb - 122.1) / 365.25);
    const dd = Math.floor(365.25 * cc);
    const ee = Math.floor((bb - dd) / 30.6001);
    day = (bb - dd) - Math.floor(30.6001 * ee);
    month = ee - 1;
    if (ee > 13) {
      cc += 1;
      month = ee - 13;
    }
    year = cc - 4716;

    const wd = DateTimeUtils._gmod(jd + 1, 7) + 1;

    const iyear = 10631. / 30.;
    const epochastro = 1948084;
    const epochcivil = 1948085;

    const shift1 = 8.01 / 60.;

    let z = jd - epochastro;
    const cyc = Math.floor(z / 10631.);
    z = z - 10631 * cyc;
    const j = Math.floor((z - shift1) / iyear);
    const iy = 30 * cyc + j;
    z = z - Math.floor(j * iyear + shift1);
    let im = Math.floor((z + 28.5001) / 29.5);
    if (im == 13) im = 12;
    const id = z - Math.floor(29.5001 * im - 29);

    const myRes = new Array(8);
    myRes[0] = day; // calculated day (CE)
    myRes[1] = month - 1; // calculated month (CE)
    myRes[2] = year; // calculated year (CE)
    myRes[3] = jd - 1; // julian day number
    myRes[4] = wd - 1; // weekday number
    myRes[5] = id; // islamic date
    myRes[6] = im - 1; // islamic month
    myRes[7] = iy; // islamic year
    return myRes;
  }

  // @source https://www.al-habib.info/islamic-calendar/hijricalendartext.htm
  static calculateIslamicDate(delta = 0) {
    const iDate = DateTimeUtils._kuwaitiCalendar(delta);
    const outputIslamicDate = `${iDate[5]} ${DateTimeUtils.ISLAMIC_MONTHS[iDate[6]]} ${iDate[7]}`;
    return outputIslamicDate;
  }
}

window.DateTimeUtils = DateTimeUtils;
