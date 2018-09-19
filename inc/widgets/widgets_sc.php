<?php

function wg_show_siblings($attr){
  global $post;
  $args = array(
    'post_type' => get_post_type()
  );
  $got_posts = get_posts($args);
  ob_start();
  echo '<ul class="widget-posts-list side-cats">';
  $curr_post = get_the_ID();
  foreach ($got_posts as $post) {
    setup_postdata($post); ?>
      <li class="widget-post-sibling<?php echo esc_attr(get_the_ID() == $curr_post ? ' current' : '' ) ?>">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </li>
    <?php
  }
  echo '</ul>';
  wp_reset_postdata();
  return ob_get_clean();
}
add_shortcode('wg-siblings','wg_show_siblings');

function wg_show_categories($attr){
  ob_start(); ?>
  <ul class="widget-categories side-cats">
    <?php wp_list_categories(array('title_li'=>'')); ?>
  </ul>
  <?php return ob_get_clean();
}
add_shortcode('wg-categories','wg_show_categories');
