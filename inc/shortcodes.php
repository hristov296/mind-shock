<?php

function sc_latest_blog($attr){
  $args = shortcode_atts(array(
    'post_type' => 'post',
    'orderby' => 'date',
    'posts_per_page' => 3,
    'post__in' => '',
  ), $attr);
  if ($args['post__in']) {
		$no_whitespaces = preg_replace('/\s*,\s*/', ',', filter_var($attr['post__in'], FILTER_SANITIZE_STRING));
		$id_list = explode(',', $attr['post__in']);
		$args['post__in'] = $id_list;
	}
  $related_posts = new WP_Query($args);
  ob_start(); ?>
    <div class="latest-blog-posts">
      <?php while ($related_posts->have_posts()) {
        $related_posts->the_post(); ?>
        <div class="latest-blog-post">
          <a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('latest_blog'); ?></a>
          <a href="<?php the_permalink(); ?>"><h3 class="post-title"><?php the_title(); ?></h3></a>
          <div class="vc_btn3-container button-blue">
            <a href="<?php the_permalink(); ?>" class="vc_general vc_btn3"><?= esc_html__('Виж още', 'blog') ?></a>
          </div>
        </div>
      <?php }
       wp_reset_postdata(); ?>
    </div><?php
  $output = ob_get_clean();
  return $output;
}
add_shortcode('latest-blog-post','sc_latest_blog');
