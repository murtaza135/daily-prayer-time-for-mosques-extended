<?php

function dpte_timetable_shortcode() {
  wp_enqueue_style("dpte_timetable", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable", plugin_dir_url(__FILE__) . "script.js", [], null, true);

  ob_start();
  ?>
  <table class="dptUserStyles">
    <thead>
      <tr>
        <th>Prayer</th>
        <th>Start Time</th>
        <th>Jama’ah Time</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Fajr</td>
        <td><span class="dpt_start"><?php echo do_shortcode('[fajr_start]'); ?></span></td>
        <td><span class="dpt_jamah"><?php echo do_shortcode('[fajr_prayer]'); ?></span></td>
      </tr>
      <tr>
        <td>Dhuhr</td>
        <td><span class="dpt_start"><?php echo do_shortcode('[zuhr_start]'); ?></span></td>
        <td><span class="dpt_jamah"><?php echo do_shortcode('[zuhr_prayer]'); ?></span></td>
      </tr>
      <tr>
        <td>Asr</td>
        <td><span class="dpt_start"><?php echo do_shortcode('[asr_start]'); ?></span></td>
        <td><span class="dpt_jamah"><?php echo do_shortcode('[asr_prayer]'); ?></span></td>
      </tr>
      <tr>
        <td>Maghrib</td>
        <td><span class="dpt_start"><?php echo do_shortcode('[maghrib_start]'); ?></span></td>
        <td><span class="dpt_jamah"><?php echo do_shortcode('[maghrib_prayer]'); ?></span></td>
      </tr>
      <tr>
        <td>Isha</td>
        <td><span class="dpt_start"><?php echo do_shortcode('[isha_start]'); ?></span></td>
        <td><span class="dpt_jamah"><?php echo do_shortcode('[isha_prayer]'); ?></span></td>
      </tr>
    </tbody>
  </table>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable', 'dpte_timetable_shortcode');