<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function() {
  $main_options_container = Container::make('theme_options', __('DPTE'))
    ->set_page_file('dpte-options')
    ->set_icon('dashicons-clock')
    ->add_tab(__('General'), [
      Field::make('text', 'dpte_general_message', 'General Message')
        ->set_help_text('This is a general message for DPTE plugin.'),
    ]);

  
  Container::make('theme_options', __('Clocks'))
    ->set_page_parent('dpte-options')
    ->add_tab(__('Clock'), [
      Field::make('html', 'dpte_clock_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Clock - [dpte_clock]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_clock_color', 'Clock Highlight Color')
        ->set_default_value('#ff0000'),
    ]);

  Container::make('theme_options', __('Timetables'))
    ->set_page_parent('dpte-options')
    ->add_tab(__('Timetable'), [
      Field::make('html', 'dpte_timetable_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Timetable - [dpte_timetable]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_timetable_color', 'Timetable Highlight Color')
        ->set_default_value('#ff0000'),
    ]);

  Container::make('theme_options', __('Notification Banners'))
    ->set_page_parent('dpte-options')
    ->add_tab(__('Notification Banner'), [
      Field::make('html', 'dpte_notification_banner_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Notification Banner - [dpte_notification_banner]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_notification_banner_color', 'Notification Banner Highlight Color')
        ->set_default_value('#ff0000'),
    ]);

  Container::make('theme_options', __('Date'))
    ->set_page_parent('dpte-options')
    ->add_tab(__('Date'), [
      Field::make('html', 'dpte_timetable_date_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Date - [dpte_timetable_date]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_timetable_date_color', 'Date Highlight Color')
        ->set_default_value('#ff0000'),
    ]);

  Container::make('theme_options', __('Announcements'))
    ->set_page_parent('dpte-options')
    ->add_tab(__('Announcement'), [
      Field::make('html', 'dpte_announcement_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Announcement - [dpte_announcement]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_announcement_color', 'Announcement Highlight Color')
        ->set_default_value('#ff0000'),
    ]);
});

add_action('wp_head', function() {
  $primary = carbon_get_theme_option('dpte_clock_color');

  echo "
    <style>
      :root {
        --dpte-clock-background: {$primary};
      }
    </style>
  ";
});
