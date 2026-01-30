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
    ]);
});
