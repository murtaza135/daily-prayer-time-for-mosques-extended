<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_notification_banner_shortcode($atts) {
  wp_enqueue_style("dpte-notification-banner", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte-notification-banner", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);
  wp_localize_script("dpte-notification-banner", "DPTENotificationBannerOptions", [
    "IQAMAH_TIMER" => carbon_get_theme_option('dpte_notification_banner_iqamah_timer'),
    "JAMAH_TIMER" => carbon_get_theme_option('dpte_notification_banner_jamah_timer'),
    "ZAWAL_TIMER" => carbon_get_theme_option('dpte_notification_banner_zawal_timer'),
  ]);

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
    'notification_banner_active_background' => '#CFA55B',
    'notification_banner_active_color' => '#2C2C2E',
    'notification_banner_active_icon_color' => '#2C2C2E',
    'notification_banner_error_background' => '#ac0000',
    'notification_banner_error_color' => '#FFFFFF',
    'notification_banner_error_icon_color' => '#FFFFFF',
    'notification_banner_text_size_multiplier' => '1',

    // js
    'iqamah_timer_active' => 'true',
    'jamah_timer_active' => 'true',
    'zawal_timer_active' => 'true',
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_notification_banner');

  // generate css properties from atts
  $style_keys = array(
    'notification_banner_active_background',
    'notification_banner_active_color',
    'notification_banner_active_icon_color',
    'notification_banner_error_background',
    'notification_banner_error_color',
    'notification_banner_error_icon_color',
    'notification_banner_text_size_multiplier',
  );
  $style = '';
  foreach ($style_keys as $key) {
    if (isset($atts[$key])) {
      $style .= '--dpte-' . esc_attr(str_replace('_', '-', $key)) . ':' . esc_attr($atts[$key]) . ';';
    }
  }

  // generate data attributes from atts
  $data_keys  = array('iqamah_timer_active', 'iqamah_timer_active', 'zawal_timer_active');
  $data_attrs = '';
  foreach ($data_keys as $key) {
    if (isset($atts[$key])) {
      $data_attrs .= ' data-' . esc_attr(str_replace('_', '-', $key)) . '="' . esc_attr($atts[$key]) . '"';
    }
  }

  ob_start();
  ?>
  <div class="dpte-notification-banner active" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
    <div class="dpte-notification-banner-content">
      <svg class="dpte-notification-active-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
        <path d="M60 110 Q100 40 140 110 Z" /> <!-- Main dome -->
        <rect x="50" y="110" width="100" height="50" /> <!-- Central body -->
        <rect x="90" y="130" width="20" height="30"/> <!-- Door -->
        <rect x="30" y="70" width="10" height="90" /> <!-- Left minaret -->
        <polygon points="25,70 35,50 45,70" /> <!-- Left minaret -->
        <rect x="160" y="70" width="10" height="90" /> <!-- Right minaret -->
        <polygon points="155,70 165,50 175,70" /> <!-- Right minaret -->
      </svg>
      <svg class="dpte-notification-error-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-label="No entry" fill="none">
        <circle cx="12" cy="12" r="10" stroke="inherit" stroke-width="3"/>
        <line x1="5.6" y1="5.6" x2="18.4" y2="18.4" stroke="inherit" stroke-width="3"/>
      </svg>
      <p class="dpte-notification-text">...</p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_notification_banner', 'dpte_notification_banner_shortcode');
