<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_general_container', function($container) {
  $container
    ->add_tab(__('General'), [
      Field::make('html', 'dpte_general_settings_heading')
        ->set_html('<h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">General Settings</h2>'),
        
      Field::make('text', 'dpte_general_settings_refetch_interval_time', 'Prayer Times Refresh Interval')
        ->set_attribute("type", "number")
        ->set_default_value(10)
        ->set_help_text('How often do you want the website to refetch/refresh the prayer times (in minutes).'),

      Field::make('checkbox', 'dpte_general_settings_replace_zuhr_with_jumah', __('Replace Zuhr with Jumu\'ah'))
        ->set_default_value('yes')
        ->set_option_value('yes')
        ->set_help_text('Replace all occurrences of "Zuhr" with "Jumu\'ah" on Friday.'),

      Field::make('checkbox', 'dpte_general_settings_24_hour_time_format', __('24 Hour Format'))
        ->set_default_value('yes')
        ->set_option_value('no')
        ->set_help_text('Use the 24 hour format?'),
    ]);
});
