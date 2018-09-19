<?php

function sc_show_posts($attr){
  $attr = shortcode_atts(array(
    'posts_per_page' => '-1',
    'post_type' => 'post',
    'orderby' => 'DATE',
    'order' => 'DESC',
    'style' => '1',
  ),$attr);
  $post_query = new WP_Query($attr);
  ob_start();
  if ($post_query->have_posts()):
    echo '<ul class="loop-posts template-'.esc_attr($attr['style']).'">';
    while ($post_query->have_posts()):
      $post_query->the_post(); ?>
      <li class="loop-post">
        <a href="<?php the_permalink(); ?>"><h4 class="post-title"><?php the_title(); ?></h4></a><?php
        echo do_shortcode('[main-sep align="center"]');
        if (has_excerpt()){
          the_excerpt();
        } else { ?>
          <p><?php the_excerpt(); ?></p><?php
        } ?>
      </li><?php
    endwhile;
    echo '</ul>';
  endif;
  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode('show-posts','sc_show_posts');

function sc_separator($attr){
  $attr = shortcode_atts(array(
    'align' => 'left'
  ),$attr);
  ob_start(); ?>
  <div class="main-sep <?php echo $attr['align'].'-sep'; ?>">
    <div class="sep-dash"></div>
  </div><?php
  return ob_get_clean();
}
add_shortcode('main-sep','sc_separator');

function sc_main_button($attr){
  $attr = shortcode_atts(array(
    'link' => get_the_permalink(),
    'text' => esc_html__('Виж още','mind-shock'),
    'align' => 'center',
    'style' => '1'
  ),$attr);
  ob_start(); ?>
  <div class="main-button style-<?php echo $attr['style'].' align-'.$attr['align']; ?>">
    <a href="<?php echo esc_url($attr['link']); ?>" class="see-more">
      <?php echo $attr['text']; ?>
    </a>
  </div><?php
  return ob_get_clean();
}
add_shortcode('main-button','sc_main_button');

function sc_show_blog_posts($attr){
  $attr = shortcode_atts(array(
    'posts_per_page' => '-1',
    'post_type' => 'post',
    'orderby' => 'DATE',
    'order' => 'DESC',
    'style' => '1',
  ),$attr);
  $blog_posts_query = new WP_Query($attr);
  ob_start();
  if ($blog_posts_query->have_posts()):
    echo '<ul class="loop-blog-posts template-'.esc_attr($attr['style']).'">';
    while ($blog_posts_query->have_posts()):
      $blog_posts_query->the_post(); ?>
      <li class="loop-blog-post">
        <div class="blog-post-thumbnail">
          <a href="<?php the_permalink(); ?>">
            <img class="blog-post-img" width="270" height="270" src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'blog-thumb'); ?>"
            srcset="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'blog-thumb'); ?> 270w,
            <?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'blog-thumb-768'); ?> 768w,
            <?php echo wp_get_attachment_image_url(get_post_thumbnail_id(),'blog-thumb-400'); ?> 400w"
            sizes="(max-width: 400px) 400px, (max-width: 768px) 768px, 270px" alt="">
          </a>
        </div>
        <div class="blog-post-cont">
          <div class="post-meta">
            <p class="post-date"><span class="im im-calendar-page-empty"></span><?php echo get_the_date('d F, Y') ?></p>
          </div>
          <a href="<?php the_permalink(); ?>"><h2 class="post-title"><?php the_title(); ?></h2></a>
          <div class="post-excerpt">
            <?php if (has_excerpt()){
              the_excerpt();
            } else { ?>
              <p><?php the_excerpt(); ?></p><?php
            } ?>
          </div>
          <?php echo do_shortcode('[main-button style="2"]'); ?>
        </div>
      </li><?php
    endwhile;
    echo '</ul>';
  endif;
  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode('show-blog-posts','sc_show_blog_posts');
