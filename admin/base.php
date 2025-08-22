<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('dpte_extend_base_container', function($container) {
  $container
    ->add_tab(__('General'), [
      Field::make('text', 'dpte_general_message', 'General Message')
        ->set_help_text('This is a general message for DPTE plugin.'),
    ]);
});
