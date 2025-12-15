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

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable2 timetype={timetype} alwaysactive={alwaysactive}]</code></h3>

          <p>
            Displays the full prayer timetable (Design 2), showing both
            <strong>start</strong> and <strong>Jama\'ah</strong> times for all prayers.
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

            <br>

            <li>
              <strong><code>alwaysactive</code></strong> - Forces the <code>active</code> styling
              to be applied, even when the prayer is not currently active.
              Accepted values: <code>true</code> or <code>false</code> (default).
            </li>
          </ol>

          <h4>Usage</h4>
          <ol>
            <li>
              <code>[dpte_timetable2]</code> - Displays the timetable using <strong>next</strong> prayer logic.
            </li>

            <li>
              <code>[dpte_timetable2 timetype="today"]</code> - Displays today\'s prayer timetable.
            </li>

            <li>
              <code>[dpte_timetable2 timetype="tomorrow"]</code> - Displays tomorrow\'s prayer timetable.
            </li>

            <li>
              <code>[dpte_timetable2 alwaysactive="true"]</code> - Displays the timetable with all prayers styled as active.
            </li>
          </ol>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable2_date_component]</code></h3>

          <p>
            Displays the current date and time. This component is intended to be used
            alongside the Design 2 timetable layout.
          </p>

          <h4>Usage</h4>
          <pre><code>[dpte_timetable2_date_component]</code></pre>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable2_prayer_time_component prayer={prayer} timetype={timetype} alwaysactive={alwaysactive}]</code></h3>

          <p>
            Displays the time for an individual prayer. This is useful for building
            custom layouts using separate prayer components.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>prayer</code></strong> - Specifies which prayer to display.
              <ol>
                <li><code>fajr</code></li>
                <li><code>sunrise</code></li>
                <li><code>zuhr</code></li>
                <li><code>asr</code></li>
                <li><code>maghrib</code></li>
                <li><code>isha</code></li>
              </ol>
            </li>

            <br>

            <li>
              <strong><code>timetype</code></strong> - Determines which day\'s prayer time is shown.
              <ol>
                <li><code>next</code> (default) - If today\'s prayer has not yet passed, today\'s time is shown. If today\'s prayer has already passed, tomorrow\'s time is shown.</li>
                <li><code>today</code> - Displays today\'s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow\'s prayer timetable only.</li>
              </ol>
            </li>

            <br>

            <li>
              <strong><code>alwaysactive</code></strong> - Forces the <code>active</code> styling
              even if the prayer is not currently active.
              Accepted values: <code>true</code> or <code>false</code> (default).
            </li>
          </ol>

          <h4>Examples</h4>
          <pre><code>[dpte_timetable2_prayer_time_component prayer="fajr"]</code></pre>

          <pre><code>[dpte_timetable2_prayer_time_component prayer="asr" timetype="today"]</code></pre>

          <pre><code>[dpte_timetable2_prayer_time_component prayer="maghrib" alwaysactive="true"]</code></pre>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable2_time_to_prayer_component]</code></h3>

          <p>
            Displays the remaining time until the next prayer.
          </p>

          <h4>Usage</h4>
          <pre><code>[dpte_timetable2_time_to_prayer_component]</code></pre>

          <hr>

          <h3 style="margin-top: 1.5rem;"><code>[dpte_timetable2_title_component timetype={timetype}]</code></h3>

          <p>
            Displays the timetable title. The title automatically adapts based on
            the selected time context.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetype</code></strong> - Controls how the title is displayed.
              <ol>
                <li><code>next</code> (default) - If today\'s prayer has not yet passed, today\'s time is shown. If today\'s prayer has already passed, tomorrow\'s time is shown.</li>
                <li><code>today</code> - Displays today\'s prayer timetable only.</li>
                <li><code>tomorrow</code> - Displays tomorrow\'s prayer timetable only.</li>
              </ol>
            </li>
          </ol>

          <h4>Usage</h4>
          <pre><code>[dpte_timetable2_title_component]</code></pre>

          <hr>

          <p>
            <strong>Important:</strong><br>
            Providing an invalid parameter name or value will cause the shortcode
            to fail silently. Please ensure all parameters match the documentation
            exactly.
          </p>
        '),


      Field::make('html', 'dpte_timetable2_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable2_title_section_background', 'Title Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of the title.'),

      Field::make('color', 'dpte_timetable2_title_section_color', 'Title Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of title.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section1_background', 'Prayer Box - Upper Section Background Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of upper section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section1_color', 'Prayer Box - Upper Section Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of upper section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section2_background', 'Prayer Box - Lower Section Background Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Background color of lower section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section2_color', 'Prayer Box - Lower Section Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Text color of lower section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_item_section_separator_color', 'Prayer Box - Separator Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Color of separator that separates the upper and lower sections of the prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_date_time_background', 'Date Time Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of section in which the date and time is written.'),

      Field::make('color', 'dpte_timetable2_date_time_color', 'Date Time Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of section in which the date and time is written.'),

      Field::make('color', 'dpte_timetable2_next_prayer_background', 'Next Prayer Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of section in which the "time to next prayer" is written.'),

      Field::make('color', 'dpte_timetable2_next_prayer_color', 'Next Prayer Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of section in which the "time to next prayer" is written.'),

        
      Field::make('html', 'dpte_timetable2_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Prayer Grid</h2>'),

      Field::make('text', 'dpte_timetable2_prayer_grid_max_col_count', 'Max Number of Columns')
        ->set_attribute("type", "number")
        ->set_default_value(2)
        ->set_help_text('The maximum number of columns allowed in the prayer grid.'),
      
      
      Field::make('html', 'dpte_timetable2_separator_3')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Sizes</h2>'),
      
      Field::make('text', 'dpte_timetable2_text_size_multiplier', 'Text Size Multiplier')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('A multiplier for making the timetable text bigger or smaller.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable2_title_section_background = carbon_get_theme_option('dpte_timetable2_title_section_background');
  $dpte_timetable2_title_section_color = carbon_get_theme_option('dpte_timetable2_title_section_color');
  $dpte_timetable2_prayer_grid_section1_background = carbon_get_theme_option('dpte_timetable2_prayer_grid_section1_background');
  $dpte_timetable2_prayer_grid_section1_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_section1_color');
  $dpte_timetable2_prayer_grid_section2_background = carbon_get_theme_option('dpte_timetable2_prayer_grid_section2_background');
  $dpte_timetable2_prayer_grid_section2_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_section2_color');
  $dpte_timetable2_prayer_grid_item_section_separator_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_item_section_separator_color');
  $dpte_timetable2_date_time_background = carbon_get_theme_option('dpte_timetable2_date_time_background');
  $dpte_timetable2_date_time_color = carbon_get_theme_option('dpte_timetable2_date_time_color');
  $dpte_timetable2_next_prayer_background = carbon_get_theme_option('dpte_timetable2_next_prayer_background');
  $dpte_timetable2_next_prayer_color = carbon_get_theme_option('dpte_timetable2_next_prayer_color');
  $dpte_timetable2_prayer_grid_max_col_count = carbon_get_theme_option('dpte_timetable2_prayer_grid_max_col_count');
  $dpte_timetable2_text_size_multiplier = carbon_get_theme_option('dpte_timetable2_text_size_multiplier');

  echo "
    <style>
      :root {
        --dpte-timetable2-title-section-background: {$dpte_timetable2_title_section_background};
        --dpte-timetable2-title-section-color: {$dpte_timetable2_title_section_color};
        --dpte-timetable2-prayer-grid-section1-background: {$dpte_timetable2_prayer_grid_section1_background};
        --dpte-timetable2-prayer-grid-section1-color: {$dpte_timetable2_prayer_grid_section1_color};
        --dpte-timetable2-prayer-grid-section2-background: {$dpte_timetable2_prayer_grid_section2_background};
        --dpte-timetable2-prayer-grid-section2-color: {$dpte_timetable2_prayer_grid_section2_color};
        --dpte-timetable2-prayer-grid-item-section-separator-color: {$dpte_timetable2_prayer_grid_item_section_separator_color};
        --dpte-timetable2-date-time-background: {$dpte_timetable2_date_time_background};
        --dpte-timetable2-date-time-color: {$dpte_timetable2_date_time_color};
        --dpte-timetable2-next-prayer-background: {$dpte_timetable2_next_prayer_background};
        --dpte-timetable2-next-prayer-color: {$dpte_timetable2_next_prayer_color};
        --dpte-timetable2-prayer-grid-max-col-count: {$dpte_timetable2_prayer_grid_max_col_count};
        --dpte-timetable2-text-size-multiplier: {$dpte_timetable2_text_size_multiplier};
      }
    </style>
  ";
});
