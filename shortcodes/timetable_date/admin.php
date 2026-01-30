<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_date_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable_date]'), [
      Field::make('html', 'dpte_timetable_date_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_timetable_date]</h2>
          <p>Displays dates from both the Gregorian calendar and Islamic Calendar.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_timetable_date]</b> - Display today\'s Gregorian and Islamic dates.</p>
          <p> - <b>[dpte_timetable_date day="today"]</b> - Same as <b>[dpte_timetable_date]</b>, without any parameters.</p>
          <p> - <b>[dpte_timetable_date day="tomorrow"]</b> - Display tomorrow\'s Gregorian and Islamic dates.</p>
        '),
    ]);
});
