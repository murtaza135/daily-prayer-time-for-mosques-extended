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
          <p>Change settings for the <b>[dpte_timetable_date]</b> shortcode.</p>
        '),

      Field::make('html', 'crb_separator_timetable_date_colors')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable_date_color', 'Date Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the color of the date text.'),

      Field::make('color', 'dpte_timetable_date_background', 'Background Color')
        ->set_default_value('#00000000')
        ->set_help_text('Change the background of the date.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable_date_color = carbon_get_theme_option('dpte_timetable_date_color');
  $dpte_timetable_date_background = carbon_get_theme_option('dpte_timetable_date_background');

  echo "
    <style>
      :root {
        --dpte-timetable-date-color: {$dpte_timetable_date_color};
        --dpte-timetable-date-background: {$dpte_timetable_date_background};
      }
    </style>
  ";
});
