<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_date_container', function($container) {
  $container
    ->add_tab(__('Date'), [
      Field::make('html', 'dpte_timetable_date_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Date - [dpte_timetable_date]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_timetable_date_color', 'Date Highlight Color')
        ->set_default_value('#ff0000'),
    ]);
});
