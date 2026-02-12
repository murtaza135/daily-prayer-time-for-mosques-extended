<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable]'), [
      Field::make('html', 'dpte_timetable_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Prayer Timetable (Design 1) Shortcodes
          </h2>

          <p>
            Displays a complete prayer timetable including prayer names, times,
            active prayer highlighting, animations, and visual customization.
          </p>

          <hr>

          <h3>dpte_timetable</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 350px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable
  timetype="next"
  timetable_prayer_header_text_color="#2C2C2E"
  timetable_prayer_background_gradient_1="#CFA55B"
  timetable_prayer_background_gradient_2="#2C2C2E"
  timetable_prayer_active_color="#ff5e00"
  timetable_prayer_active_border_thickness="3px"
  timetable_prayer_title_color="#2C2C2E"
  timetable_prayer_start_values_color="#FFFFFF"
  timetable_prayer_jamah_values_color="#FFFFFF"
  timetable_prayer_icon_color="#2C2C2E"
  timetable_icon_resize_animation_running="running"
  timetable_prayer_icon_resize_animation_duration="5000ms"
  timetable_text_size_multiplier="1"
  timetable_prayer_jumah_display="hide"
]</textarea>
          </p>

          <p>
            Displays a full prayer timetable showing the <strong>start</strong> and
            <strong>Jama&rsquo;ah</strong> times for all prayers.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Determines which day&rsquo;s prayer times are displayed.
              <ol>
                <li><code>next</code> (default) - Shows today&rsquo;s prayer if it has not yet passed; otherwise shows
                  tomorrow&rsquo;s prayer.</li>
                <li><code>today</code> - Displays today&rsquo;s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow&rsquo;s prayer timetable only.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable_prayer_header_text_color</code></strong> -
              Color of the text displayed in the timetable header.
            </li>

            <li>
              <strong><code>timetable_prayer_background_gradient_1</code></strong> -
              First color used for the background gradient of each prayer row.
            </li>

            <li>
              <strong><code>timetable_prayer_background_gradient_2</code></strong> -
              Second color used for the background gradient of each prayer row.
              Set this to the same value as Gradient 1 to disable the gradient.
            </li>

            <li>
              <strong><code>timetable_prayer_active_color</code></strong> -
              Border color applied to the currently active prayer.
            </li>

            <li>
              <strong><code>timetable_prayer_active_border_thickness</code></strong> -
              Border thickness of the currently active prayer.
            </li>

            <li>
              <strong><code>timetable_prayer_title_color</code></strong> -
              Text color of prayer names such as Fajr, Zuhr, Asr, Maghrib, and Isha.
            </li>

            <li>
              <strong><code>timetable_prayer_start_values_color</code></strong> -
              Text color of the prayer start time values.
            </li>

            <li>
              <strong><code>timetable_prayer_jamah_values_color</code></strong> -
              Text color of the prayer jamah time values.
            </li>

            <li>
              <strong><code>timetable_prayer_icon_color</code></strong> -
              Color of icons displayed next to prayer names.
            </li>

            <li>
              <strong><code>timetable_icon_resize_animation_running</code></strong> -
              Enables or disables the resize animation applied to prayer icons.
              <ol>
                <li><code>running</code> (default) - Animation is enabled.</li>
                <li><code>paused</code> - Animation is disabled.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable_prayer_icon_resize_animation_duration</code></strong> -
              Duration of the prayer icon resize animation. You must specify the units of time, e.g. 5s or 5000ms.
            </li>

            <li>
              <strong><code>timetable_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the size of all timetable text.
            </li>

            <li>
              <strong><code>timetable_prayer_jumah_display</code></strong> -
              Show or hide Jumah prayer bar.
              <ol>
                <li><code>hide</code> (default) - Hide Jumah prayer bar.</li>
                <li><code>show</code> - Show Jumah prayer bar.</li>
              </ol>
            </li>
          </ol>

          <hr>

          <h3>dpte_timetable_prayer_time_component</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 290px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable_prayer_time_component
  prayer="fajr"
  timetype="next"
  timetable_prayer_background_gradient_1="#CFA55B"
  timetable_prayer_background_gradient_2="#2C2C2E"
  timetable_prayer_active_color="#ff5e00"
  timetable_prayer_active_border_thickness="3px"
  timetable_prayer_title_color="#2C2C2E"
  timetable_prayer_start_values_color="#FFFFFF"
  timetable_prayer_jamah_values_color="#FFFFFF"
  timetable_prayer_icon_color="#2C2C2E"
  timetable_icon_resize_animation_running="running"
  timetable_prayer_icon_resize_animation_duration="5000ms"
  timetable_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the time for a <strong>single prayer</strong>.
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
                <li><code>next</code> (default) - Shows today&rsquo;s prayer if it has not yet passed; otherwise shows
                  tomorrow&rsquo;s prayer.</li>
                <li><code>today</code> - Displays today&rsquo;s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow&rsquo;s prayer timetable only.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable_prayer_background_gradient_1</code></strong> -
              First color used for the background gradient of each prayer row.
            </li>

            <li>
              <strong><code>timetable_prayer_background_gradient_2</code></strong> -
              Second color used for the background gradient of each prayer row.
              Set this to the same value as Gradient 1 to disable the gradient.
            </li>

            <li>
              <strong><code>timetable_prayer_active_color</code></strong> -
              Border color applied to the currently active prayer.
            </li>

            <li>
              <strong><code>timetable_prayer_active_border_thickness</code></strong> -
              Border thickness of the currently active prayer.
            </li>

            <li>
              <strong><code>timetable_prayer_title_color</code></strong> -
              Text color of prayer names such as Fajr, Zuhr, Asr, Maghrib, and Isha.
            </li>

            <li>
              <strong><code>timetable_prayer_start_values_color</code></strong> -
              Text color of the prayer start time values.
            </li>

            <li>
              <strong><code>timetable_prayer_jamah_values_color</code></strong> -
              Text color of the prayer jamah time values.
            </li>

            <li>
              <strong><code>timetable_prayer_icon_color</code></strong> -
              Color of icons displayed next to prayer names.
            </li>

            <li>
              <strong><code>timetable_icon_resize_animation_running</code></strong> -
              Enables or disables the resize animation applied to prayer icons.
              <ol>
                <li><code>running</code> (default) - Animation is enabled.</li>
                <li><code>paused</code> - Animation is disabled.</li>
              </ol>
            </li>

            <li>
              <strong><code>timetable_prayer_icon_resize_animation_duration</code></strong> -
              Duration of the prayer icon resize animation. You must specify the units of time, e.g. 5s or 5000ms.
            </li>

            <li>
              <strong><code>timetable_text_size_multiplier</code></strong> -
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
