<?php
/*
 *Footer
*/
	global $data;	
	$md_footer_layout = $data['md_footer_layout'];
	$md_getintouch_heading = $data['md_getintouch_heading'];
	$md_getintouch_subline = $data['md_getintouch_subline'];
	
?>
	<?php if($data['md_show_getintouch_form']){?>
    <div class="clear"></div>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#subscribe-via-mail-form").submit(function() {
			jQuery('.subscribe-result').load('<?php echo get_template_directory_uri();?>/functions/subscribe.php', {email: jQuery('#sbvm_email').val(),checking: jQuery('#sbvm_checking').val()},
			function() {
				jQuery(this).fadeIn(200);
			});

			return false;

		});
	});
	</script>
	<!--Get in touch-->
    <div id="get-in-touch-wrapper" class="full-width-wrapper"> 
        <div id="get-in-touch" class="fixed-width-wrapper">
            <div id="via-phone-number">
                <div class="icon"><img src="<?php echo get_template_directory_uri();?>/images/icon-subscribe.png" alt="" ></div>
                <h2 class="cufon"><?php echo $md_getintouch_heading;?></h2>
                <p><?php echo $md_getintouch_subline;?></p>
            </div>
            <div id="via-email">
                <form action="#" method="post" id="subscribe-via-mail-form">
                    <input name="sbvm_email" id="sbvm_email" type="email" size="30" placeholder="<?php _e('Enter your E-mail address...','framework')?>">
                    <p style="display:none"><label for="checking"><?php _e('If you want to submit this form, do not enter anything in this field', 'framework') ?></label><input type="text" name="checking" id="sbvm_checking" value="<?php if(isset($_POST['checking']))  echo $_POST['checking'];?>" /></p>
                    <button type="submit" class="md-button dark shiny" style="padding:2px 10px;"><img src="<?php echo get_template_directory_uri();?>/images/tick_16.png" alt="<?php echo 'Subscribe !'?>" class=""><?php echo 'Subscribe !'?></button>
                </form>
                <div class="clear"></div>
                <div class="subscribe-result"></div>
            </div>
        </div>
    </div>
    <!--/Get in touch-->
    <?php }?>
	<div class="clear"></div>
    <!--footer-->
    <footer id="footer-wrapper">
    	<?php if(($md_footer_layout == 'footer-full-layout') || $md_footer_layout == 'footer-widget'){?>
    	<!--footer widget-->
    	<div id="footer-widget-wrapper" class="full-width-wrapper">
        	<div id="footer-widget-content" class="fixed-width-wrapper">
                			<?php
							$count = $data['md_footer_columns'];
							//retrive number of columns from theme option
							if($count==2)
								$class = 'one-half';
							else if($count==3)
								$class = 'one-third';
							else if($count==4)
								$class = 'one-fourth';
							else if($count==5)
								$class = 'one-fifth';
							else if($count==6)
								$class = 'one-sixth';
							
							for($i=1; $i<=$count; $i++){?>
                            
							<div class="<?php echo $class; if($i==1) echo ' first';?>">
								<?php if ( !function_exists('dynamic_sidebar') || ! dynamic_sidebar('Footer widget '.$i) ) :?>
								<?php endif;?>
							</div>
							<?php }?>
            </div>
            
    	</div>
    	<!--footer widget-->
        <?php } ?>
        <div class="clear"></div>
        
        
        <?php if(($md_footer_layout == 'footer-full-layout') || $md_footer_layout == 'footer-extra'){?>
        <!--footer content-->
        <div id="footer-extra-wrapper" class="full-width-wrapper">
            <div id="footer-info-content" class="fixed-width-wrapper">
                    <div class="copyright float-left">
						<?php if(!empty($data['md_footer_text'])) { echo $data['md_footer_text']; } else { ?>
                        	<?php _e('© Copyright', 'framework'); ?> <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a> <?php _e(' . All Rights Reserved. Powered by <a href="http://wordpress.org">WordPress</a>')?>
                        <?php }?>
                    
                    </div>
                    
                    <div class="credit float-right">
                    	<a href="#" class="back-to-top" title="<?php _e('Back to top','framework')?>"><?php _e('Back to top','framework')?></a>
                    </div>
            </div>
        </div>
        <!--footer content-->
    </footer>
    <!--/footer--> 
    <?php }?> 
    
    <?php 
	//show tracking codex
	echo stripslashes($data['md_google_analytics']); 
	?>
    
    <?php wp_footer(); ?>

</div>
</body>

</html>