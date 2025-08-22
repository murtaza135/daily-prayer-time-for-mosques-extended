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
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_notification_banner]</h2>
          <p>Change settings for the <b>[dpte_notification_banner]</b> shortcode.</p>
        '),

      Field::make('html', 'crb_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_notification_banner_active_background', 'Normal Notification Background Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the background color of normal notification banners.'),

      Field::make('color', 'dpte_notification_banner_active_color', 'Normal Notification Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the text color of normal notification banners.'),

      Field::make('color', 'dpte_notification_banner_active_icon_color', 'Normal Notification Icon Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the icon color of normal notification banners.'),

      Field::make('color', 'dpte_notification_banner_error_background', 'Error Notification Background Color')
        ->set_default_value('#ac0000')
        ->set_help_text('Change the background color of error notification banners (such as Zawal time notifications).'),

      Field::make('color', 'dpte_notification_banner_error_color', 'Error Notification Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Change the text color of error notification banners (such as Zawal time notifications).'),

      Field::make('color', 'dpte_notification_banner_error_icon_color', 'Error Notification Icon Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Change the icon color of error notification banners (such as Zawal time notifications).'),
      
      Field::make('html', 'crb_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Timers</h2>'),

      Field::make('text', 'dpte_notification_banner_error_iqamah_timer', 'Iqamah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(5)
        ->set_help_text('How many minutes should the notification display the countdown to Iqamah/Jama\'ah time (in minutes).'),

      Field::make('text', 'dpte_notification_banner_error_jamah_timer', 'Jama\'ah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(5)
        ->set_help_text('How long should the notification display that it is currently Jama\'ah time when Jama\'ah time starts (in minutes).'),

    ]);
});

add_action('wp_head', function() {
  $dpte_notification_banner_active_background = carbon_get_theme_option('dpte_notification_banner_active_background');
  $dpte_notification_banner_active_color = carbon_get_theme_option('dpte_notification_banner_active_color');
  $dpte_notification_banner_active_icon_color = carbon_get_theme_option('dpte_notification_banner_active_icon_color');
  $dpte_notification_banner_error_background = carbon_get_theme_option('dpte_notification_banner_error_background');
  $dpte_notification_banner_error_color = carbon_get_theme_option('dpte_notification_banner_error_color');
  $dpte_notification_banner_error_icon_color = carbon_get_theme_option('dpte_notification_banner_error_icon_color');

  echo "
    <style>
      :root {
        --dpte-notification-banner-active-background: {$dpte_notification_banner_active_background};
        --dpte-notification-banner-active-color: {$dpte_notification_banner_active_color};
        --dpte-notification-banner-active-icon-color: {$dpte_notification_banner_active_icon_color};
        --dpte-notification-banner-error-background: {$dpte_notification_banner_error_background};
        --dpte-notification-banner-error-color: {$dpte_notification_banner_error_color};
        --dpte-notification-banner-error-icon-color: {$dpte_notification_banner_error_icon_color};
      }
    </style>
  ";
});
