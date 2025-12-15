<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_date_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2_date_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2_date_component", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

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
  <div class="dpte-timetable2-date-component" <?php echo $data_attrs; ?>>
    <div class="dpte-timetable2-date-time-section">
      <p class="dpte-timetable2-date"><?php echo date("l jS F Y") ?></p>
      <p class="dpte-timetable2-time"></p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2_date_component', 'dpte_timetable2_date_component_shortcode');
