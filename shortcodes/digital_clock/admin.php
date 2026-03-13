<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_clock_container', function($container) {
  $container
    ->add_tab(__('[dpte_digital_clock]'), [
      Field::make('html', 'dpte_digital_clock_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Clock Shortcodes
          </h2>

          <p>
            The following shortcodes display a clock for prayer times.
          </p>

          <hr>

          <h3>dpte_digital_clock</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 110px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_digital_clock
  digital_clock_color="#CFA55B"
  digital_clock_text_size_multiplier="1"
]</textarea>
          </p>

          <p>
            Displays the digital time.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>digital_clock_color</code></strong> -
              Change the color of the digital clock time text.
            </li>

            <li>
              <strong><code>digital_clock_text_size_multiplier</code></strong> -
              A multiplier used to increase or decrease the digital clock time text size.
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
