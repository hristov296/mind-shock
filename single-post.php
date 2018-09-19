<?php get_header(); ?>
<div id="primary" class="bg-gray">
  <div class="container">
    <div class="main-post-content">
      <div class="post-main">
        <?php while (have_posts()) : the_post();
        echo the_post_thumbnail(); ?>
        <div class="post-meta">
          <p class="post-date"><span class="im im-calendar-page-empty"></span><?php echo get_the_date('d F, Y') ?></p>
        </div>
        <h2 class="post-title"><?php the_title(); ?></h2>
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        <?php endwhile; ?>
      </div>
      <div class="post-comments">
        <?php comments_template(); ?>
      </div>
    </div>
    <div class="main-post-sidebar">
      <?php dynamic_sidebar('main-sb'); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
