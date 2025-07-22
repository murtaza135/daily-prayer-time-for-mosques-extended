<?php

function dpte_timetable_shortcode() {
  wp_enqueue_style("dpte_timetable", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_fetch_cache", "dpte_date_time_utils"], null, true);

  ob_start();
  ?>
  <div class="dpte-timetable">
    <div class="dpte-timetable-date">
      <p class="dpte-timetable-date-gregorian"><?php echo date("d F Y") ?></p>
      <p class="dpte-timetable-date-islamic"><?php echo do_shortcode('[hijri_date]'); ?></p>
    </div>
    <div class="dpte-timetable-prayer-list">
      <div class="dpte-timetable-prayer-header">
          <p>Start</p>
          <p>Jama'ah</p>
      </div>

      <div class="dpte-timetable-prayer dpte-timetable-fajr">
        <span>
          <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
            <circle cx="32" cy="40" r="12" fill="inherit" />
            <path d="M10 28h44" stroke="inherit" stroke-width="2" />
            <path d="M32 10v10M20 14l4 6M44 14l-4 6" stroke="inherit" stroke-width="2" />
          </svg>
          <p class="dpte-prayer-title">Fajr</p>
        </span>
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[fajr_start]'); ?></p>
          <p class="dpte-prayer-prayer"><?php echo do_shortcode('[fajr_prayer]'); ?></p>
        </span>
      </div>

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
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[sunrise]'); ?></p>
        </span>
      </div>

      <div class="dpte-timetable-prayer dpte-timetable-zuhr">
        <span>
          <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
            <circle cx="32" cy="32" r="12" fill="inherit" />
            <g stroke="inherit" stroke-width="2">
              <path d="M32 8v8M32 48v8M8 32h8M48 32h8M16 16l6 6M42 42l6 6M16 48l6-6M42 22l6-6" />
            </g>
          </svg>
          <p class="dpte-prayer-title">Zuhr</p>
        </span>
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[zuhr_start]'); ?></p>
          <p class="dpte-prayer-prayer"><?php echo do_shortcode('[zuhr_prayer]'); ?></p>
        </span>
      </div>

      <div class="dpte-timetable-prayer dpte-timetable-asr">
        <span>
          <svg class="dpte-timetable-prayer-icon" viewBox="0 0 64 64" fill="#000" stroke="#000">
            <circle cx="24" cy="24" r="10" fill="inherit" />
            <path d="M20 34a8 8 0 0116 0h8a6 6 0 010 12H18a6 6 0 012-12h2z" fill="inherit" stroke="inherit"
              stroke-width="2" />
          </svg>
          <p class="dpte-prayer-title">Asr</p>
        </span>
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[asr_start]'); ?></p>
          <p class="dpte-prayer-prayer"><?php echo do_shortcode('[asr_prayer]'); ?></p>
        </span>
      </div>

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
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[maghrib_start]'); ?></p>
          <p class="dpte-prayer-prayer"><?php echo do_shortcode('[maghrib_prayer]'); ?></p>
        </span>
      </div>

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
        <span>
          <p class="dpte-prayer-start"><?php echo do_shortcode('[isha_start]'); ?></p>
          <p class="dpte-prayer-prayer"><?php echo do_shortcode('[isha_prayer]'); ?></p>
        </span>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable', 'dpte_timetable_shortcode');