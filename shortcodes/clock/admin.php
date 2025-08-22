<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_clock_container', function($container) {
  $container
    ->add_tab(__('[dpte_clock]'), [
      Field::make('html', 'dpte_clock_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">[dpte_clock]</h2>
          <p>Change settings for the <b>[dpte_clock]</b> shortcode.</p>
        '),

      Field::make('html', 'crb_separator_1')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Colors</h2>'),

      Field::make('color', 'dpte_clock_background_gradient_1', 'Clock Background Gradient 1')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the gradient color of the clock\'s background. If you do not want a gradient, then please set "Clock Background Gradient 2" to the same color.'),

      Field::make('color', 'dpte_clock_background_gradient_2', 'Clock Background Gradient 2')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the gradient color of the clock\'s background. If you do not want a gradient, then please set "Clock Background Gradient 1" to the same color.'),

      Field::make('color', 'dpte_clock_border', 'Clock Border Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the clock\'s border color.'),

      Field::make('color', 'dpte_clock_number_color', 'Numbers Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Change the color of the clock\'s numbers.'),

      Field::make('color', 'dpte_clock_minute_line_color', 'Minute Lines Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Change the color of the clock\'s "minute lines", the lines on the edge of the clock that represent each minute.'),

      Field::make('color', 'dpte_clock_hand_hour_color_gradient_1', 'Hour Hand Gradient 1')
        ->set_default_value('#ff5e9a')
        ->set_help_text('Change the gradient color of the hour hand. If you do not want a gradient, then please set "Hour Hand Gradient 2" to the same color.'),

      Field::make('color', 'dpte_clock_hand_hour_color_gradient_2', 'Hour Hand Gradient 2')
        ->set_default_value('#ffb960')
        ->set_help_text('Change the gradient color of the hour hand. If you do not want a gradient, then please set "Hour Hand Gradient 1" to the same color.'),

      Field::make('color', 'dpte_clock_hand_minute_color_gradient_1', 'Minute Hand Gradient 1')
        ->set_default_value('#ff5e9a')
        ->set_help_text('Change the gradient color of the minute hand. If you do not want a gradient, then please set "Minute Hand Gradient 2" to the same color.'),

      Field::make('color', 'dpte_clock_hand_minute_color_gradient_2', 'Minute Hand Gradient 2')
        ->set_default_value('#ffb960')
        ->set_help_text('Change the gradient color of the minute hand. If you do not want a gradient, then please set "Minute Hand Gradient 1" to the same color.'),

      Field::make('color', 'dpte_clock_hand_second_color_gradient_1', 'Seconds Hand Gradient 1')
        ->set_default_value('#bbbbbbc7')
        ->set_help_text('Change the gradient color of the seconds hand. If you do not want a gradient, then please set "Seconds Hand Gradient 2" to the same color.'),

      Field::make('color', 'dpte_clock_hand_second_color_gradient_2', 'Seconds Hand Gradient 2')
        ->set_default_value('#bbbbbbc7')
        ->set_help_text('Change the gradient color of the seconds hand. If you do not want a gradient, then please set "Seconds Hand Gradient 1" to the same color.'),

      Field::make('color', 'dpte_clock_center_dot_background', 'Center Dot Background Color')
        ->set_default_value('#CFA55B')
        ->set_help_text('Change the background color of the center dot.'),

      Field::make('color', 'dpte_clock_center_dot_border', 'Center Dot Border Color')
        ->set_default_value('#2C2C2E')
        ->set_help_text('Change the border color of the center dot.'),
        
      Field::make('color', 'dpte_clock_time_remaining_color', 'Time Remaining Text Color')
        ->set_default_value('#FFFFFF')
        ->set_help_text('Change the color of the "time remaining" text.'),


      Field::make('html', 'crb_separator_2')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Center Logo Image</h2>'),

      Field::make('image', 'dpte_clock_center_logo_image', __('Image'))
        ->set_value_type('url')
        ->set_help_text('Display an image/logo in the center of the clock.'),

      Field::make('text', 'dpte_clock_center_logo_image_scale', 'Image Scale')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('Scale the center logo image.'),

      Field::make('text', 'dpte_clock_center_logo_image_translate_x', 'Image Translation X')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the center logo image along the X-axis (in terms of a % of the clock\'s width).'),

      Field::make('text', 'dpte_clock_center_logo_image_translate_y', 'Image Translation Y')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the center logo image along the Y-axis (in terms of a % of the clock\'s height).'),


      Field::make('html', 'crb_separator_3')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Top Left Image</h2>'),

      Field::make('image', 'dpte_clock_top_left_image', __('Image'))
        ->set_value_type('url')
        ->set_help_text('Display an image on the top left corner of the clock.'),

      Field::make('text', 'dpte_clock_top_left_image_scale', 'Image Scale')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('Scale the top left image.'),

      Field::make('text', 'dpte_clock_top_left_image_translate_x', 'Image Translation X')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the top left image along the X-axis (in px).'),

      Field::make('text', 'dpte_clock_top_left_image_translate_y', 'Image Translation Y')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the top left image along the Y-axis (in px).'),


      Field::make('html', 'crb_separator_4')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Top Right Image</h2>'),

      Field::make('image', 'dpte_clock_top_right_image', __('Image'))
        ->set_value_type('url')
        ->set_help_text('Display an image on the top right corner of the clock.'),

      Field::make('text', 'dpte_clock_top_right_image_scale', 'Image Scale')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('Scale the top right image.'),

      Field::make('text', 'dpte_clock_top_right_image_translate_x', 'Image Translation X')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the top right image along the X-axis (in px).'),

      Field::make('text', 'dpte_clock_top_right_image_translate_y', 'Image Translation Y')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the top right image along the Y-axis (in px).'),


      Field::make('html', 'crb_separator_5')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Bottom Left Image</h2>'),

      Field::make('image', 'dpte_clock_bottom_left_image', __('Image'))
        ->set_value_type('url')
        ->set_help_text('Display an image on the bottom left corner of the clock.'),

      Field::make('text', 'dpte_clock_bottom_left_image_scale', 'Image Scale')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('Scale the bottom left image.'),

      Field::make('text', 'dpte_clock_bottom_left_image_translate_x', 'Image Translation X')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the bottom left image along the X-axis (in px).'),

      Field::make('text', 'dpte_clock_bottom_left_image_translate_y', 'Image Translation Y')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the bottom left image along the Y-axis (in px).'),


      Field::make('html', 'crb_separator_6')
        ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Bottom Right Image</h2>'),

      Field::make('image', 'dpte_clock_bottom_right_image', __('Image'))
        ->set_value_type('url')
        ->set_help_text('Display an image on the bottom right corner of the clock.'),

      Field::make('text', 'dpte_clock_bottom_right_image_scale', 'Image Scale')
        ->set_attribute("type", "number")
        ->set_default_value(1)
        ->set_help_text('Scale the bottom right image.'),

      Field::make('text', 'dpte_clock_bottom_right_image_translate_x', 'Image Translation X')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the bottom right image along the X-axis (in px).'),

      Field::make('text', 'dpte_clock_bottom_right_image_translate_y', 'Image Translation Y')
        ->set_attribute("type", "number")
        ->set_default_value(0)
        ->set_help_text('Translate the bottom right image along the Y-axis (in px).'),
    ]);
});

