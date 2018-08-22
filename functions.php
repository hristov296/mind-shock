<?php
add_action('wp_enqueue_scripts', 'enqueue_main_styles');
function enqueue_main_styles() {
	wp_enqueue_style('normalize', get_stylesheet_directory_uri() . '/assets/css/normalize.css');
	wp_enqueue_style('main', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('icomoon', get_stylesheet_directory_uri() . '/assets/fonts/icomoon/style.css');
	wp_enqueue_style('gfonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic');
	wp_register_script( 'hh_parallax' , get_stylesheet_directory_uri().'/assets/js/hh_parallax.js', $in_footer = true);
}

add_action('after_setup_theme','hh_setup_theme');
function hh_setup_theme(){
	add_theme_support('custom-logo');
	add_theme_support('title-tag');
	add_theme_support('html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ));
	//add_image_size('gal-thumb',75,75,true);
}

add_action('wp','hh_cf_enqueue');
function hh_cf_enqueue() {
	if (function_exists('wpcf7_enqueue_scripts') && function_exists('wpcf7_enqueue_styles') && (is_product() || is_page('15'))) {
		wpcf7_enqueue_scripts();
		wpcf7_enqueue_styles();
		add_filter('wpcf7_autop_or_not', '__return_false');
		add_filter('wpcf7_form_autocomplete', 'wpcf7_autocomplete');
	} else {
		add_filter('wpcf7_load_js', '__return_false');
		add_filter('wpcf7_load_css', '__return_false');
	}
	function wpcf7_autocomplete() {
		return 'on';
	}
}

require_once __DIR__.'/inc/theme.php';
require_once __DIR__.'/inc/shortcodes.php';
//require_once __DIR__.'/inc/hh-walker-nav.php';
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require_once __DIR__.'/inc/wc-metabox.php';
	require_once __DIR__.'/inc/share-products.php';
	require_once __DIR__.'/inc/wc-functions-single-product.php';
	require_once __DIR__.'/inc/wc-functions-archive-product.php';
	require_once __DIR__.'/inc/wc-hooks.php';
}
