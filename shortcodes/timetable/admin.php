<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable]'), [
      Field::make('html', 'dpte_timetable_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_timetable]</h2>
          <p>Change settings for the <b>[dpte_timetable]</b> shortcode.</p>
        '),

      Field::make('html', 'crb_separator_timetable_colors')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable_prayer_header_text_color', 'Header Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Color of the text in the timetable header.'),

      Field::make('color', 'dpte_timetable_prayer_background_gradient_1', 'Background Gradient 1')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 2" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_background_gradient_2', 'Background Gradient 2')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 1" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_active_color', 'Active Prayer Border Color')
        ->set_default_value('#ff5e00')
        ->set_help_text('Border color used for the currently active prayer in the timetable.'),

      Field::make('color', 'dpte_timetable_prayer_title_color', 'Prayer Name Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color for prayer titles (e.g., Fajr, Dhuhr, Asr, Maghrib, Isha).'),

      Field::make('color', 'dpte_timetable_prayer_values_color', 'Prayer Values Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Text color for the prayer times/values.'),

      Field::make('color', 'dpte_timetable_prayer_icon_color', 'Prayer Icon Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Color of icons shown alongside prayer titles.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable_prayer_header_text_color = carbon_get_theme_option('dpte_timetable_prayer_header_text_color');
  $dpte_timetable_prayer_background_gradient_1 = carbon_get_theme_option('dpte_timetable_prayer_background_gradient_1');
  $dpte_timetable_prayer_background_gradient_2 = carbon_get_theme_option('dpte_timetable_prayer_background_gradient_2');
  $dpte_timetable_prayer_active_color = carbon_get_theme_option('dpte_timetable_prayer_active_color');
  $dpte_timetable_prayer_title_color = carbon_get_theme_option('dpte_timetable_prayer_title_color');
  $dpte_timetable_prayer_values_color = carbon_get_theme_option('dpte_timetable_prayer_values_color');
  $dpte_timetable_prayer_icon_color = carbon_get_theme_option('dpte_timetable_prayer_icon_color');

  echo "
    <style>
      :root {
        --dpte-timetable-prayer-header-text-color: {$dpte_timetable_prayer_header_text_color};
        --dpte-timetable-prayer-background-gradient-1: {$dpte_timetable_prayer_background_gradient_1};
        --dpte-timetable-prayer-background-gradient-2: {$dpte_timetable_prayer_background_gradient_2};
        --dpte-timetable-prayer-active-color: {$dpte_timetable_prayer_active_color};
        --dpte-timetable-prayer-title-color: {$dpte_timetable_prayer_title_color};
        --dpte-timetable-prayer-values-color: {$dpte_timetable_prayer_values_color};
        --dpte-timetable-prayer-icon-color: {$dpte_timetable_prayer_icon_color};
      }
    </style>
  ";
});
