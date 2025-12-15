<?php

if (!defined('ABSPATH')) {
	exit;
}

function dpte_timetable2_title_component_shortcode($atts) {
  wp_enqueue_style("dpte_timetable2_title_component", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_timetable2_title_component", plugin_dir_url(__FILE__) . "script.js", [], null, true);

  $data_attrs = '';
  $atts = shortcode_atts(
    array(
      'timetype' => 'next',
    ),
    $atts,
    'dpte_timetable'
  );
  foreach ($atts as $key => $value) {
    $data_attrs .= ' data-' . esc_attr($key) . '="' . esc_attr($value) . '"';
  }

  ob_start();
  ?>
  <div class="dpte-timetable2-title-component" <?php echo $data_attrs; ?>>
    <h2 class="dpte-timetable2-title">
      <?php
        if (isset($atts['timetype'])) {
          switch ($atts['timetype']) {
            case 'next':
              echo "Next";
              break;
            case 'today':
              echo "Today's";
              break;
            case 'tomorrow':
              echo "Tomorrow's";
              break;
            default:
              echo "Next";
              break;
          }
        }
      ?>
      Prayer Times
    </h2>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_timetable2_title_component', 'dpte_timetable2_title_component_shortcode');
