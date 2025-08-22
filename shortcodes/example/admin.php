<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// add_action('dpte_extend_example_container', function($container) {
//   $container
//     ->add_tab(__('Example'), [
//       Field::make('html', 'dpte_example_heading')
//         ->set_html('
//           <h2 style="padding: 0; font-size: 1.25rem; font-weight: 500;">Example</h2>
//           <p>Lorem Ipsum.</p>'
//         ),
// 			Field::make('html', 'crb_separator_1')
//         ->set_html('<h2 style="padding: 0; margin: 0; margin-top: 1rem; font-size: 1rem; font-weight: 500;">Example Separator</h2>'),
//     ]);
// });

// add_action('wp_head', function() {
//   $example = carbon_get_theme_option('dpte_example_heading');
//	 
//   echo "
//     <style>
//       :root {
//         --dpte-example: {$example};
//       }
//     </style>
//   ";
// });
