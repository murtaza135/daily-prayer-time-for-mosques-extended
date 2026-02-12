<?php
// @source: clock adapted from https://www.youtube.com/watch?v=nVGhXcMROfU

if (!defined('ABSPATH')) {
	exit;
}

function dpte_clock_shortcode($atts) {
  wp_enqueue_style("dpte_clock", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_clock", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);

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
    'show_images' => 'true',
    'numbers_language' => 'english',
    'clock_center_logo_image' => '',
    'clock_center_background_logo_image' => '',
    'clock_top_left_image' => '',
    'clock_top_right_image' => '',
    'clock_bottom_left_image' => '',
    'clock_bottom_right_image' => '',

    // css
    'clock_background_gradient_1' => '#CFA55B',
    'clock_background_gradient_2' => '#2C2C2E',
    'clock_border' => '#2C2C2E',
    'clock_number_color' => '#FFFFFF',
    'clock_minute_line_color' => '#FFFFFF',
    'clock_hand_hour_color_gradient_1' => '#ff5e9a',
    'clock_hand_hour_color_gradient_2' => '#ffb960',
    'clock_hand_minute_color_gradient_1' => '#ff5e9a',
    'clock_hand_minute_color_gradient_2' => '#ffb960',
    'clock_hand_second_color_gradient_1' => '#bbbbbbc7',
    'clock_hand_second_color_gradient_2' => '#bbbbbbc7',
    'clock_center_dot_background' => '#CFA55B',
    'clock_center_dot_border' => '#2C2C2E',
    'clock_time_remaining_display' => 'show',
    'clock_time_remaining_color' => '#FFFFFF',
    'clock_center_logo_image_scale' => '1',
    'clock_center_logo_image_translate_x' => '0',
    'clock_center_logo_image_translate_y' => '0',
    'clock_center_background_logo_image_scale' => '1',
    'clock_center_background_logo_image_translate_x' => '0',
    'clock_center_background_logo_image_translate_y' => '0',
    'clock_top_left_image_scale' => '1',
    'clock_top_left_image_translate_x' => '0',
    'clock_top_left_image_translate_y' => '0',
    'clock_top_right_image_scale' => '1',
    'clock_top_right_image_translate_x' => '0',
    'clock_top_right_image_translate_y' => '0',
    'clock_bottom_left_image_scale' => '1',
    'clock_bottom_left_image_translate_x' => '0',
    'clock_bottom_left_image_translate_y' => '0',
    'clock_bottom_right_image_scale' => '1',
    'clock_bottom_right_image_translate_x' => '0',
    'clock_bottom_right_image_translate_y' => '0',

    // js
    // ...
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_clock');

  // atts transformations
  $atts['clock_time_remaining_display'] = $atts['clock_time_remaining_display'] == "hide" ? "none" : "block";

  // generate css properties from atts
  $style_keys = array(
    'clock_background_gradient_1', 'clock_background_gradient_2', 'clock_border', 'clock_number_color',
    'clock_minute_line_color', 'clock_hand_hour_color_gradient_1', 'clock_hand_hour_color_gradient_2',
    'clock_hand_minute_color_gradient_1', 'clock_hand_minute_color_gradient_2',
    'clock_hand_second_color_gradient_1', 'clock_hand_second_color_gradient_2',
    'clock_center_dot_background', 'clock_center_dot_border', 'clock_time_remaining_display', 'clock_time_remaining_color',
    'clock_center_logo_image_scale', 'clock_center_logo_image_translate_x', 'clock_center_logo_image_translate_y',
    'clock_center_background_logo_image_scale', 'clock_center_background_logo_image_translate_x', 'clock_center_background_logo_image_translate_y',
    'clock_top_left_image_scale', 'clock_top_left_image_translate_x', 'clock_top_left_image_translate_y',
    'clock_top_right_image_scale', 'clock_top_right_image_translate_x', 'clock_top_right_image_translate_y',
    'clock_bottom_left_image_scale', 'clock_bottom_left_image_translate_x', 'clock_bottom_left_image_translate_y',
    'clock_bottom_right_image_scale', 'clock_bottom_right_image_translate_x', 'clock_bottom_right_image_translate_y',
  );
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

  $numbers = [
    'english' => [
      1 => '1', 2 => '2', 3 => '3', 4 => '4',
      5 => '5', 6 => '6', 7 => '7', 8 => '8',
      9 => '9', 10 => '10', 11 => '11', 12 => '12',
    ],
    'arabic' => [
      1 => '١', 2 => '٢', 3 => '٣', 4 => '٤',
      5 => '٥', 6 => '٦', 7 => '٧', 8 => '٨',
      9 => '٩', 10 => '١٠', 11 => '١١', 12 => '١٢',
    ],
  ];
  $lang = $atts['numbers_language'] ?? 'english';

  ob_start();
  ?>
  <div class="dpte-clock-wrapper" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
    <img class="dpte-center-background-logo" src="<?php echo esc_url($atts['clock_center_background_logo_image']); ?>" aria-hidden="true">
    <div class="dpte-clock">
      <ul class="dpte-hours-container">
        <?php
          for ($i = 1; $i <= 12; $i++) {
              echo '<li><div class="dpte-num">' . $numbers[$lang][$i] . '</div></li>';
          }
        ?>
      </ul>
      <ul class="dpte-minutes-container">
        <?php
          for ($i = 0; $i < 60; $i++) {
            if ($i % 5 == 0) {
              echo '<li><div class="dpte-minute-line">│</div></li>'; // long pipe character
            } else {
              echo '<li><div class="dpte-minute-line">|</div></li>'; // short pipe character
            }
          }
        ?>
      </ul>
      <div class="dpte-hands-container">
        <div class="dpte-hand dpte-hand-hours"></div>
        <div class="dpte-hand dpte-hand-minutes"></div>
        <div class="dpte-hand dpte-hand-seconds"></div>
      </div>
      <div class="dpte-center-dot"></div>
      <img class="dpte-center-logo" src="<?php echo esc_url($atts['clock_center_logo_image']); ?>" aria-hidden="true">
      <div class="dpte-time-remaining">
        <div class="dpte-time-remaining-content">
          <span class="dpte-time-remaining-header"></span>
          <span class="dpte-time-remaining-value"></span>
        </div>
      </div>
      <img
        <?php if (isset($atts['show_images']) && $atts['show_images'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-top-left-image"
        src="<?php echo esc_url($atts['clock_top_left_image']); ?>"
        aria-hidden="true"
      >
      <img
        <?php if (isset($atts['show_images']) && $atts['show_images'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-top-right-image"
        src="<?php echo esc_url($atts['clock_top_right_image']); ?>"
        aria-hidden="true"
      >
      <img
        <?php if (isset($atts['show_images']) && $atts['show_images'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-bottom-left-image"
        src="<?php echo esc_url($atts['clock_bottom_left_image']); ?>"
        aria-hidden="true"
      >
      <img
        <?php if (isset($atts['show_images']) && $atts['show_images'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-bottom-right-image"
        src="<?php echo esc_url($atts['clock_bottom_right_image']); ?>"
        aria-hidden="true"
      >
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_clock', 'dpte_clock_shortcode');
