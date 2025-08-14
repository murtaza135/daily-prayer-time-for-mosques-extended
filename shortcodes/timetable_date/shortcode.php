<?php

function dpte_timetable_date_shortcode() {
  wp_enqueue_style("dpte_timetable_date", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable_date", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_fetch_cache", "dpte_date_time_utils"], null, true);

  ob_start();
  ?>
  <div class="dpte-timetable-date">
    <p class="dpte-timetable-date-gregorian"><?php echo date("d F Y") ?></p>
    <p class="dpte-timetable-date-islamic"><?php echo do_shortcode('[hijri_date]'); ?></p>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable_date', 'dpte_timetable_date_shortcode');
