<?php

$javascriptFilename = '/assets/front/minify/minify.js';
if (file_exists(PATH.$javascriptFilename)) {
    echo "<!-- JavaScript -->";
    echo '<script src="'. func::res_url().$javascriptFilename .'"></script>';
} else {
  $assetsPath = func::res_url()."assets/front/js/";
?>
    <!-- JQUERY LIBRARY -->
    <script src="<?php echo $assetsPath?>jquery.min.js"></script>

    <!-- Mobile Menu JS -->
    <script src="<?php echo $assetsPath?>jquery.meanmenu.js"></script>

    <!-- Sticky Menu JS -->
    <script src="<?php echo $assetsPath?>jquery.sticky.js"></script>

    <!-- WayPoints JS -->
    <script src="<?php echo $assetsPath?>waypoints.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="<?php echo $assetsPath?>bootstrap.min.js"></script>

    <!-- CounterUp JS -->
    <script src="<?php echo $assetsPath?>jquery.counterup.min.js"></script>

    <!-- OWL CAROUSEL JS -->
    <script src="<?php echo $assetsPath?>owl.carousel.min.js"></script>

    <!-- PrettyPhoto JS -->
    <script src="<?php echo $assetsPath?>jquery.prettyPhoto.js"></script>

    <!-- SLICK SLIDER -->
    <script src="<?php echo $assetsPath?>slick.min.js"></script>

    <!-- MAIN JS -->
    <script src="<?php echo $assetsPath?>main.js"></script>

    <!-- Color Settings JS -->
    <script src="<?php echo $assetsPath?>color-settings.js"></script>
<?php
}
