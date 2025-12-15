<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_prayer_time_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2_prayer_time_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2_prayer_time_component", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(
      'prayer' => 'fajr',
      'timetype' => 'next',
      'alwaysactive' => 'false',
    ),
    $atts,
    'dpte_timetable'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }
  $prayer = strtolower($atts['prayer']);
  $activeclass = (strtolower($atts['alwaysactive']) === 'true') ? ' active' : '';

  ob_start();
  ?>
  <div class="dpte-timetable2-prayer-time-component<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
    <?php
      if ($prayer === 'fajr') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-fajr" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Fajr</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[fajr_prayer]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[fajr_start]'); ?>
              </p>
            </div>
          </div>
        <?php
      } else if ($prayer === 'sunrise') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-sunrise<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Sunrise</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[sunrise]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                -
              </p>
            </div>
          </div>
        <?php
      } else if ($prayer === 'zuhr') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-zuhr<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Zuhr</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[zuhr_prayer]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[zuhr_start]'); ?>
              </p>
            </div>
          </div>
        <?php
      } else if ($prayer === 'asr') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-asr<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Asr</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[asr_prayer]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[asr_start]'); ?>
              </p>
            </div>
          </div>
        <?php
      } else if ($prayer === 'maghrib') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-maghrib<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Maghrib</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[maghrib_prayer]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[maghrib_start]'); ?>
              </p>
            </div>
          </div>
        <?php
      } else if ($prayer === 'isha') {
        ?>
          <div class="dpte-timetable2-prayer dpte-timetable2-isha<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
            <div class="dpte-prayer-section1">
              <p class="dpte-prayer-title">Isha</p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[isha_prayer]'); ?>
              </p>
            </div>
            <div class="dpte-prayer-section2">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[isha_start]'); ?>
              </p>
            </div>
          </div>
        <?php
      }
    ?>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2_prayer_time_component', 'dpte_timetable2_prayer_time_component_shortcode');