add_action('wp_head', function() {
  $dpte_clock_background_gradient_1 = carbon_get_theme_option('dpte_clock_background_gradient_1');
  $dpte_clock_background_gradient_2 = carbon_get_theme_option('dpte_clock_background_gradient_2');
  $dpte_clock_border = carbon_get_theme_option('dpte_clock_border');
  $dpte_clock_number_color = carbon_get_theme_option('dpte_clock_number_color');
  $dpte_clock_minute_line_color = carbon_get_theme_option('dpte_clock_minute_line_color');
  $dpte_clock_hand_hour_color_gradient_1 = carbon_get_theme_option('dpte_clock_hand_hour_color_gradient_1');
  $dpte_clock_hand_hour_color_gradient_2 = carbon_get_theme_option('dpte_clock_hand_hour_color_gradient_2');
  $dpte_clock_hand_minute_color_gradient_1 = carbon_get_theme_option('dpte_clock_hand_minute_color_gradient_1');
  $dpte_clock_hand_minute_color_gradient_2 = carbon_get_theme_option('dpte_clock_hand_minute_color_gradient_2');
  $dpte_clock_hand_second_color_gradient_1 = carbon_get_theme_option('dpte_clock_hand_second_color_gradient_1');
  $dpte_clock_hand_second_color_gradient_2 = carbon_get_theme_option('dpte_clock_hand_second_color_gradient_2');
  $dpte_clock_center_dot_background = carbon_get_theme_option('dpte_clock_center_dot_background');
  $dpte_clock_center_dot_border = carbon_get_theme_option('dpte_clock_center_dot_border');
  $dpte_clock_time_remaining_color = carbon_get_theme_option('dpte_clock_time_remaining_color');

  $dpte_clock_center_logo_image_scale = carbon_get_theme_option('dpte_clock_center_logo_image_scale');
  $dpte_clock_center_logo_image_translate_x = carbon_get_theme_option('dpte_clock_center_logo_image_translate_x');
  $dpte_clock_center_logo_image_translate_y = carbon_get_theme_option('dpte_clock_center_logo_image_translate_y');

  $dpte_clock_top_left_image_scale = carbon_get_theme_option('dpte_clock_top_left_image_scale');
  $dpte_clock_top_left_image_translate_x = carbon_get_theme_option('dpte_clock_top_left_image_translate_x');
  $dpte_clock_top_left_image_translate_y = carbon_get_theme_option('dpte_clock_top_left_image_translate_y');

  $dpte_clock_top_right_image_scale = carbon_get_theme_option('dpte_clock_top_right_image_scale');
  $dpte_clock_top_right_image_translate_x = carbon_get_theme_option('dpte_clock_top_right_image_translate_x');
  $dpte_clock_top_right_image_translate_y = carbon_get_theme_option('dpte_clock_top_right_image_translate_y');

  $dpte_clock_bottom_left_image_scale = carbon_get_theme_option('dpte_clock_bottom_left_image_scale');
  $dpte_clock_bottom_left_image_translate_x = carbon_get_theme_option('dpte_clock_bottom_left_image_translate_x');
  $dpte_clock_bottom_left_image_translate_y = carbon_get_theme_option('dpte_clock_bottom_left_image_translate_y');

  $dpte_clock_bottom_right_image_scale = carbon_get_theme_option('dpte_clock_bottom_right_image_scale');
  $dpte_clock_bottom_right_image_translate_x = carbon_get_theme_option('dpte_clock_bottom_right_image_translate_x');
  $dpte_clock_bottom_right_image_translate_y = carbon_get_theme_option('dpte_clock_bottom_right_image_translate_y');

  echo "
    <style>
      :root {
        --dpte-clock-background-gradient-1: {$dpte_clock_background_gradient_1};
        --dpte-clock-background-gradient-2: {$dpte_clock_background_gradient_2};
        --dpte-clock-border: {$dpte_clock_border};
        --dpte-clock-number-color: {$dpte_clock_number_color};
        --dpte-clock-minute-line-color: {$dpte_clock_minute_line_color};
        --dpte-clock-hand-hour-color-gradient-1: {$dpte_clock_hand_hour_color_gradient_1};
        --dpte-clock-hand-hour-color-gradient-2: {$dpte_clock_hand_hour_color_gradient_2};
        --dpte-clock-hand-minute-color-gradient-1: {$dpte_clock_hand_minute_color_gradient_1};
        --dpte-clock-hand-minute-color-gradient-2: {$dpte_clock_hand_minute_color_gradient_2};
        --dpte-clock-hand-second-color-gradient-1: {$dpte_clock_hand_second_color_gradient_1};
        --dpte-clock-hand-second-color-gradient-2: {$dpte_clock_hand_second_color_gradient_2};
        --dpte-clock-center-dot-background: {$dpte_clock_center_dot_background};
        --dpte-clock-center-dot-border: {$dpte_clock_center_dot_border};
        --dpte-clock-time-remaining-color: {$dpte_clock_time_remaining_color};

        --dpte-clock-center-logo-image-scale: {$dpte_clock_center_logo_image_scale};
        --dpte-clock-center-logo-image-translate-x: {$dpte_clock_center_logo_image_translate_x}%;
        --dpte-clock-center-logo-image-translate-y: {$dpte_clock_center_logo_image_translate_y}%;
        
        --dpte-clock-top-left-image-scale: {$dpte_clock_top_left_image_scale};
        --dpte-clock-top-left-image-translate-x: {$dpte_clock_top_left_image_translate_x}px;
        --dpte-clock-top-left-image-translate-y: {$dpte_clock_top_left_image_translate_y}px;
        
        --dpte-clock-top-right-image-scale: {$dpte_clock_top_right_image_scale};
        --dpte-clock-top-right-image-translate-x: {$dpte_clock_top_right_image_translate_x}px;
        --dpte-clock-top-right-image-translate-y: {$dpte_clock_top_right_image_translate_y}px;
        
        --dpte-clock-bottom-left-image-scale: {$dpte_clock_bottom_left_image_scale};
        --dpte-clock-bottom-left-image-translate-x: {$dpte_clock_bottom_left_image_translate_x}px;
        --dpte-clock-bottom-left-image-translate-y: {$dpte_clock_bottom_left_image_translate_y}px;
        
        --dpte-clock-bottom-right-image-scale: {$dpte_clock_bottom_right_image_scale};
        --dpte-clock-bottom-right-image-translate-x: {$dpte_clock_bottom_right_image_translate_x}px;
        --dpte-clock-bottom-right-image-translate-y: {$dpte_clock_bottom_right_image_translate_y}px;
      }
    </style>
  ";
});
