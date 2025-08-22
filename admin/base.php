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
    ->add_tab(__('Shortcodes'), [
      Field::make('html', 'dpte_shortcodes_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Available Shortcodes</h2>
          <p><b>[dpte_clock]</b> - A clock that also displays time left till Jama\'ah or the end of the Salah time.</p>
          <p><b>[dpte_timetable]</b> - A timetable showing the start and Jama\'ah times of all current prayers.</p>
          <p><b>[dpte_timetable_date]</b> - Displays today\'s dates from both the Gregorian calendar and Islamic Calendar.</p>
          <p><b>[dpte_notification_banner]</b> - A notification banner that shows time till Jama\'ah, Jama\'ah in progress, and Zawal time.</p>
        '),
    ]);
});
