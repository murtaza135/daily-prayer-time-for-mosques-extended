<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_date_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable_date]'), [
      Field::make('html', 'dpte_timetable_date_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Date Shortcodes
          </h2>

          <p>
            Displays dates from both the Gregorian calendar and Islamic Calendar.
          </p>

          <hr>

          <h3>dpte_timetable_date</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 130px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_timetable_date
  timetable_date_color="#CFA55B"
  timetable_date_text_size_multiplier="1"
  day="today"
]</textarea>
          </p>

          <p>
            Displays dates from both the <strong>Gregorian calendar</strong> and the
            <strong>Islamic calendar</strong>.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>timetable_date_color</code></strong> –
              Change the color of the date text.
            </li>

            <li>
              <strong><code>timetable_date_text_size_multiplier</code></strong> –
              A multiplier used to increase or decrease the date text size.
            </li>

            <li>
              <strong><code>day</code></strong> –
              Determines which date is displayed.
              <ol>
                <li><code>today</code> (default) – Displays today&rsquo;s date.</li>
                <li><code>tomorrow</code> – Displays tomorrow&rsquo;s date.</li>
              </ol>
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
