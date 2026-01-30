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
          <p>A notification banner that shows time till Jama\'ah, Jama\'ah in progress, and Zawal time.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_notification_banner]</b> - Display notification banner for all options.</p>
          <p> - <b>[dpte_notification_banner iqamahtimer="false"]</b> - Do not display notification banner for the countdown to Iqamah/Jama\'ah time.</p>
          <p> - <b>[dpte_notification_banner jamahtimer="false"]</b> - Do not display notification banner when Jama\'ah time starts.</p>
          <p> - <b>[dpte_notification_banner zawaltimer="false"]</b> - Do not display notification banner during Zawal time.</p>
          <p>You can use multiple options together if you wish.</p>
        '),

      Field::make('html', 'dpte_notification_banner_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Timers</h2>'),

      Field::make('text', 'dpte_notification_banner_iqamah_timer', 'Iqamah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(5)
        ->set_help_text('How many minutes should the notification display the countdown to Iqamah/Jama\'ah time (in minutes).'),

      Field::make('text', 'dpte_notification_banner_jamah_timer', 'Jama\'ah Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(5)
        ->set_help_text('How long should the notification display that it is currently Jama\'ah time when Jama\'ah time starts (in minutes).'),

      Field::make('text', 'dpte_notification_banner_zawal_timer', 'Zawal Notification Timer')
        ->set_attribute("type", "number")
        ->set_default_value(20)
        ->set_help_text('How many minutes should the notification display the countdown until Zawal time finishes and Zuhr starts (in minutes).'),
    ]);
});
