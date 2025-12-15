<?php

if (!defined('ABSPATH')) {
  exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('[dpte_timetable_prayer_time_component]'), [
      Field::make('html', 'dpte_timetable_prayer_time_component_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_timetable_prayer_time_component]</h2>
          <p>A single line of the timetable showing the start and Jama\'ah time of a selected prayer.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="fajr"]</b> - Display prayer times for "fajr". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="sunrise"]</b> - Display prayer times for "sunrise". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="zuhr"]</b> - Display prayer times for "zuhr". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="asr"]</b> - Display prayer times for "asr". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="maghrib"]</b> - Display prayer times for "maghrib". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="isha"]</b> - Display prayer times for "isha". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="jumah"]</b> - Display prayer times for "jumah". "timetype" defaults to "next". See below for an explanation.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="..." timetype="next"]</b> - Display prayer timetable, where the times displayed are of the next prayer. For example, if today\'s Asr has NOT yet passed, then today\'s Asr time will be displayed. If today\'s Asr HAS passed, then tomorrow\'s Asr will be displayed. This is the default option.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="..." timetype="today"]</b> - Display today\'s prayer timetable.</p>
          <p> - <b>[dpte_timetable_prayer_time_component prayer="..." timetype="tomorrow"]</b> - Display tomorrow\'s prayer timetable.</p>
          <p><b>Warning:</b> Inputing a non-existing parameter name or value will silently fail. So please ensure the argument name and value are correct.</p>
        '),


      Field::make('html', 'dpte_timetable_prayer_time_component_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_background_gradient_1', 'Background Gradient 1')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 2" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_background_gradient_2', 'Background Gradient 2')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the gradient color of each row\'s background. If you do not want a gradient, then please set "Background Gradient 1" to the same color.'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_active_color', 'Active Prayer Border Color')
        ->set_default_value('#ff5e00')
        ->set_help_text('Border color used for the currently active prayer in the timetable.'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_title_color', 'Prayer Name Text Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Text color for prayer titles (e.g., Fajr, Dhuhr, Asr, Maghrib, Isha).'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_values_color', 'Prayer Values Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Text color for the prayer times/values.'),

      Field::make('color', 'dpte_timetable_prayer_time_component_prayer_icon_color', 'Prayer Icon Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Color of icons shown alongside prayer titles.'),

        
      Field::make('html', 'dpte_timetable_prayer_time_component_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Icons</h2>'),

      Field::make('checkbox', 'dpte_timetable_prayer_time_component_icon_resize_animation_running', __('Icon Animation'))
        ->set_default_value('running')
        ->set_option_value('running')
        ->set_help_text('Activate the prayer icons\' resize animation.'),

      Field::make('text', 'dpte_timetable_prayer_time_component_prayer_icon_resize_animation_duration', 'Icon Animation Duration')
        ->set_attribute("type", "number")
        ->set_default_value(5000)
        ->set_help_text('Duration of prayer icons\' resize animation (in ms).'),


      Field::make('html', 'dpte_timetable_prayer_time_component_separator_3')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Sizes</h2>'),
      
      Field::make('text', 'dpte_timetable_prayer_time_component_text_size_multiplier', 'Text Size Multiplier')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('A multiplier for making the timetable text bigger or smaller.'),
    ]);
});

add_action('wp_head', function() {
  $dpte_timetable_prayer_time_component_prayer_background_gradient_1 = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_background_gradient_1');
  $dpte_timetable_prayer_time_component_prayer_background_gradient_2 = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_background_gradient_2');
  $dpte_timetable_prayer_time_component_prayer_active_color = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_active_color');
  $dpte_timetable_prayer_time_component_prayer_title_color = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_title_color');
  $dpte_timetable_prayer_time_component_prayer_values_color = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_values_color');
  $dpte_timetable_prayer_time_component_prayer_icon_color = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_icon_color');
  $dpte_timetable_prayer_time_component_icon_resize_animation_running = carbon_get_theme_option('dpte_timetable_prayer_time_component_icon_resize_animation_running') ? "running" : "paused";
  $dpte_timetable_prayer_time_component_prayer_icon_resize_animation_duration = carbon_get_theme_option('dpte_timetable_prayer_time_component_prayer_icon_resize_animation_duration');
  $dpte_timetable_prayer_time_component_text_size_multiplier = carbon_get_theme_option('dpte_timetable_prayer_time_component_text_size_multiplier');

  echo "
    <style>
      :root {
        --dpte-timetable-prayer-time-component-prayer-background-gradient-1: {$dpte_timetable_prayer_time_component_prayer_background_gradient_1};
        --dpte-timetable-prayer-time-component-prayer-background-gradient-2: {$dpte_timetable_prayer_time_component_prayer_background_gradient_2};
        --dpte-timetable-prayer-time-component-prayer-active-color: {$dpte_timetable_prayer_time_component_prayer_active_color};
        --dpte-timetable-prayer-time-component-prayer-title-color: {$dpte_timetable_prayer_time_component_prayer_title_color};
        --dpte-timetable-prayer-time-component-prayer-values-color: {$dpte_timetable_prayer_time_component_prayer_values_color};
        --dpte-timetable-prayer-time-component-prayer-icon-color: {$dpte_timetable_prayer_time_component_prayer_icon_color};
        --dpte-timetable-prayer-time-component-icon-resize-animation-running: {$dpte_timetable_prayer_time_component_icon_resize_animation_running};
        --dpte-timetable-prayer-time-component-prayer-icon-resize-animation-duration: {$dpte_timetable_prayer_time_component_prayer_icon_resize_animation_duration}ms;
        --dpte-timetable-prayer-time-component-text-size-multiplier: {$dpte_timetable_prayer_time_component_text_size_multiplier};
      }
    </style>
  ";
});
