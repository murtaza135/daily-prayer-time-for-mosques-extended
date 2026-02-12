<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_clock_container', function($container) {
  $container
    ->add_tab(__('[dpte_clock]'), [
      Field::make('html', 'dpte_clock_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Clock Shortcodes
          </h2>

          <p>
            The following shortcodes display a clock for prayer times.
          </p>

          <hr>

          <h3>dpte_clock</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 440px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_clock
  clock_background_gradient_1="#CFA55B"
  clock_background_gradient_2="#2C2C2E"
  clock_border="#2C2C2E"
  clock_number_color="#FFFFFF"
  clock_minute_line_color="#FFFFFF"
  clock_hand_hour_color_gradient_1="#ff5e9a"
  clock_hand_hour_color_gradient_2="#ffb960"
  clock_hand_minute_color_gradient_1="#ff5e9a"
  clock_hand_minute_color_gradient_2="#ffb960"
  clock_hand_second_color_gradient_1="#bbbbbbc7"
  clock_hand_second_color_gradient_2="#bbbbbbc7"
  clock_center_dot_background="#CFA55B"
  clock_center_dot_border="#2C2C2E"
  clock_time_remaining_display="show"
  clock_time_remaining_color="#FFFFFF"
  clock_center_logo_image=""
  clock_center_logo_image_scale="1"
  clock_center_logo_image_translate_x="0"
  clock_center_logo_image_translate_y="0"
  clock_center_background_logo_image=""
  clock_center_background_logo_image_scale="1"
  clock_center_background_logo_image_translate_x="0"
  clock_center_background_logo_image_translate_y="0"
  clock_top_left_image=""
  clock_top_left_image_scale="1"
  clock_top_left_image_translate_x="0"
  clock_top_left_image_translate_y="0"
  clock_top_right_image=""
  clock_top_right_image_scale="1"
  clock_top_right_image_translate_x="0"
  clock_top_right_image_translate_y="0"
  clock_bottom_left_image=""
  clock_bottom_left_image_scale="1"
  clock_bottom_left_image_translate_x="0"
  clock_bottom_left_image_translate_y="0"
  clock_bottom_right_image=""
  clock_bottom_right_image_scale="1"
  clock_bottom_right_image_translate_x="0"
  clock_bottom_right_image_translate_y="0"
  show_images="true"
  numbers_language="english"
]</textarea>
          </p>

          <p>
            A clock that also displays time left till <strong>Jama&rsquo;ah</strong> or till the
            start of the next <strong>Salah</strong> time.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li><strong><code>clock_background_gradient_1</code></strong> - First background gradient color of the clock.</li>
            <li><strong><code>clock_background_gradient_2</code></strong> - Second background gradient color of the clock.</li>
            <li><strong><code>clock_border</code></strong> - Border color of the clock.</li>
            <li><strong><code>clock_number_color</code></strong> - Color of the clock numbers.</li>
            <li><strong><code>clock_minute_line_color</code></strong> - Color of the minute indicator lines.</li>

            <li><strong><code>clock_hand_hour_color_gradient_1</code></strong> - First gradient color of the hour hand.</li>
            <li><strong><code>clock_hand_hour_color_gradient_2</code></strong> - Second gradient color of the hour hand.</li>
            <li><strong><code>clock_hand_minute_color_gradient_1</code></strong> - First gradient color of the minute hand.</li>
            <li><strong><code>clock_hand_minute_color_gradient_2</code></strong> - Second gradient color of the minute hand.</li>
            <li><strong><code>clock_hand_second_color_gradient_1</code></strong> - First gradient color of the second hand.</li>
            <li><strong><code>clock_hand_second_color_gradient_2</code></strong> - Second gradient color of the second hand.</li>

            <li><strong><code>clock_center_dot_background</code></strong> - Background color of the center dot.</li>
            <li><strong><code>clock_center_dot_border</code></strong> - Border color of the center dot.</li>
            <li>
              <strong><code>clock_time_remaining_display</code></strong> - Show or hide time remaining display.
              <ol>
                <li><code>show</code> (default) - Show time remaining display.</li>
                <li><code>hide</code> - Hide time remaining display.</li>
              </ol>
            </li>
            <li><strong><code>clock_time_remaining_color</code></strong> - Color of the time-remaining text.</li>

            <li><strong><code>clock_center_logo_image</code></strong> - URL of the center logo image.</li>
            <li><strong><code>clock_center_logo_image_scale</code></strong> - Scale factor of the center logo image.</li>
            <li><strong><code>clock_center_logo_image_translate_x</code></strong> - Horizontal translation of the center logo (%).</li>
            <li><strong><code>clock_center_logo_image_translate_y</code></strong> - Vertical translation of the center logo (%).</li>

            <li><strong><code>clock_center_background_logo_image</code></strong> - URL of the background center logo image.</li>
            <li><strong><code>clock_center_background_logo_image_scale</code></strong> - Scale factor of the background logo image.</li>
            <li><strong><code>clock_center_background_logo_image_translate_x</code></strong> - Horizontal translation of the background logo (%).</li>
            <li><strong><code>clock_center_background_logo_image_translate_y</code></strong> - Vertical translation of the background logo (%).</li>

            <li><strong><code>clock_top_left_image</code></strong> - Image displayed in the top-left corner.</li>
            <li><strong><code>clock_top_right_image</code></strong> - Image displayed in the top-right corner.</li>
            <li><strong><code>clock_bottom_left_image</code></strong> - Image displayed in the bottom-left corner.</li>
            <li><strong><code>clock_bottom_right_image</code></strong> - Image displayed in the bottom-right corner.</li>

            <li>
              <strong><code>show_images</code></strong> - Show or hide all images.
              <ol>
                <li><code>true</code> (default) - Show images only when appropriate.</li>
                <li><code>false</code> - All images are always hidden.</li>
              </ol>
            </li>
            <li>
              <strong><code>numbers_language</code></strong> - Language used for clock numbers.
              <ol>
                <li><code>english</code> (default)</li>
                <li><code>arabic</code></li>
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
