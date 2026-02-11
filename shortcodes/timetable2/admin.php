<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable2]'), [
      Field::make('html', 'dpte_timetable2_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Prayer Timetable (Design 2) Shortcodes
          </h2>

          <p>
            The following shortcodes are part of the second design of the prayer timetable.
            They allow you to display a complete timetable as well as individual components
            such as prayer times, the current date, and countdowns to the next prayer.
          </p>

          <hr>

          <h3>dpte_timetable2</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 410px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable2
  timetype="next"
  alwaysactive="false"
  timetable2_title_section_background="#CFA55B"
  timetable2_title_section_color="#2C2C2E"
  timetable2_prayer_grid_section1_background="#CFA55B"
  timetable2_prayer_grid_section1_color="#2C2C2E"
  timetable2_prayer_grid_section1_active_color="#2C2C2E"
  timetable2_prayer_grid_section2_background="#2C2C2E"
  timetable2_prayer_grid_section2_color="#FFFFFF"
  timetable2_prayer_grid_section2_active_color="#FFFFFF"
  timetable2_prayer_grid_item_section_separator_color="#FFFFFF"
  timetable2_date_time_background="#CFA55B"
  timetable2_date_time_color="#2C2C2E"
  timetable2_next_prayer_background="#CFA55B"
  timetable2_next_prayer_color="#2C2C2E"
  timetable2_prayer_grid_max_col_count="2"
  timetable2_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the full prayer timetable (Design 2), showing both
            <strong>start</strong> and <strong>Jama&rsquo;ah</strong> times for all prayers.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Determines which day&rsquo;s prayer times are displayed.
              <ol>
                <li><code>next</code> (default) - Shows today&rsquo;s prayer if it has not yet passed; otherwise shows tomorrow&rsquo;s prayer.</li>
                <li><code>today</code> - Displays today&rsquo;s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow&rsquo;s prayer timetable only.</li>
              </ol>
            </li>

            <li>
              <strong><code>alwaysactive</code></strong> - Forces the active styling to be applied even when the prayer is not currently active.
              <ol>
                <li><code>false</code> (default) - Active styling is applied only when appropriate.</li>
                <li><code>true</code> - Active styling is always applied.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable2_title_section_background</code></strong> -
              Background color of the timetable title section.
            </li>

            <li>
              <strong><code>timetable2_title_section_color</code></strong> -
              Text color of the timetable title.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_background</code></strong> -
              Background color of the upper section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_color</code></strong> -
              Text color of the upper section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_active_color</code></strong> -
              Text color of the upper section of each prayer box when active.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section2_background</code></strong> -
              Background color of the lower section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section2_color</code></strong> -
              Text color of the lower section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section2_active_color</code></strong> -
              Text color of the lower section of each prayer box when active.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_item_section_separator_color</code></strong> -
              Color of the separator between the upper and lower sections of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_date_time_background</code></strong> -
              Background color of the section displaying the current date and time.
            </li>

            <li>
              <strong><code>timetable2_date_time_color</code></strong> -
              Text color of the section displaying the current date and time.
            </li>

            <li>
              <strong><code>timetable2_next_prayer_background</code></strong> -
              Background color of the section displaying the time to the next prayer.
            </li>

            <li>
              <strong><code>timetable2_next_prayer_color</code></strong> -
              Text color of the section displaying the time to the next prayer.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_max_col_count</code></strong> -
              Maximum number of columns allowed in the prayer grid layout.
            </li>

            <li>
              <strong><code>timetable2_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>
          </ol>

          <hr>

          <h3>dpte_timetable2_date_component</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 130px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable2_date_component
  timetable2_date_time_background="#CFA55B"
  timetable2_date_time_color="#2C2C2E"
  timetable2_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the current date and time. This component is intended to be used alongside the Design 2 timetable layout.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetable2_date_time_background</code></strong> -
              Background color of the section displaying the current date and time.
            </li>

            <li>
              <strong><code>timetable2_date_time_color</code></strong> -
              Text color of the section displaying the current date and time.
            </li>

            <li>
              <strong><code>timetable2_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>
          </ol>

          <hr>

          <h3>dpte_timetable2_prayer_time_component</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 290px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable2_prayer_time_component
  prayer="fajr"
  timetype="next"
  alwaysactive="false"
  timetable2_prayer_grid_section1_background="#CFA55B"
  timetable2_prayer_grid_section1_color="#2C2C2E"
  timetable2_prayer_grid_section1_active_color="#2C2C2E"
  timetable2_prayer_grid_section2_background="#2C2C2E"
  timetable2_prayer_grid_section2_color="#FFFFFF"
  timetable2_prayer_grid_section2_active_color="#FFFFFF"
  timetable2_prayer_grid_item_section_separator_color="#FFFFFF"
  timetable2_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the time for an individual prayer. This is useful for building custom layouts using separate prayer components.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>prayer</code></strong> - Specifies which prayer to display.
              <ol>
                <li><code>fajr</code> (default)</li>
                <li><code>sunrise</code></li>
                <li><code>zuhr</code></li>
                <li><code>asr</code></li>
                <li><code>maghrib</code></li>
                <li><code>isha</code></li>
                <li><code>jumah</code> or <code>jumuah</code></li>
              </ol>
            </li>

            <li>
              <strong><code>timetype</code></strong> - Determines which day&rsquo;s prayer times are displayed.
              <ol>
                <li><code>next</code> (default) - Shows today&rsquo;s prayer if it has not yet passed; otherwise shows tomorrow&rsquo;s prayer.</li>
                <li><code>today</code> - Displays today&rsquo;s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow&rsquo;s prayer timetable only.</li>
              </ol>
            </li>

            <li>
              <strong><code>alwaysactive</code></strong> - Forces the active styling to be applied even when the prayer is not currently active.
              <ol>
                <li><code>false</code> (default) - Active styling is applied only when appropriate.</li>
                <li><code>true</code> - Active styling is always applied.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_background</code></strong> -
              Background color of the upper section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_color</code></strong> -
              Text color of the upper section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section1_active_color</code></strong> -
              Text color of the upper section of each prayer box when active.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section2_background</code></strong> -
              Background color of the lower section of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_section2_color</code></strong> -
              Text color of the lower section of each prayer box.
            </li>
            
            <li>
              <strong><code>timetable2_prayer_grid_section2_active_color</code></strong> -
              Text color of the lower section of each prayer box when active.
            </li>

            <li>
              <strong><code>timetable2_prayer_grid_item_section_separator_color</code></strong> -
              Color of the separator between the upper and lower sections of each prayer box.
            </li>

            <li>
              <strong><code>timetable2_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>
          </ol>

          <hr>

          <h3>dpte_timetable2_time_to_prayer_component</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 130px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable2_time_to_prayer_component
  timetable2_next_prayer_background="#CFA55B"
  timetable2_next_prayer_color="#2C2C2E"
  timetable2_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the remaining time until the next prayer.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetable2_next_prayer_background</code></strong> -
              Background color of the section displaying the time to the next prayer.
            </li>

            <li>
              <strong><code>timetable2_next_prayer_color</code></strong> -
              Text color of the section displaying the time to the next prayer.
            </li>

            <li>
              <strong><code>timetable2_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>
          </ol>

          <hr>

          <h3>dpte_timetable2_title_component</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 150px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable2_title_component
  timetype="next"
  timetable2_title_section_background="#CFA55B"
  timetable2_title_section_color="#2C2C2E"
  timetable2_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the timetable title. The title automatically adapts based on the selected time context.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Determines which day&rsquo;s prayer times are displayed.
              <ol>
                <li><code>next</code> (default) - Shows today&rsquo;s prayer if it has not yet passed; otherwise shows tomorrow&rsquo;s prayer.</li>
                <li><code>today</code> - Displays today&rsquo;s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow&rsquo;s prayer timetable only.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable2_title_section_background</code></strong> -
              Background color of the timetable title section.
            </li>

            <li>
              <strong><code>timetable2_title_section_color</code></strong> -
              Text color of the timetable title.
            </li>

            <li>
              <strong><code>timetable2_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>
          </ol>

          <hr>

          <p>
            <strong>Important:</strong><br>
            If an invalid parameter name or value is provided, the shortcode will
            fail silently. Please ensure that all parameter names and values are entered
            exactly as documented above.
          </p>
        '),
    ]);
});
