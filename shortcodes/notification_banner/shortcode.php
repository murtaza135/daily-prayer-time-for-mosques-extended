<?php

function dpte_notification_banner_shortcode() {
  wp_enqueue_style("dpte-notification-banner", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte-notification-banner", plugin_dir_url(__FILE__) . "script.js", [], null, true);

  ob_start();
  ?>
  <div class="notification-banner active">
    <div class="notification-banner-content">
      Asr Jama'ah in: 00:12:37
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_notification_banner', 'dpte_notification_banner_shortcode');
