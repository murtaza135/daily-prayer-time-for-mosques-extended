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
            The following shortcodes allow you to display prayer timetables and individual
            prayer times. Each shortcode supports parameters that control which prayers
            are shown and which day\'s times are displayed.
          </p>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable timetype="{timetype}"]</code></h3>

          <p>
            Displays a full prayer timetable showing the <strong>start</strong> and
            <strong>Jama\'ah</strong> times for all prayers.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Determines which day\'s prayer times are displayed.
              <ol>
                <li><code>next</code> (default) - If today\'s prayer has not yet passed, today\'s time is shown. If today\'s prayer has already passed, tomorrow\'s time is shown.</li>
                <li><code>today</code> - Displays today\'s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow\'s prayer timetable only.</li>
              </ol>
            </li>
          </ol>

          <h4>Usage</h4>
          <ol>
            <li>
              <code>[dpte_timetable2]</code> - Displays the timetable using <strong>next</strong> prayer logic.
            </li>

            <li>
              <code>[dpte_timetable2 timetype="next"]</code> - Displays the timetable using <strong>next</strong> prayer logic.
            </li>

            <li>
              <code>[dpte_timetable2 timetype="today"]</code> - Displays today\'s prayer timetable.
            </li>

            <li>
              <code>[dpte_timetable2 timetype="tomorrow"]</code> - Displays tomorrow\'s prayer timetable.
            </li>
          </ol>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable_prayer_time_component prayer="{prayer}" timetype="{timetype}"]</code></h3>

          <p>
            Displays the time for a <strong>single prayer</strong>.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Determines which day\'s prayer time is shown.
              <br>
              Accepted values:
              <ol>
                <li><code>next</code> (default) - If today\'s prayer has not yet passed, today\'s time is shown. If today\'s prayer has already passed, tomorrow\'s time is shown.</li>
                <li><code>today</code> - Displays today\'s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow\'s prayer timetable only.</li>
              </ol>
            </li>

            <br>

            <li>
              <strong><code>prayer</code></strong> - Specifies which prayer to display.
              <br>
              Accepted values:
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
          </ol>

          <h4>Examples</h4>
          <pre><code>[dpte_timetable_prayer_time_component prayer="fajr"]</code></pre>

          <pre><code>[dpte_timetable_prayer_time_component prayer="asr" timetype="today"]</code></pre>

          <pre><code>[dpte_timetable_prayer_time_component prayer="jumah" timetype="next"]</code></pre>

          <hr>

          <p>
            <strong>Important:</strong><br>
            If an invalid parameter name or value is provided, the shortcode will
            fail silently. Please ensure that all parameter names and values are entered
            exactly as documented above.
          </p>
        '),


      Field::make('html', 'dpte_timetable_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable_prayer_header_text_color', 'Header Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Color of the text in the timetable header.'),

      Field::make('color', 'dpte_timetable_prayer_background_gradient_1', 'Background Gradient 1')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 2" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_background_gradient_2', 'Background Gradient 2')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 1" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_active_color', 'Active Prayer Border Color')
        ->set_default_value('#ff5e00')
        ->set_help_text('Border color used for the currently active prayer in the timetable.'),

      Field::make('color', 'dpte_timetable_prayer_title_color', 'Prayer Name Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color for prayer titles (e.g., Fajr, Dhuhr, Asr, Maghrib, Isha).'),

      Field::make('color', 'dpte_timetable_prayer_values_color', 'Prayer Values Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Text color for the prayer times/values.'),

      Field::make('color', 'dpte_timetable_prayer_icon_color', 'Prayer Icon Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Color of icons shown alongside prayer titles.'),

        
      Field::make('html', 'dpte_timetable_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Icons</h2>'),

      Field::make('checkbox', 'dpte_timetable_icon_resize_animation_running', __('Icon Animation'))
        ->set_default_value('running')
        ->set_option_value('running')
        ->set_help_text('Activate the prayer icons\' resize animation.'),

      Field::make('text', 'dpte_timetable_prayer_icon_resize_animation_duration', 'Icon Animation Duration')
        ->set_attribute("type", "number")
        ->set_default_value(5000)
        ->set_help_text('Duration of prayer icons\' resize animation (in ms).'),


      Field::make('html', 'dpte_timetable_separator_3')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Sizes</h2>'),
      
      Field::make('text', 'dpte_timetable_text_size_multiplier', 'Text Size Multiplier')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('A multiplier for making the timetable text bigger or smaller.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable_prayer_header_text_color = carbon_get_theme_option('dpte_timetable_prayer_header_text_color');
  $dpte_timetable_prayer_background_gradient_1 = carbon_get_theme_option('dpte_timetable_prayer_background_gradient_1');
  $dpte_timetable_prayer_background_gradient_2 = carbon_get_theme_option('dpte_timetable_prayer_background_gradient_2');
  $dpte_timetable_prayer_active_color = carbon_get_theme_option('dpte_timetable_prayer_active_color');
  $dpte_timetable_prayer_title_color = carbon_get_theme_option('dpte_timetable_prayer_title_color');
  $dpte_timetable_prayer_values_color = carbon_get_theme_option('dpte_timetable_prayer_values_color');
  $dpte_timetable_prayer_icon_color = carbon_get_theme_option('dpte_timetable_prayer_icon_color');
  $dpte_timetable_icon_resize_animation_running = carbon_get_theme_option('dpte_timetable_icon_resize_animation_running') ? "running" : "paused";
  $dpte_timetable_prayer_icon_resize_animation_duration = carbon_get_theme_option('dpte_timetable_prayer_icon_resize_animation_duration');
  $dpte_timetable_text_size_multiplier = carbon_get_theme_option('dpte_timetable_text_size_multiplier');

  echo "
    <style>
      :root {
        --dpte-timetable-prayer-header-text-color: {$dpte_timetable_prayer_header_text_color};
        --dpte-timetable-prayer-background-gradient-1: {$dpte_timetable_prayer_background_gradient_1};
        --dpte-timetable-prayer-background-gradient-2: {$dpte_timetable_prayer_background_gradient_2};
        --dpte-timetable-prayer-active-color: {$dpte_timetable_prayer_active_color};
        --dpte-timetable-prayer-title-color: {$dpte_timetable_prayer_title_color};
        --dpte-timetable-prayer-values-color: {$dpte_timetable_prayer_values_color};
        --dpte-timetable-prayer-icon-color: {$dpte_timetable_prayer_icon_color};
        --dpte-timetable-icon-resize-animation-running: {$dpte_timetable_icon_resize_animation_running};
        --dpte-timetable-prayer-icon-resize-animation-duration: {$dpte_timetable_prayer_icon_resize_animation_duration}ms;
        --dpte-timetable-text-size-multiplier: {$dpte_timetable_text_size_multiplier};
      }
    </style>
  ";
});
