<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head() ?>
</head>
<body <?php body_class(); ?>>
<header id="header">
	<div class="header-top">
		<div class="container">
			<p class="top-title"><?php echo esc_html__('Дясна Народна Партия','mind-shock'); ?></p>
			<a class="fb-link top-link" href="<?php echo esc_url(get_theme_mod('hh_fb')); ?>" aria-label="facebook-account" target="_blank" rel="noopener"><span class="im im-fb"></span></a>
		</div>
	</div>
	<div class="header-main">
		<div class="container">
			<div class="site-logo">
				<?php the_custom_logo(); ?>
			</div>
			<div class="questions">
				<a href="tel:<?php echo esc_html(get_theme_mod('hh_phone_1')); ?>" class="top-phone" aria-label="phone">
					<span class="im im-phone"></span>
					<span class="got-questions"><?php echo esc_html__('Имате въпроси ?','mind-shock'); ?></span>
					<span class="number"><?php echo esc_html(get_theme_mod('hh_phone_1')); ?></span>
				</a>
			</div>
			<?php wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'menu_class'     => 'nav',
				'container'      => '',
				'walker'	=> new hh_walker_nav,
			)); ?>
			<div class="mob-trigger">
				<span class="im im-menu"></span>
			</div>
		</div>
	</div>
	<div class="header-mobile">
		<?php wp_nav_menu(array(
			'theme_location' => 'main-menu',
			'menu_class'     => 'nav',
			'container'      => '',
			'walker'	=> new hh_walker_nav,
		)); ?>
	</div>
</header>
