<?php
/**
 * Plugin Name: cod4stats
 * Description: A widget that displays your current Call of Duty 4: Modern Warfare kill/death-ratio
 * Version: 0.1
 * Author: Simon M
 * Author URI: http://theblog.de
 */


add_action( 'widgets_init', 'cod4stats' );


function cod4stats() {
	register_widget( 'cod4stats' );
}

class cod4stats extends WP_Widget {

	function cod4stats() {
		$widget_ops = array( 'classname' => 'cod4stats', 'description' => __('A widget that displays your current Call of Duty 4: Modern Warfare kill/death-ratio', 'cod4stats') );
		
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'cod4stats-widget' );
		
		$this->WP_Widget( 'cod4stats-widget', __('cod4stats Widget', 'cod4stats'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$show_info = isset( $instance['show_info'] ) ? $instance['show_info'] : false;

		echo $before_widget;

		// Display the widget title 
		if ( $title )
			echo $before_title . $title . $after_title;

		//Display the name 
		if ( $name )
			//printf( '<p>' . __('Hey their Sailor! My name is %1$s.', 'cod4stats') . '</p>', $name );
			include("show.php");
		
		if ( $show_info )
			printf( $name );

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] = strip_tags( $new_instance['name'] );
		$instance['show_info'] = $new_instance['show_info'];

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('cod4stats', 'cod4stats'), 'name' => __('Bilal Shaheen', 'cod4stats'), 'show_info' => true );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		//Widget Title: Text Input.
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'cod4stats'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		//Text Input.
		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Your Name:', 'cod4stats'); ?></label>
			<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
		</p>

		
		//Checkbox.
		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_info'], true ); ?> id="<?php echo $this->get_field_id( 'show_info' ); ?>" name="<?php echo $this->get_field_name( 'show_info' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'show_info' ); ?>"><?php _e('Display info publicly?', 'cod4stats'); ?></label>
		</p>

	<?php
	}
}

?>