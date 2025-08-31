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
    ),
    $atts,
    'dpte_notification_banner'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }

  ob_start();
  ?>
  <div class="dpte-clock-wrapper" <?php echo $data_attrs; ?>>
    <div class="dpte-clock">
      <ul class="dpte-hours-container">
        <li><div class="dpte-num">1</div></li>
        <li><div class="dpte-num">2</div></li>
        <li><div class="dpte-num">3</div></li>
        <li><div class="dpte-num">4</div></li>
        <li><div class="dpte-num">5</div></li>
        <li><div class="dpte-num">6</div></li>
        <li><div class="dpte-num">7</div></li>
        <li><div class="dpte-num">8</div></li>
        <li><div class="dpte-num">9</div></li>
        <li><div class="dpte-num">10</div></li>
        <li><div class="dpte-num">11</div></li>
        <li><div class="dpte-num">12</div></li>
      </ul>
      <ul class="dpte-minutes-container">
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">│</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
        <li><div class="dpte-minute-line">|</div></li>
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
