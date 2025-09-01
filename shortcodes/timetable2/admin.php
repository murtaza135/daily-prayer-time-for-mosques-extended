<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable2]'), [
      Field::make('html', 'dpte_timetable2_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_timetable2]</h2>
          <p>A second design of a timetable showing the start and Jama\'ah times of all prayers.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_timetable2]</b> - Display prayer timetable, where the times displayed are of the next prayer. For example, if today\'s Asr has NOT yet passed, then today\'s Asr time will be displayed. If today\'s Asr HAS passed, then tomorrow\'s Asr will be displayed.</p>
          <p> - <b>[dpte_timetable2 timetype="next"]</b> - Same as <b>[dpte_timetable2]</b>, without any parameters.</p>
          <p> - <b>[dpte_timetable2 timetype="today"]</b> - Display today\'s prayer timetable.</p>
          <p> - <b>[dpte_timetable2 timetype="tomorrow"]</b> - Display tomorrow\'s prayer timetable.</p>
          <p><b>Warning:</b> Inputing a non-existing parameter name or value will silently fail. So please ensure the argument name and value are correct.</p>
        '),


      Field::make('html', 'dpte_timetable2_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable2_title_section_background', 'Title Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of the title.'),

      Field::make('color', 'dpte_timetable2_title_section_color', 'Title Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of title.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section1_background', 'Prayer Box - Upper Section Background Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of upper section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section1_color', 'Prayer Box - Upper Section Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of upper section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section2_background', 'Prayer Box - Lower Section Background Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Background color of lower section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_section2_color', 'Prayer Box - Lower Section Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Text color of lower section of prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_prayer_grid_item_section_separator_color', 'Prayer Box - Separator Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Color of separator that separates the upper and lower sections of the prayer box - the box in which the prayer times are written.'),

      Field::make('color', 'dpte_timetable2_date_time_background', 'Date Time Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of section in which the date and time is written.'),

      Field::make('color', 'dpte_timetable2_date_time_color', 'Date Time Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of section in which the date and time is written.'),

      Field::make('color', 'dpte_timetable2_next_prayer_background', 'Next Prayer Background')
        ->set_default_value('#CFA55B')
        ->set_help_text('Background color of section in which the "time to next prayer" is written.'),

      Field::make('color', 'dpte_timetable2_next_prayer_color', 'Next Prayer Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color of section in which the "time to next prayer" is written.'),

        
      Field::make('html', 'dpte_timetable2_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Prayer Grid</h2>'),

      Field::make('text', 'dpte_timetable2_prayer_grid_max_col_count', 'Max Number of Columns')
        ->set_attribute("type", "number")
        ->set_default_value(2)
        ->set_help_text('The maximum number of columns allowed in the prayer grid.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable2_title_section_background = carbon_get_theme_option('dpte_timetable2_title_section_background');
  $dpte_timetable2_title_section_color = carbon_get_theme_option('dpte_timetable2_title_section_color');
  $dpte_timetable2_prayer_grid_section1_background = carbon_get_theme_option('dpte_timetable2_prayer_grid_section1_background');
  $dpte_timetable2_prayer_grid_section1_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_section1_color');
  $dpte_timetable2_prayer_grid_section2_background = carbon_get_theme_option('dpte_timetable2_prayer_grid_section2_background');
  $dpte_timetable2_prayer_grid_section2_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_section2_color');
  $dpte_timetable2_prayer_grid_item_section_separator_color = carbon_get_theme_option('dpte_timetable2_prayer_grid_item_section_separator_color');
  $dpte_timetable2_date_time_background = carbon_get_theme_option('dpte_timetable2_date_time_background');
  $dpte_timetable2_date_time_color = carbon_get_theme_option('dpte_timetable2_date_time_color');
  $dpte_timetable2_next_prayer_background = carbon_get_theme_option('dpte_timetable2_next_prayer_background');
  $dpte_timetable2_next_prayer_color = carbon_get_theme_option('dpte_timetable2_next_prayer_color');
  $dpte_timetable2_prayer_grid_max_col_count = carbon_get_theme_option('dpte_timetable2_prayer_grid_max_col_count');

  echo "
    <style>
      :root {
        --dpte-timetable2-title-section-background: {$dpte_timetable2_title_section_background};
        --dpte-timetable2-title-section-color: {$dpte_timetable2_title_section_color};
        --dpte-timetable2-prayer-grid-section1-background: {$dpte_timetable2_prayer_grid_section1_background};
        --dpte-timetable2-prayer-grid-section1-color: {$dpte_timetable2_prayer_grid_section1_color};
        --dpte-timetable2-prayer-grid-section2-background: {$dpte_timetable2_prayer_grid_section2_background};
        --dpte-timetable2-prayer-grid-section2-color: {$dpte_timetable2_prayer_grid_section2_color};
        --dpte-timetable2-prayer-grid-item-section-separator-color: {$dpte_timetable2_prayer_grid_item_section_separator_color};
        --dpte-timetable2-date-time-background: {$dpte_timetable2_date_time_background};
        --dpte-timetable2-date-time-color: {$dpte_timetable2_date_time_color};
        --dpte-timetable2-next-prayer-background: {$dpte_timetable2_next_prayer_background};
        --dpte-timetable2-next-prayer-color: {$dpte_timetable2_next_prayer_color};
        --dpte-timetable2-prayer-grid-max-col-count: {$dpte_timetable2_prayer_grid_max_col_count};
      }
    </style>
  ";
});
