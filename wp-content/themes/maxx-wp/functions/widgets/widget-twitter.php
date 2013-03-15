<?php
/*
	Plugin Name: Twitter intergrator
	Description: Plugin for displaying your latest tweets.
*/


/*Register custom twitter script 
/*---------------------------------------------------------------------------------------------*/
function md_twitter_js() {
		wp_enqueue_script('jquery');
		wp_register_script('twitter-widget', get_template_directory_uri() . '/functions/js/twitter.js');
		wp_enqueue_script('twitter-widget');
}
add_action('init', 'md_twitter_js');

/*Register Widget
/*---------------------------------------------------------------------------------------------*/
function md_twitter_widget_init() {
	register_widget( 'MD_Twitter_Widget' );
}
add_action( 'widgets_init', 'md_twitter_widget_init' );
	
/*Widget class.
/*---------------------------------------------------------------------------------------------*/
class MD_Twitter_Widget extends WP_Widget {

/*Widget Setup
/*---------------------------------------------------------------------------------------------*/
function MD_Twitter_Widget() {
	
	// Widget settings
	$widget_ops = array('description' => __('Displaying your latest tweets.', 'framework'));
	
	// Widget control settings
	$control_ops = array('id_base' => 'md_twitter_widget');
	
	// Create the widget
	$this->WP_Widget( 'md_twitter_widget', __('Maxx: Twitter Feeds', 'framework'), $widget_ops, $control_ops );

}

/*Display Widget
/*---------------------------------------------------------------------------------------------*/
function widget( $args, $instance ) {
	
	// outputs the content of the widget
	global $wpdb;
	extract( $args );
	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$username = $instance['username'];
	$no_of_tweets = $instance['no_of_tweets'];
	
	echo $before_widget;
	
	//Echo widget title
	if ( $title ){echo $before_title . $title . $after_title;}
		
	$id = rand(0,999);
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		
		jQuery("#twitter_update_list_<?php echo $id; ?>").hide();
		jQuery.getJSON('http://api.twitter.com/1/statuses/user_timeline/<?php echo $username; ?>.json?count=<?php echo $no_of_tweets; ?>&callback=?', function(tweets){
			
			jQuery('.loading-tweet-<?php echo $id; ?>').fadeOut(1000,function(){jQuery("#twitter-update-list-<?php echo $id; ?>").append(twitterCallback2(tweets)).slideDown(1000);});
		});
	});
	</script>
	<div id="latest-tweet-widget-<?php echo $id; ?>" style="position: relative; display: block;">
		
		<ul id="twitter-update-list-<?php echo $id; ?>" class="widget-twitter">
			
		</ul>
		<p class="loading-tweet-<?php echo $id; ?>"><?php _e('Loading tweets...','framework')?></p>
		<br />
		<p><a href="http://twitter.com/<?php echo $username; ?>" target="_self" title="Follow me on twitter →"><?php _e('Follow me on twitter &rarr;','framework')?></a></p>
		
	</div>
	<?php
	
	echo $after_widget;
}

/*Widget Settings (Displays the widget settings controls on the widget panel)
/*---------------------------------------------------------------------------------------------*/
function form($instance) {
	
	// Set up some default widget settings
	$defaults = array(
		'title' => 'Latest Tweets',
		'username' => 'envato',
		'no_of_tweets' => '3'
	);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:','framework')?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Username:','framework')?></label>
		<input id="<?php echo $this->get_field_id( 'username' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $instance['username']; ?>" />
	</p>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>"><?php _e('Number of tweets to show:','framework')?></label>
		<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" class='widefat' name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" type="text" value="<?php echo $instance['no_of_tweets']; ?>" />
	</p>
	
	<?php
}

/*Update Widget
/*---------------------------------------------------------------------------------------------*/
function update( $new_instance, $old_instance ) {
	
	// processes widget options to be saved
	$instance = $old_instance;

	//Strip tags for title and name to remove HTML 
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['username'] = strip_tags( $new_instance['username'] );
	$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
	
	return $instance;
}
}
?>