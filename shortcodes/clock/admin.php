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
          <p>A clock that also displays time left till Jama\'ah or till the start of the next Salah time.</p>
          <p><b>Shortcode Usage and Parameters:</b></p>
          <p> - <b>[dpte_clock]</b> - Display clock.</p>
          <p> - <b>[dpte_clock showimages="false"]</b> - Display clock without displaying any of the 4 images on the corner.</p>
          <p> - <b>[dpte_clock numberslanguage="arabic"]</b> - Display clock with arabic numbers.</p>
        '),
    ]);
});
