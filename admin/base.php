<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_base_container', function($container) {
  $container
    ->add_tab(__('Introduction'), [
      Field::make('html', 'dpte_introduction_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Introduction</h2>
          <p>The DPTE (Daily Prayer Time Extended) plugin extends the original Daily Prayer Time plugin by mmrs151 by providing additional, nicely styled shortcodes for clocks and prayer timetables.</p>
          <p><b>Please note that in order for DPTE to work, the original Daily Prayer Time plugin by mmrs151 must be installed.</b></p>
          <p>All timetable settings must be configured via the original Daily Prayer Time plugin.</p>
        '),
    ])
    ->add_tab(__('General'), [
      Field::make('html', 'dpte_general_settings_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">General Settings</h2>
        '),
        
      Field::make('text', 'dpte_general_settings_refetch_interval_time', 'Prayer Times Refresh Interval')
        ->set_attribute("type", "number")
        ->set_default_value(10)
        ->set_help_text('How often do you want the website to refetch/refresh the prayer times (in minutes).'),
    ]);
});
