<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable_date_shortcode($atts) {
  wp_enqueue_style("dpte_timetable_date", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable_date", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(
      'day' => 'today',
    ),
    $atts,
    'dpte_timetable_date'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }

  ob_start();
  ?>
  <div class="dpte-timetable-date" <?php echo $data_attrs; ?>>
    <p class="dpte-timetable-date-gregorian" <?php echo $data_attrs; ?>><?php echo date("d F Y") ?></p>
    <p class="dpte-timetable-date-islamic" <?php echo $data_attrs; ?>></p>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable_date', 'dpte_timetable_date_shortcode');
