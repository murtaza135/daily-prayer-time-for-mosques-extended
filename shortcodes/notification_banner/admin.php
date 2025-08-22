<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_notification_banner_container', function($container) {
  $container
    ->add_tab(__('Notification Banner'), [
      Field::make('html', 'dpte_notification_banner_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Notification Banner - [dpte_notification_banner]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_notification_banner_color', 'Notification Banner Highlight Color')
        ->set_default_value('#ff0000'),
    ]);
});
