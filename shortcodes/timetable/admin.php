<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_timetable_container', function($container) {
  $container
    ->add_tab(__('Timetable'), [
      Field::make('html', 'dpte_timetable_heading')
        ->set_html('
          <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Timetable - [dpte_timetable]</h2>
          <p>Quisque mattis ligula.</p>'
        ),
      Field::make('color', 'dpte_timetable_color', 'Timetable Highlight Color')
        ->set_default_value('#ff0000'),
    ]);
});
