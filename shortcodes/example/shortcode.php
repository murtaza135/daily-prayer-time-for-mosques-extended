<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_example_shortcode() {
  wp_enqueue_style("dpte_example", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_example", plugin_dir_url(__FILE__) . "script.js", [], null, true);

  ob_start();
  ?>
  <div>example</div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_example', 'dpte_example_shortcode');
