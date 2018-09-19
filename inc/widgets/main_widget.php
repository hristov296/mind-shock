<?php
function wpb_load_widget() {
    register_widget( 'pp_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

class pp_widget extends WP_Widget{

  // Init
  function __construct() {
    parent::__construct(
      'pp_widget',
      esc_html__('Shortcode','pp')
    );
  }

  // Frontend
  public function widget( $args, $instance ) {
    $inst = array(
      'is_page',
      'is_singular',
      'is_post_type_archive'
    );
    foreach ($inst as $curr) {
      if (!empty($instance[$curr])){
        $$curr = explode(',',$instance[$curr]);
        if ($curr == 'is_post_type_archive' && in_array(get_query_var('posttype_query_var'),$$curr)){
          $$curr = true;
        } else {
          $$curr = $curr($$curr) ? true : false ;
        }
      }
    }
    if (!$is_page && !$is_singular && !$is_post_type_archive){
      return;
    }
    ?>
    <div class="side-widget">
      <h4 class="widget-title"><?php echo $instance['title']; ?></h4>
      <?php echo do_shortcode('[main-sep]');
      echo do_shortcode($instance['cont']); ?>
    </div>
    <?php
  }

  // Backend
  public function form( $instance ) {
    $inst = array(
      'title' => 'Title',
      'cont' => 'Shortcode',
      'is_page' => 'is_page',
      'is_singular' => 'is_singular',
      'is_post_type_archive' => 'is_post_type_archive'
    );

    foreach ($inst as $key => $value) {
      $$key = isset( $instance[$key] ) ? $instance[$key] : '' ;
    }

    echo '<p>';
    foreach ($inst as $key => $value) { ?>
      <label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php esc_attr_e($value.':'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id( $key )); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="text" value="<?php echo esc_attr( $$key ); ?>" />
    <?php }
    echo '</p>';
  }

  // Update
  public function update( $new_instance, $old_instance ) {
    $inst = array('title','cont','is_page','is_singular','is_post_type_archive');

    foreach ($inst as $key) {
      $inst[$key] = ( ! empty( $new_instance[$key] ) ) ? sanitize_text_field( $new_instance[$key] ) : '' ;
    }
    return $inst;
  }
}

require_once __DIR__.'/widgets_sc.php';
