class DateTimeUtils {
  static timeStringToDate(timeString, tomorrow = false) {
    const [h, m, s] = timeString.split(":").map(Number);
    const now = new Date();
    const date = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m, s);
    if (tomorrow) date.setDate(date.getDate() + 1);
    return date;
  }
}

window.DateTimeUtils = DateTimeUtils;
