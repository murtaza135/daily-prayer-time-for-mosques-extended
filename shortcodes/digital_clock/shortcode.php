<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_digital_clock_shortcode($atts) {
  wp_enqueue_style("dpte_digital_clock", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_digital_clock", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

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
    'digital_clock_color' => '#CFA55B',
    'digital_clock_text_size_multiplier' => '1',
    
    // js
    // ...
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_digital_clock');

  // generate css properties from atts
  $style_keys = array('digital_clock_color', 'digital_clock_text_size_multiplier');
  $style = '';
  foreach ($style_keys as $key) {
    if (isset($atts[$key])) {
      $style .= '--dpte-' . esc_attr(str_replace('_', '-', $key)) . ':' . esc_attr($atts[$key]) . ';';
    }
  }

  // generate data attributes from atts
  $data_keys  = array();
  $data_attrs = '';
  foreach ($data_keys as $key) {
    if (isset($atts[$key])) {
      $data_attrs .= ' data-' . esc_attr(str_replace('_', '-', $key)) . '="' . esc_attr($atts[$key]) . '"';
    }
  }

  ob_start();
  ?>
  <div class="dpte-digital-clock" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
    <p class="dpte-digital-clock-text" <?php echo $data_attrs; ?>>00:00:00</p>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_digital_clock', 'dpte_digital_clock_shortcode');
