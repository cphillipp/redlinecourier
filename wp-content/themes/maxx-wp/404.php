<?php
/*
 * Page: 404
 * @package WordPress
 * @subpackage Maxx
 */
?>

<?php get_header()?>
    
    <!--main content-->
    <div id="main-content-wrapper" class="fixed-width-wrapper" >
    	
        <!--breadcrums-->
		<?php if ($data['md_show_breadcrums']&& class_exists('simple_breadcrumb')){?>
        <div id="breadcrumb-wrapper" class="float-left">
        	<?php $breadcrumbs = new simple_breadcrumb; ?>
        </div>
        <?php }?>
        <!--/breadcrums-->
        
        
        <!--Page title-->
        <h1 class="page-title cufon first-word double-color"><?php _e('Oops ! Page not found', 'framework') ?></h1>
        <!--/Page title-->
        
        
    	<!--full width-->
        <div <?php post_class('post-entry'); ?> id="error-404">
        	<div class="clear"></div>
            <h1 class="cufon"><?php _e('404','framework')?></h1>
            <h4 class="cufon"><?php echo $data['md_default_404_message']?></h4>
			
        </div>
        <!--/full width-->
    
    </div>
    <!--/main content-->
    
<?php get_footer()?>