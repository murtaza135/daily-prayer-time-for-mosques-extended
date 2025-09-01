<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(
      'timetype' => 'next',
    ),
    $atts,
    'dpte_timetable'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }

  ob_start();
  ?>
  <div class="dpte-timetable2" <?php echo $data_attrs; ?>>
    <div class="dpte-timetable2-title-section">
      <h2 class="dpte-timetable2-title">
        <?php
          if (isset($atts['timetype'])) {
            switch ($atts['timetype']) {
              case 'next':
                echo "Next";
                break;
              case 'today':
                echo "Today's";
                break;
              case 'tomorrow':
                echo "Tomorrow's";
                break;
              default:
                echo "Next";
                break;
            }
          }
        ?>
        Prayer Times
      </h2>
    </div>

    <div class="dpte-timetable2-prayer-grid">
      <div class="dpte-timetable2-prayer dpte-timetable2-fajr">
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

      <div class="dpte-timetable2-prayer dpte-timetable2-sunrise">
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

      <div class="dpte-timetable2-prayer dpte-timetable2-zuhr">
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

      <div class="dpte-timetable2-prayer dpte-timetable2-asr">
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

      <div class="dpte-timetable2-prayer dpte-timetable2-maghrib">
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

      <div class="dpte-timetable2-prayer dpte-timetable2-isha">
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
    </div>

    <div class="dpte-timetable2-date-time-section">
      <p class="dpte-timetable2-date"><?php echo date("l jS F Y") ?></p>
      <p class="dpte-timetable2-time"></p>
    </div>

    <div class="dpte-timetable2-next-prayer-section">
      <p class="dpte-timetable2-next-prayer-name"></p>
      <p class="dpte-timetable2-next-prayer-remaining-time"></p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2', 'dpte_timetable2_shortcode');
