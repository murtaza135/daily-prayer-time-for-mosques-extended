class DateTimeUtils {
  static MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

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
}

window.DateTimeUtils = DateTimeUtils;
