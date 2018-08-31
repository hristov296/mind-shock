<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#0095da">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<header id="header">
	<div class="header-top">
		<div class="container">
			<a href="tel:<?php echo esc_html(get_theme_mod('hh_phone_1')); ?>" class="top-phone top-link" aria-label="phone"><span class="im im-phone"></span><span class="number"><?php echo esc_html(get_theme_mod('hh_phone_1')); ?></span></a>
			<p class="work-time top-link" aria-label="phone"><span class="im im-time"></span><span><?php echo esc_html(get_theme_mod('hh_work_time')); ?></span></p>
			<a class="fb-link top-link" href="<?php echo esc_url(get_theme_mod('hh_fb')); ?>" aria-label="facebook-account" target="_blank" rel="noopener"><span class="im im-facebook"></span></a>
		</div>
	</div>
	<div class="header-main">
		<div class="container">
			<div class="site-logo">
				<?php the_custom_logo(); ?>
			</div>
			<?php wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'menu_class'     => 'nav',
				'container'      => '',
				'link_before'		 => '<span>',
				'link_after'		 => '</span>',
				'walker' 				 => new hh_walker_nav
			)); ?>
		</div>
	</div>
	<div class="header-bot">
		<?php wp_nav_menu(array(
			'theme_location' => 'top-menu',
			'menu_class'     => 'nav',
			'container'      => '',
		)); ?>
	</div>
</header>
