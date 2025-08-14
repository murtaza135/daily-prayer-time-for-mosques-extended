<?php

/**
 * Plugin name: Daily Prayer Time Extended
 * Description: A plugin that extends the Daily Prayer Time plugin by mmrs151 by providing additional, nicely styled shortcodes for clocks and prayer timetables.
 * Version: 1.0.0
 * Author: Murtaza Akhtar
 * Author URI: https://www.murtaza-akhtar.com/
 * Text Domain: daily-prayer-time-for-mosques-extended
 */

if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('DailyPrayerTimeExtended')) {
  class DailyPrayerTimeExtended
  {
    public function __construct()
    {
      add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style("dpte__main_styles", plugin_dir_url(__FILE__) . "main.css", [], null);
        wp_enqueue_script("dpte_date_time_utils", plugin_dir_url(__FILE__) . "utils/DateTimeUtils.js", [], null, true);
        wp_enqueue_script("dpte_dpt_fetch_cache", plugin_dir_url(__FILE__) . "utils/DPTFetchCache.js", ["dpte_date_time_utils"], null, true);
      });

      require_once plugin_dir_path(__FILE__) . "shortcodes/example/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/clock/shortcode.php";
    }
  }

  $plugin = new DailyPrayerTimeExtended;
}
