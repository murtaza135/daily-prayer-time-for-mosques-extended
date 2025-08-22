<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_clock_container', function($container) {
  $container
    ->add_tab(__('Clock'), [
      Field::make('html', 'dpte_clock_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Clock - [dpte_clock]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_clock_color', 'Clock Highlight Color')
        ->set_default_value('#ff0000'),
    ]);
});

add_action('wp_head', function() {
  $primary = carbon_get_theme_option('dpte_clock_color');

  echo "
    <style>
      :root {
        --dpte-clock-background: {$primary};
      }
    </style>
  ";
});
