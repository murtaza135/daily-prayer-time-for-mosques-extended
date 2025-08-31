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
          <p>A timetable showing the start and Jama\'ah times of all prayers.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_timetable]</b> - Display prayer timetable, where the times displayed are of the next prayer. For example, if today\'s Asr has NOT yet passed, then today\'s Asr time will be displayed. If today\'s Asr HAS passed, then tomorrow\'s Asr will be displayed.</p>
          <p> - <b>[dpte_timetable timetype="next"]</b> - Same as <b>[dpte_timetable]</b>, without any parameters.</p>
          <p> - <b>[dpte_timetable timetype="today"]</b> - Display today\'s prayer timetable.</p>
          <p> - <b>[dpte_timetable timetype="tomorrow"]</b> - Display tomorrow\'s prayer timetable.</p>
          <p><b>Warning:</b> Inputing a non-existing parameter name or value will silently fail. So please ensure the argument name and value are correct.</p>
        '),


      Field::make('html', 'crb_separator_1')
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

        
      Field::make('html', 'crb_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Icons</h2>'),

      Field::make('checkbox', 'dpte_timetable_icon_resize_animation_running', __('Icon Animation'))
        ->set_default_value('running')
        ->set_option_value('running')
        ->set_help_text('Activate the prayer icons\' resize animation.'),

      Field::make('text', 'dpte_timetable_prayer_icon_resize_animation_duration', 'Icon Animation Duration')
        ->set_attribute("type", "number")
        ->set_default_value(5000)
        ->set_help_text('Duration of prayer icons\' resize animation (in ms).'),
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
  $dpte_timetable_icon_resize_animation_running = carbon_get_theme_option('dpte_timetable_icon_resize_animation_running') ? "running" : "paused";
  $dpte_timetable_prayer_icon_resize_animation_duration = carbon_get_theme_option('dpte_timetable_prayer_icon_resize_animation_duration');

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
        --dpte-timetable-icon-resize-animation-running: {$dpte_timetable_icon_resize_animation_running};
        --dpte-timetable-prayer-icon-resize-animation-duration: {$dpte_timetable_prayer_icon_resize_animation_duration}ms;
      }
    </style>
  ";
});
