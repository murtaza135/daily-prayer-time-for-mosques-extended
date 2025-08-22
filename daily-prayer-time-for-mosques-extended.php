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
      add_action('after_setup_theme', function () {
        \Carbon_Fields\Carbon_Fields::boot();
      });

      add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style("dpte__main_styles", plugin_dir_url(__FILE__) . "main.css", [], null);
        wp_enqueue_script("dpte_date_time_utils", plugin_dir_url(__FILE__) . "utils/DateTimeUtils.js", [], null, true);
        wp_enqueue_script("dpte_dpt_cache", plugin_dir_url(__FILE__) . "utils/DPTCache.js", ["dpte_date_time_utils"], null, true);
      });
      
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable_date/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable_date/admin.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable/admin.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/clock/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/clock/admin.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/notification_banner/shortcode.php";
      require_once plugin_dir_path(__FILE__) . "shortcodes/notification_banner/admin.php";
      require_once plugin_dir_path(__FILE__) . "admin/base.php";
      require_once plugin_dir_path(__FILE__) . "admin/admin.php"; // this must be the last require
    }
  }

  $plugin = new DailyPrayerTimeExtended;
}
