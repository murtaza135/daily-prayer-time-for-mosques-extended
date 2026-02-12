<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_notification_banner_container', function($container) {
  $container
    ->add_tab(__('[dpte_notification_banner]'), [
      Field::make('html', 'dpte_notification_banner_heading')
        ->set_html('
          <h2 style="margin-bottom: 0.5rem; font-size: 1.4rem; font-weight: 600;">
            Notification Banner Shortcodes
          </h2>

          <p>
            Notification banners that shows time till Jama&rsquo;ah, Jama&rsquo;ah in progress, and Zawal time.
          </p>

          <hr>

          <h3>dpte_notification_banner</h3>

          <p style="margin-top: 1.5rem;">
<textarea
  readonly
  style="width: 100%; min-height: 330px; font-family: monospace; font-size: 0.9rem; line-height: 1.4; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; background: #fafafa; color: #2c2c2e; resize: none; box-sizing: border-box; white-space: pre;"
>[dpte_notification_banner
  notification_banner_active_background="#CFA55B"
  notification_banner_active_color="#2C2C2E"
  notification_banner_active_icon_color="#2C2C2E"
  notification_banner_error_background="#ac0000"
  notification_banner_error_color="#FFFFFF"
  notification_banner_error_icon_color="#FFFFFF"
  notification_banner_text_size_multiplier="1"
  iqamah_timer_active="true"
  jamah_timer_active="true"
  morning_makrooh_timer_active="true"
  zawal_makrooh_timer_active="true"
  evening_makrooh_timer_active="true"
  morning_makrooh_timer_message="Makrooh (Prohibited) Salah Time."
  zawal_makrooh_timer_message="Zawal - Makrooh (Prohibited) Salah Time."
  evening_makrooh_timer_message="Makrooh (Prohibited) Salah Time."
  default_message="Welcome."
  default_message_type="message"
]</textarea>
          </p>

          <p>
            A notification banner that shows time till <strong>Jama&rsquo;ah</strong>,
            <strong>Jama&rsquo;ah in progress</strong>, and <strong>Zawal</strong> time.
          </p>

          <h4>Parameters</h4>
          <ol>
            <li>
              <strong><code>notification_banner_active_background</code></strong> -
              Background color of normal notification banners.
            </li>

            <li>
              <strong><code>notification_banner_active_color</code></strong> -
              Text color of normal notification banners.
            </li>

            <li>
              <strong><code>notification_banner_active_icon_color</code></strong> -
              Icon color of normal notification banners.
            </li>

            <li>
              <strong><code>notification_banner_error_background</code></strong> -
              Background color of error notification banners (e.g. Zawal notifications).
            </li>

            <li>
              <strong><code>notification_banner_error_color</code></strong> -
              Text color of error notification banners.
            </li>

            <li>
              <strong><code>notification_banner_error_icon_color</code></strong> -
              Icon color of error notification banners.
            </li>

            <li>
              <strong><code>notification_banner_text_size_multiplier</code></strong> -
              Multiplier used to increase or decrease the banner text size.
            </li>

            <li>
              <strong><code>iqamah_timer_active</code></strong> -
              Enable or disable notifications when the Iqamah timer starts.
              <ol>
                <li><code>true</code> (default) - Notification is shown.</li>
                <li><code>false</code> - Notification is hidden.</li>
              </ol>
            </li>

            <li>
              <strong><code>jamah_timer_active</code></strong> -
              Enable or disable notifications when Jama&rsquo;ah time starts.
              <ol>
                <li><code>true</code> (default) - Notification is shown.</li>
                <li><code>false</code> - Notification is hidden.</li>
              </ol>
            </li>

            <li>
              <strong><code>morning_makrooh_timer_active</code></strong> -
              Enable or disable notifications during morning makrooh time.
              <ol>
                <li><code>true</code> (default) - Notification is shown.</li>
                <li><code>false</code> - Notification is hidden.</li>
              </ol>
            </li>

            <li>
              <strong><code>zawal_makrooh_timer_active</code></strong> -
              Enable or disable notifications during zawal makrooh time.
              <ol>
                <li><code>true</code> (default) - Notification is shown.</li>
                <li><code>false</code> - Notification is hidden.</li>
              </ol>
            </li>

            <li>
              <strong><code>evening_makrooh_timer_active</code></strong> -
              Enable or disable notifications during evening makrooh time.
              <ol>
                <li><code>true</code> (default) - Notification is shown.</li>
                <li><code>false</code> - Notification is hidden.</li>
              </ol>
            </li>

            <li>
              <strong><code>morning_makrooh_timer_message</code></strong> -
              Default notification message during morning makrooh time.
            </li>

            <li>
              <strong><code>zawal_makrooh_timer_message</code></strong> -
              Default notification message during zawal makrooh time.
            </li>

            <li>
              <strong><code>evening_makrooh_timer_message</code></strong> -
              Default notification message during evening makrooh time.
            </li>

            <li>
              <strong><code>default_message</code></strong> -
              Default notification message to show when no other higher priority notification message is to be displayed.
            </li>

            <li>
              <strong><code>default_message_type</code></strong> -
              Type of message to show.
              <ol>
                <li><code>message</code> (default) - The default message set with the <code>default_message</code> property.</li>
                <li><code>timer</code> - Timer to next prayer.</li>
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

      Field::make('html', 'dpte_notification_banner_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Timers</h2>'),

      Field::make('text', 'dpte_notification_banner_iqamah_timer', 'Iqamah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(2)
        ->set_help_text('How many minutes should the notification display the countdown to Iqamah/Jama\'ah time (in minutes).'),

      Field::make('text', 'dpte_notification_banner_jamah_timer', 'Jama\'ah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(5)
        ->set_help_text('How long should the notification display that it is currently Jama\'ah time when Jama\'ah time starts (in minutes).'),

      Field::make('text', 'dpte_notification_banner_morning_makrooh_timer', 'Morning Makrooh Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(20)
        ->set_help_text('How many minutes should the notification display the countdown until the morning makrooh time finishes after the end of Fajr (in minutes).'),

      Field::make('text', 'dpte_notification_banner_zawal_makrooh_timer', 'Zawal Makrooh Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(20)
        ->set_help_text('How many minutes should the notification display the countdown until Zawal time finishes and Zuhr starts (in minutes).'),

      Field::make('text', 'dpte_notification_banner_evening_makrooh_timer', 'Evening Makrooh Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(20)
        ->set_help_text('How many minutes should the notification display the countdown until the evening makrooh time finishes and Maghrib starts (in minutes).'),
    ]);
});
