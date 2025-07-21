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
        wp_enqueue_style("dpte-example", plugin_dir_url(__FILE__) . "shortcodes/example/styles.css");
        wp_enqueue_script("dpte-example", plugin_dir_url(__FILE__) . "shortcodes/example/script.js");
      });
      require_once plugin_dir_path(__FILE__) . "shortcodes/example/shortcode.php";
      add_shortcode('dpte_example', 'dpte_example_shortcode');

      add_action('wp_enqueue_scripts', function() {
        wp_enqueue_style("dpte-timetable", plugin_dir_url(__FILE__) . "shortcodes/timetable/styles.css");
        wp_enqueue_script("dpte-timetable", plugin_dir_url(__FILE__) . "shortcodes/timetable/script.js");
      });
      require_once plugin_dir_path(__FILE__) . "shortcodes/timetable/shortcode.php";
      add_shortcode('dpte_timetable', 'dpte_timetable_shortcode');

      require_once plugin_dir_path(__FILE__) . "shortcodes/clock/shortcode.php";
      add_shortcode('dpte_clock', 'dpte_clock_shortcode');
    }
  }

  $plugin = new DailyPrayerTimeExtended;
}
