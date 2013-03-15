<?php
/*Register the required plugins for this theme.
/*---------------------------------------------------------------------------------------------*/
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
//		array(
//			'name'     				=> 'Zilla shortcodes Generator', // The plugin name
//			'slug'     				=> 'zilla-shortcodes', // The plugin slug (typically the folder name)
//			'source'   				=> get_bloginfo('template_url').'/functions/plugins/zilla-shortcodes-1.0.zip', // The plugin source
//			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
//			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
//			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
//		),
		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name' 		=> 'WP-Mail-SMTP',
			'slug' 		=> 'wp-mail-smtp',
			'required' 	=> true,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
//add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

/*Convert HEX to RGB
/*---------------------------------------------------------------------------------------------*/

function hexToRGB ($hexColor){
    if( preg_match( '/^#?([a-h0-9]{2})([a-h0-9]{2})([a-h0-9]{2})$/i', $hexColor, $matches ) )
    {
        return array(
            'red' => hexdec( $matches[ 1 ] ),
            'green' => hexdec( $matches[ 2 ] ),
            'blue' => hexdec( $matches[ 3 ] )
        );
    }
    else
    {
        return array( 0, 0, 0 );
    }
	
	/*$a = hexToRGB('FFFFFF'); 
    echo $a['red'].' - '; echo $a['green'].' - '; echo $a['blue'];*/
}

/*Check post type function
/*---------------------------------------------------------------------------------------------*/
function is_post_type($type){
    global $wp_query;
    if($type == get_post_type($wp_query->post->ID)) return true;
    return false;
}

/*Get image ID from URL
/*---------------------------------------------------------------------------------------------*/
if( !function_exists( 'get_attachment_id_from_src' ) ) {
	function get_attachment_id_from_src ($image_src) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
	 
		if($id == null){
			$image_src = basename ( $image_src );
			$q2 = "SELECT post_id FROM {$wpdb->postmeta}  WHERE meta_key = '_wp_attachment_metadata' AND meta_value LIKE '%$image_src%'";
			$id = $wpdb->get_var($q2);
		}
		return $id;
	} 
}

/* Custom Walker for wp_list_categories in template-portfolio.php */
/*---------------------------------------------------------------------------------------------*/

class Portfolio_Walker extends Walker_Category {
   function start_el(&$output, $category, $depth, $args) {
   
      $cat_name = esc_attr( $category->name);
	  $link = '<a href="#" data-filter=".'.$category->slug.'">' . $cat_name .'<span> ('.$category->count.')</span></a>';

      if ( 'list' == $args['style'] ) {
          $output .= '<li';
          $class = 'cat-item cat-item-'.$category->term_id;
          if ( isset($current_category) && $current_category && ($category->term_id == $current_category) )
             $class .=  ' current-cat';
          elseif ( isset($_current_category) && $_current_category && ($category->term_id == $_current_category->parent) )
             $class .=  ' current-cat-parent';
          $output .=  '';
          $output .= ">$link\n";
       } else {
          $output .= "\t$link<br />\n";
       }
       
   }
}

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}



?>