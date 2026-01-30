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
    ]);
});
