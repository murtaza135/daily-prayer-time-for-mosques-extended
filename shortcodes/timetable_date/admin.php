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

        
      Field::make('html', 'dpte_timetable_date_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable_date_color', 'Date Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the color of the date text.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable_date_color = carbon_get_theme_option('dpte_timetable_date_color');

  echo "
    <style>
      :root {
        --dpte-timetable-date-color: {$dpte_timetable_date_color};
      }
    </style>
  ";
});
