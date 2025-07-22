<?php
// @source: clock adapted from https://www.youtube.com/watch?v=nVGhXcMROfU

function dpte_clock_shortcode() {
  wp_enqueue_style("dpte_clock", plugin_dir_url(__FILE__) . "styles.css");
  wp_enqueue_script("dpte_clock", plugin_dir_url(__FILE__) . "script.js", ["dpte_dpt_fetch_cache"], null, true);

  ob_start();
  $image_url = plugin_dir_url(__FILE__) . 'allah-calligraphy.svg';
  ?>
  <div class="dpte-clock-wrapper">
    <div class="dpte-clock">
      <ul class="dpte-hours-container">
        <li><div class="dpte-num">1</div></li>
        <li><div class="dpte-num">2</div></li>
        <li><div class="dpte-num">3</div></li>
        <li><div class="dpte-num">4</div></li>
        <li><div class="dpte-num">5</div></li>
        <li><div class="dpte-num">6</div></li>
        <li><div class="dpte-num">7</div></li>
        <li><div class="dpte-num">8</div></li>
        <li><div class="dpte-num">9</div></li>
        <li><div class="dpte-num">10</div></li>
        <li><div class="dpte-num">11</div></li>
        <li><div class="dpte-num">12</div></li>
      </ul>
      <div class="dpte-hands-container">
        <div class="dpte-hand dpte-hand-hours"></div>
        <div class="dpte-hand dpte-hand-minutes"></div>
        <div class="dpte-hand dpte-hand-seconds"></div>
      </div>
      <div class="dpte-center-dot"></div>
      <img class="dpte-calligraphy" src="<?php echo esc_url($image_url); ?>" alt="">
      <p class="dpte-time-remaining">
        <span class="dpte-time-remaining-header"></span>
        <span class="dpte-time-remaining-value"></span>
      </p>
    </div>
  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('dpte_clock', 'dpte_clock_shortcode');