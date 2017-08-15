<head>
    <!-- META KEYS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
    <!-- TITLE -->
    <title><?php echo $seo['seo_title']?></title>
    <meta name="description" content="<?php echo $seo['seo_intro']?>">
    <meta name="keywords" content="<?php echo $seo['seo_keyword']?>">
    <!--  ICO -->
	<link rel="shortcut icon" href="<?php echo func::res_url()?>favicon.ico" type="image/x-icon" />

  <?php
  $cssFilename = '/assets/front/minify/minify.css';
  if (file_exists(PATH.$cssFilename)) {
      echo "<!-- css -->";
      echo '<link href="'. func::res_url().$cssFilename .'" rel="stylesheet">';
  } else {
    $assetsPath = func::res_url()."assets/front/css/";
  ?>
	<!-- GOOGLE FONTS
    <link href='<?php echo func::res_url()?>assets/front/css/googlefont.css' rel='stylesheet' type='text/css'>
	-->

    <!-- BOOTSTRAP CSS -->
    <link href="<?php echo $assetsPath?>bootstrap.min.css" rel="stylesheet">

    <!-- IcoFont CSS -->
    <link href="<?php echo $assetsPath?>icofont.css" rel="stylesheet">

    <!-- FontAwesome Css -->
    <link href="<?php echo $assetsPath?>font-awesome.min.css" rel="stylesheet">

    <!-- OWL CAROUSEL CSS -->
    <link href="<?php echo $assetsPath?>owl.carousel.css" rel="stylesheet">

    <!-- ANIMATE CSS -->
    <link href="<?php echo $assetsPath?>animate.css" rel="stylesheet">

    <!-- Mobile Menu Css -->
    <link href="<?php echo $assetsPath?>meanmenu.css" rel="stylesheet">

    <!-- PrettyPhoto CSS -->
    <link href="<?php echo $assetsPath?>prettyPhoto.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="<?php echo $assetsPath?>style.css" rel="stylesheet">

    <!-- RESPONSIVE CSS -->
    <link href="<?php echo $assetsPath?>responsive.css" rel="stylesheet">

	   <!-- 悬浮窗 Css -->
    <link href="<?php echo func::res_url()?>assets/front/css/gdt-style.css" rel="stylesheet">

    <!-- DIRECTORY FONT -->
    <link href="<?php echo func::res_url()?>assets/front/font/stylesheet.css" rel="stylesheet">
    
    <!-- Child Css -->
    <link href="<?php echo func::res_url()?>assets/front/css/child/factory.css" rel="stylesheet">
  <?php } ?>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
