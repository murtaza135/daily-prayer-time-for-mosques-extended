<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable_prayer_time_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable_prayer_time_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable_prayer_time_component", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_cache"], null, true);

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
    'prayer' => 'fajr',

    // css
    'timetable_prayer_background_gradient_1' => '#CFA55B',
    'timetable_prayer_background_gradient_2' => '#2C2C2E',
    'timetable_prayer_active_color' => '#ff5e00',
    'timetable_prayer_active_border_thickness' => '3px',
    'timetable_prayer_title_color' => '#2C2C2E',
    'timetable_prayer_start_values_color' => '#FFFFFF',
    'timetable_prayer_jamah_values_color' => '#FFFFFF',
    'timetable_prayer_icon_color' => '#2C2C2E',
    'timetable_icon_resize_animation_running' => 'running',
    'timetable_prayer_icon_resize_animation_duration' => '5000',
    'timetable_text_size_multiplier' => '1',

    // js
    'timetype' => 'next',
  );
  $atts = shortcode_atts($default_atts, $atts, 'dpte_timetable_prayer_time_component');

  // generate css properties from atts
  $style_keys = array(
    'timetable_prayer_background_gradient_1',
    'timetable_prayer_background_gradient_2',
    'timetable_prayer_active_color',
    'timetable_prayer_active_border_thickness',
    'timetable_prayer_title_color',
    'timetable_prayer_start_values_color',
    'timetable_prayer_jamah_values_color',
    'timetable_prayer_icon_color',
    'timetable_icon_resize_animation_running',
    'timetable_prayer_icon_resize_animation_duration',
    'timetable_text_size_multiplier',
  );
  $style = '';
  foreach ($style_keys as $key) {
    if (isset($atts[$key])) {
      $style .= '--dpte-' . esc_attr(str_replace('_', '-', $key)) . ':' . esc_attr($atts[$key]) . ';';
    }
  }

  // generate data attributes from atts
  $data_keys  = array('timetype');
  $data_attrs = '';
  foreach ($data_keys as $key) {
    if (isset($atts[$key])) {
      $data_attrs .= ' data-' . esc_attr(str_replace('_', '-', $key)) . '="' . esc_attr($atts[$key]) . '"';
    }
  }

  $prayer = strtolower($atts['prayer']);

  ob_start();
  ?>
  <div class="dpte-timetable-prayer-time-component" style="<?php echo esc_attr($style); ?>" <?php echo $data_attrs; ?>>
    <?php
      if ($prayer === 'fajr') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-fajr">
            <span>
              <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
                <circle cx="32" cy="40" r="12" fill="inherit" />
                <path d="M10 28h44" stroke="inherit" stroke-width="2" />
                <path d="M32 10v10M20 14l4 6M44 14l-4 6" stroke="inherit" stroke-width="2" />
              </svg>
              <p class="dpte-prayer-title">Fajr</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[fajr_start]'); ?>
              </p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[fajr_prayer]'); ?>
              </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'sunrise') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-sunrise">
            <span>
              <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
              <g transform="translate(0, -14)">
                <circle cx="32" cy="48" r="12" fill="inherit" />
                <path d="M10 52h44M32 38v-8" stroke="inherit" stroke-width="2" />
                <path d="M22 40l-4-4M42 40l4-4" stroke="inherit" stroke-width="2" />
              </g>
            </svg>
              <p class="dpte-prayer-title">Sunrise</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[sunrise]'); ?>
              </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'zuhr') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-zuhr">
            <span>
              <svg class="dpte-timetable-prayer-icon dpte-timetable-prayer-icon-zuhr" viewBox="0 0 64 64" fill="#000" stroke="#000">
                <circle cx="32" cy="32" r="12" fill="inherit" />
                <g stroke="inherit" stroke-width="2">
                  <path d="M32 8v8M32 48v8M8 32h8M48 32h8M16 16l6 6M42 42l6 6M16 48l6-6M42 22l6-6" />
                </g>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="dpte-timetable-prayer-icon dpte-timetable-prayer-icon-jumah hidden" viewBox="0 0 200 200" fill="#000">
                <path d="M60 110 Q100 40 140 110 Z" /> <!-- Main dome -->
                <rect x="50" y="110" width="100" height="50" /> <!-- Central body -->
                <rect x="90" y="130" width="20" height="30"/> <!-- Door -->
                <rect x="30" y="70" width="10" height="90" /> <!-- Left minaret -->
                <polygon points="25,70 35,50 45,70" /> <!-- Left minaret -->
                <rect x="160" y="70" width="10" height="90" /> <!-- Right minaret -->
                <polygon points="155,70 165,50 175,70" /> <!-- Right minaret -->
              </svg>
              <p class="dpte-prayer-title">Zuhr</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[zuhr_start]'); ?>
            </p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[zuhr_prayer]'); ?>
            </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'asr') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-asr">
            <span>
              <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
                <circle cx="24" cy="24" r="10" fill="inherit" />
                <path d="M20 34a8 8 0 0116 0h8a6 6 0 010 12H18a6 6 0 012-12h2z" fill="inherit" stroke="inherit"
                  stroke-width="2" />
              </svg>
              <p class="dpte-prayer-title">Asr</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[asr_start]'); ?>
            </p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[asr_prayer]'); ?>
            </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'maghrib') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-maghrib">
            <span>
              <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
                <circle cx="32" cy="34" r="12" fill="inherit" />
                <path d="M10 38h44" stroke="inherit" stroke-width="2" />
                <path d="M32 46v6" stroke="inherit" stroke-width="2" />
                <path d="M26 44l-4 6" stroke="inherit" stroke-width="2" />
                <path d="M38 44l4 6" stroke="inherit" stroke-width="2" />
              </svg>
              <p class="dpte-prayer-title">Maghrib</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[maghrib_start]'); ?>
            </p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[maghrib_prayer]'); ?>
            </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'isha') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-isha">
            <span>
              <svg class="dpte-timetable-prayer-icon" stroke-width="1.5" viewBox="0 0 24 24" fill="#000" stroke="#000"
                xmlns="http://www.w3.org/2000/svg" color="#000">
                <path
                  d="M3 11.5066C3 16.7497 7.25034 21 12.4934 21C16.2209 21 19.4466 18.8518 21 15.7259C12.4934 15.7259 8.27411 11.5066 8.27411 3C5.14821 4.55344 3 7.77915 3 11.5066Z"
                  stroke="inherit" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <p class="dpte-prayer-title">Isha</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-start" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[isha_start]'); ?>
            </p>
              <p class="dpte-prayer-prayer" <?php echo $data_attrs; ?>>
                <?php echo do_shortcode('[isha_prayer]'); ?>
            </p>
            </span>
          </div>
        <?php
      } else if ($prayer === 'jumah' || $prayer === 'jumuah') {
        ?>
          <div class="dpte-timetable-prayer dpte-timetable-jumah">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" class="dpte-timetable-prayer-icon" viewBox="0 0 200 200" fill="#000">
                <path d="M60 110 Q100 40 140 110 Z" /> <!-- Main dome -->
                <rect x="50" y="110" width="100" height="50" /> <!-- Central body -->
                <rect x="90" y="130" width="20" height="30"/> <!-- Door -->
                <rect x="30" y="70" width="10" height="90" /> <!-- Left minaret -->
                <polygon points="25,70 35,50 45,70" /> <!-- Left minaret -->
                <rect x="160" y="70" width="10" height="90" /> <!-- Right minaret -->
                <polygon points="155,70 165,50 175,70" /> <!-- Right minaret -->
              </svg>
              <p class="dpte-prayer-title">Jumu'ah</p>
            </span>
            <span class="dpte-prayer-values">
              <p class="dpte-prayer-prayer">
                <?php echo str_replace(["Jumuah", "|"], ["", "&"], do_shortcode('[jummah_prayer]')); ?>
              </p>
            </span>
          </div>
        <?php
      }
    ?>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable_prayer_time_component', 'dpte_timetable_prayer_time_component_shortcode');
