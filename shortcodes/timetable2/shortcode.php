<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache", "dpte_date_time_utils"], null, true);

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
    'timetable2_title_section_background' => '#CFA55B',
    'timetable2_title_section_color' => '#2C2C2E',
    'timetable2_prayer_grid_section1_background' => '#CFA55B',
    'timetable2_prayer_grid_section1_color' => '#2C2C2E',
    'timetable2_prayer_grid_section2_background' => '#2C2C2E',
    'timetable2_prayer_grid_section2_color' => '#FFFFFF',
    'timetable2_prayer_grid_item_section_separator_color' => '#FFFFFF',
    'timetable2_date_time_background' => '#CFA55B',
    'timetable2_date_time_color' => '#CFA55B',
    'timetable2_next_prayer_background' => '#CFA55B',
    'timetable2_next_prayer_color' => '#2C2C2E',
    'timetable2_prayer_grid_max_col_count' => '2',
    'timetable2_text_size_multiplier' => '1',
    
    // js
    'timetype' => 'next',
    'alwaysactive' => 'false',
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_timetable2');

  // generate css properties from atts
  $style_keys = array(
    'timetable2_title_section_background',
    'timetable2_title_section_color',
    'timetable2_prayer_grid_section1_background',
    'timetable2_prayer_grid_section1_color',
    'timetable2_prayer_grid_section2_background',
    'timetable2_prayer_grid_section2_color',
    'timetable2_prayer_grid_item_section_separator_color',
    'timetable2_date_time_background',
    'timetable2_date_time_color',
    'timetable2_next_prayer_background',
    'timetable2_next_prayer_color',
    'timetable2_prayer_grid_max_col_count',
    'timetable2_text_size_multiplier',
  );
  $style = '';
  foreach ($style_keys as $key) {
    if (isset($atts[$key])) {
      $style .= '--dpte-' . esc_attr(str_replace('_', '-', $key)) . ':' . esc_attr($atts[$key]) . ';';
    }
  }

  // generate data attributes from atts
  $data_keys  = array('timetype', 'alwaysactive');
  $data_attrs = '';
  foreach ($data_keys as $key) {
    if (isset($atts[$key])) {
      $data_attrs .= ' data-' . esc_attr(str_replace('_', '-', $key)) . '="' . esc_attr($atts[$key]) . '"';
    }
  }

  $activeclass = (strtolower($atts['alwaysactive']) === 'true') ? ' active' : '';

  ob_start();
  ?>
  <div class="dpte-timetable2" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
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
      <div class="dpte-timetable2-prayer dpte-timetable2-fajr<?php echo $activeclass; ?>" <?php echo $data_attrs; ?>>
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
