<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_time_to_prayer_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2_time_to_prayer_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2_time_to_prayer_component", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

  // change all kebab-case attributes to snake_case attributes
  $normalized_atts = array();
  foreach ($atts as $key => $value) {
    $normalized_key = str_replace('-', '_', $key);
    $normalized_atts[$normalized_key] = $value;
  }
  $atts = $normalized_atts;

  // merge default atts and with user-provided atts
  $default_atts = array(
    // general
    // ...
    
    // css
    'timetable2_next_prayer_background' => '#CFA55B',
    'timetable2_next_prayer_color' => '#2C2C2E',
    'timetable2_text_size_multiplier' => '1',
    
    // js
    // ...
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_timetable2_time_to_prayer_component');

  // generate css properties from atts
  $style_keys = array(
    'timetable2_next_prayer_background',
    'timetable2_next_prayer_color',
    'timetable2_text_size_multiplier',
  );
  $style = '';
  foreach ($style_keys as $key) {
    if (isset($atts[$key])) {
      $style .= '--dpte-' . esc_attr(str_replace('_', '-', $key)) . ':' . esc_attr($atts[$key]) . ';';
    }
  }

  // generate data attributes from atts
  $data_keys  = array('timetype', 'alwaysactive');
  $data_attrs = '';
  foreach ($data_keys as $key) {
    if (isset($atts[$key])) {
      $data_attrs .= ' data-' . esc_attr(str_replace('_', '-', $key)) . '="' . esc_attr($atts[$key]) . '"';
    }
  }

  ob_start();
  ?>
  <div class="dpte-timetable2-time-to-prayer-component" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
    <div class="dpte-timetable2-next-prayer-section">
      <p class="dpte-timetable2-next-prayer-name"></p>
      <p class="dpte-timetable2-next-prayer-remaining-time"></p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2_time_to_prayer_component', 'dpte_timetable2_time_to_prayer_component_shortcode');
