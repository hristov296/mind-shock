<?php

add_action('pre_get_posts','set_query_vars');
function set_query_vars( $query ) {
  $queryvar = '';
  if ( is_post_type_archive('cpt') || is_tax('cpt')) {
    $queryvar = 'cpt';
    $query->set('posts_per_page', -1);
    $query->set('orderby','menu_order');
    $query->set('order','ASC');
  } else if ( is_home() || is_category() ) {
    $queryvar = 'post';
    $query->set('posts_per_page', 3);
  }
  $query->set('posttype_query_var',$queryvar);

  return $query;
}

add_filter('category_template', function($template = '') {
  if (is_category()){
    $template = locate_template('home.php');
  }
  return $template;
});

add_filter('taxonomy_template', function($template = ''){
  if ( is_tax('category_cpt')) {
    $template = locate_template('archive-cpt.php');
  }
  return $template;
});

add_filter('excerpt_more', function(){
  return '...';
});
add_filter('excerpt_length',function(){
  return 30;
});

add_filter( 'tiny_mce_before_init', function($initArray){
  $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 20px 21px 22px 24px 26px 28px 32px 36px";
	return $initArray;
});

add_filter( 'mce_buttons_2', function($buttons){
  array_unshift( $buttons, 'fontsizeselect' );
	return $buttons;
});

add_filter( 'mce_buttons', function($buttons){
  array_splice( $buttons, 9, 0, array('alignjustify') );
	return $buttons;
});

register_nav_menus(array(
	'main-menu' => 'Main menu',
	'top-menu' => 'Top Menu',
));

$sidebars = array(
  'Main Sidebar' => 'main-sb',
  // 'Blog Sidebar' => 'blog-sb',
);

foreach ($sidebars as $k => $v) {
  register_sidebar(array(
    'name' => $k,
    'id' => $v,
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  ));
}

add_action('customize_register', 'register_customize_sections2');
function register_customize_sections2($wp_customize) {
	$wp_customize->add_setting('hh_phone_1', array(
		'default'=> '0881 23 45 78'
	));
	$wp_customize->add_control('hh_phone_1', array(
		'label' => esc_html__('Телефон 1', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 100
	));
	$wp_customize->add_setting('hh_phone_2', array(
		'default'=> ''
	));
	$wp_customize->add_control('hh_phone_2', array(
		'label' => esc_html__('Телефон 2', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 101
	));
	$wp_customize->add_setting('hh_work_time', array(
		'default'=> ''
	));
	$wp_customize->add_control('hh_work_time', array(
		'label' => esc_html__('Работно Време', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 102
	));
	$wp_customize->add_setting('hh_fb', array(
		'default'=>'https://facebook.com/'
	));
	$wp_customize->add_control('hh_fb', array(
		'label' => esc_html__('Facebook', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 103
	));
	$wp_customize->add_setting('hh_address', array(
		'default'=>__('')
	));
	$wp_customize->add_control('hh_address', array(
		'label' => esc_html__('Адрес', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 104
	));
	$wp_customize->add_setting('hh_email', array(
		'default'=>''
	));
	$wp_customize->add_control('hh_email', array(
		'label' => esc_html__('e-mail', 'kartach'),
		'section' => 'title_tagline',
		'priority' => 105
	));
}
