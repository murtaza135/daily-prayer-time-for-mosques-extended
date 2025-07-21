<?php

function dpte_example_shortcode() {
    ob_start();
    ?>
    <div class="example">example2</div>
    <?php
    return ob_get_clean();
}
