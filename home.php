<?php get_header(); ?>
<div id="primary">
  <div class="container">
    <div class="blog-main">
      <?php while (have_posts()) : the_post();
    	the_content();
      endwhile;
      the_posts_pagination(array(
        'prev_text' => '<span class="im im-chevron-left"></span>',
        'next_text' => '<span class="im im-chevron-right"></span>'
      )); ?>
    </div>
    <div class="sidebar">
      <!-- <?php dynamic_sidebar( 'blog_sidebar' ); ?> -->
    </div>
  </div>
</div>
<?php get_footer(); ?>
