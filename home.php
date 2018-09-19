<?php get_header(); ?>
<div id="primary" class="bg-gray">
  <div class="container">
    <div class="main-post-content">
      <?php while (have_posts()) : the_post(); ?>
        <div class="single-post-loop">
          <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(); ?></a>
          </div>
          <div class="post-content">
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
        </div>
      <?php endwhile;
        the_posts_pagination(array(
          'prev_text' => '<span class="im im-arrow-left"></span>',
          'next_text' => '<span class="im im-arrow-right"></span>'
        )); ?>
    </div>
    <div class="main-post-sidebar">
      <?php dynamic_sidebar('main-sb'); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
