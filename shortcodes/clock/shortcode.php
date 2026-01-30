<?php
// @source: clock adapted from https://www.youtube.com/watch?v=nVGhXcMROfU

if (!defined('ABSPATH')) {
	exit;
}

function dpte_clock_shortcode($atts) {
  wp_enqueue_style("dpte_clock", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_clock", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(
      'showimages' => 'true',
      'numberslanguage' => 'english'
    ),
    $atts,
    'dpte_notification_banner'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
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
  $lang = $atts['numberslanguage'] ?? 'english';

  ob_start();
  ?>
  <div class="dpte-clock-wrapper" <?php echo $data_attrs; ?>>
    <img class="dpte-center-logo-background" src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_center_logo_image_background')); ?>" alt="">
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
      <img class="dpte-center-logo" src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_center_logo_image')); ?>" alt="">
      <div class="dpte-time-remaining">
        <div class="dpte-time-remaining-content">
          <span class="dpte-time-remaining-header"></span>
          <span class="dpte-time-remaining-value"></span>
        </div>
      </div>
      <img
        <?php if (isset($atts['showimages']) && $atts['showimages'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-top-left-image"
        src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_top_left_image')); ?>"
        alt=""
      >
      <img
        <?php if (isset($atts['showimages']) && $atts['showimages'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-top-right-image"
        src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_top_right_image')); ?>"
        alt=""
      >
      <img
        <?php if (isset($atts['showimages']) && $atts['showimages'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-bottom-left-image"
        src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_bottom_left_image')); ?>"
        alt=""
      >
      <img
        <?php if (isset($atts['showimages']) && $atts['showimages'] === "false") : ?>
          style="display: none;"
        <?php endif; ?>
        class="dpte-bottom-right-image"
        src="<?php echo esc_url(carbon_get_theme_option('dpte_clock_bottom_right_image')); ?>"
        alt=""
      >
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_clock', 'dpte_clock_shortcode');
