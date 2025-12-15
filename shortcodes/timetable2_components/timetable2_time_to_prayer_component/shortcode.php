<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_time_to_prayer_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2_time_to_prayer_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2_time_to_prayer_component", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(),
    $atts,
    'dpte_timetable'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }

  ob_start();
  ?>
  <div class="dpte-timetable2-time-to-prayer-component" <?php echo $data_attrs; ?>>
    <div class="dpte-timetable2-next-prayer-section">
      <p class="dpte-timetable2-next-prayer-name"></p>
      <p class="dpte-timetable2-next-prayer-remaining-time"></p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2_time_to_prayer_component', 'dpte_timetable2_time_to_prayer_component_shortcode');
