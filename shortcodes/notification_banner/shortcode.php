<?php

function dpte_notification_banner_shortcode() {
  wp_enqueue_style("dpte-notification-banner", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte-notification-banner", plugin_dir_url(__FILE__) . "script.js", [], null, true);

  ob_start();
  ?>
  <div class="dpte-notification-banner error">
    <div class="dpte-notification-banner-content">
    <svg class="dpte-notification-error-image" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-label="No entry" fill="none" stroke="#ffffff">
      <circle cx="12" cy="12" r="10" stroke="inherit" stroke-width="3"/>
      <line x1="5.6" y1="5.6" x2="18.4" y2="18.4" stroke="inherit" stroke-width="3"/>
    </svg>
    <p class="dpte-notification-text">Asr Jama'ah in: 00:12:37</p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_notification_banner', 'dpte_notification_banner_shortcode');
