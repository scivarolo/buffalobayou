<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title><?php wp_title('|','true','right'); ?><?php bloginfo('name'); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		<meta name="apple-itunes-app" content="app-id=674606052">

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<!--Cloud.typography-->
		<link rel="stylesheet" type="text/css" href="http://cloud.typography.com/74172/662964/css/fonts.css" />
		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" role="banner">
				<nav class="mobile" role="navigation">
					<?php bones_mobile_nav(); ?>
					<a class="mobile-toggle">Menu</a>
				</nav>
				<div id="weather"></div>
				<div id="social-icons">
					<a class="button green" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Donate' ) ) ); ?>">donate</a>
					<?php $facebook = get_field('facebook', 'option');
    			  $twitter = get_field('twitter', 'option');
    			  $instagram = get_field('instagram', 'option');
    			  $flickr = get_field('flickr', 'option');?>

    			  <?php if ( $facebook ) : ?>

      				<a href="<?php echo $facebook; ?>" target="_blank"><i class="icon-facebook"></i></a>

    				<?php endif; if ( $twitter ) : ?>

      				<a href="<?php echo $twitter; ?>" target="_blank"><i class="icon-twitter"></i></a>

    				<?php endif; if ( $instagram ) : ?>

      				<a href="<?php echo $instagram; ?>" target="_blank"><i class="icon-instagram"></i></a>

    				<?php endif; if ( $flickr ) : ?>

      				<a href="<?php echo $flickr; ?>" target="_blank"><i class="icon-flickr"></i></a>

    				<?php endif; ?>
    				  <a href="#footer-newsletter"><i class="icon-mail"></i></a>
				</div>
				<div id="inner-header" class="clearfix">

					<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<div id="logo"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_template_directory_uri(); ?>/library/images/bbp-header.png" alt="Buffalo Bayou Partnership" /><?php // bloginfo('name'); ?></a></div>

					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php // bloginfo('description'); ?>

				</div>
				<nav class="main-nav" role="navigation">
  				<!-- <a class="logo-btn" href="<?php echo home_url(); ?>">Home</a> -->
					<?php bones_main_nav(); ?>
				</nav>
			</header>
