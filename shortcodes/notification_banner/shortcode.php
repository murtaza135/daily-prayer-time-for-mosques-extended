<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_notification_banner_shortcode() {
  wp_enqueue_style("dpte-notification-banner", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte-notification-banner", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);
  wp_localize_script("dpte-notification-banner", "DPTENotificationBannerOptions", [
    "IQAMAH_TIMER" => carbon_get_theme_option('dpte_notification_banner_error_iqamah_timer'),
    "JAMAH_TIMER" => carbon_get_theme_option('dpte_notification_banner_error_jamah_timer'),
  ]);

  ob_start();
  ?>
  <div class="dpte-notification-banner">
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
