<?php


add_action('widgets_init', create_function('', 'return register_widget("UbiqFBStandard");'));

class UbiqFBStandard extends WP_Widget {
  /** constructor */
  function UbiqFBStandard() {
    $widget_ops = array('classname' => 'ubiq_fbstandard', 'description' => __( 'Facebook social recomendations.') );
    parent::WP_Widget('ubiq_fbstandard', __('Ubiquity: Facebook'), $widget_ops);	
  }
  
  /** @see WP_Widget::widget */
  function widget($args, $instance) {		
    extract( $args );
    ?>
    <?php echo $before_widget; ?>
    <?php include('widgets/fb-standard.php') ?>
    <?php echo $after_widget; ?>
  <?php
  }
  
  /** @see WP_Widget::update */
  function update($new_instance, $old_instance) {				
    $instance = $old_instance;
    return $instance;
  }
  
  /** @see WP_Widget::form */
  function form($instance) {				

  }

} // class FooWidget

?>