<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_shortcode() {
  wp_enqueue_style("dpte_timetable2", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);

  ob_start();
  ?>
  <div class="dpte-timetable2">
    timetable2
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2', 'dpte_timetable2_shortcode');
