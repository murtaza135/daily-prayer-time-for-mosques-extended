<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function() {
  $dpte_base_container = Container::make('theme_options', __('DPTE'))
    ->set_page_file('dpte-options')
    ->set_icon('dashicons-clock');
  do_action('dpte_extend_base_container', $dpte_base_container);
  
  $dpte_clock_container = Container::make('theme_options', __('Clocks'))
    ->set_page_file('dpte-clock-options')
    ->set_page_parent('dpte-options');
  do_action('dpte_extend_clock_container', $dpte_clock_container);

  $dpte_timetable_container = Container::make('theme_options', __('Timetables'))
    ->set_page_file('dpte-timetable-options')
    ->set_page_parent('dpte-options');
  do_action('dpte_extend_timetable_container', $dpte_timetable_container);

  $dpte_notification_banner_container = Container::make('theme_options', __('Notification Banners'))
    ->set_page_file('dpte-notification-banner-options')
    ->set_page_parent('dpte-options');
  do_action('dpte_extend_notification_banner_container', $dpte_notification_banner_container);

  $dpte_timetable_date_container = Container::make('theme_options', __('Date'))
    ->set_page_file('dpte-timetable-date-options')
    ->set_page_parent('dpte-options');
  do_action('dpte_extend_timetable_date_container', $dpte_timetable_date_container);
});
