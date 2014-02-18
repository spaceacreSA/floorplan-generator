<?php
## ADDS A FUNCTION TO SHOW THE FLOORPLAN AT THE FRONT END
########################
class floorplan_frontend{

	function __construct()
	{

		function load_frontend_scripts()
			{
				wp_enqueue_script( 'fancybox', plugins_url( '/floorplan-generator/fancybox/jquery.fancybox-1.3.5.js'), array( 'jquery' ));
				wp_enqueue_script( 'fancyboxgallery', plugins_url( '/floorplan-generator/js/gallery_with_noConflict.js'), array( 'jquery' ));
				wp_enqueue_style( 'css_fancybox', plugins_url('/floorplan-generator/fancybox/jquery.fancybox-1.3.5.pack.css'));
				wp_enqueue_style ( 'css.bootstrap-css', plugins_url ( '/floorplan-generator/css/bootstrap/css.bootstrap.css' ) );
			}
			add_action( 'wp_enqueue_scripts', 'load_frontend_scripts' );
		
		function display_floorplan_frontend($atts)
		{
			if($atts != '')
			{
				$post_id=$atts['post_id'];
			}
			elseif(get_post_type() == 'floorplans')
			{
				$post_id = get_the_ID(); 
			}
			$attachment_id = get_post_meta($post_id, 'floorplan_image_attachment_id', true );
					
				if ($attachment_id == true)
				{
					$imgurl = wp_get_attachment_url ( $attachment_id );
				}	
				
				$mark_count = get_post_meta($post_id, 'mark_count', true );
		?>
					<style type="text/css">
					   #floorplan_div {
					   width:750px;
					   position: relative;
					   }
					</style>
						
						<div style="clear: both;"></div>
					  
					  <div id="floorplan_div" style="overflow: auto;position: relative;width:750px;">
						<img src="<?php if(isset($imgurl)){echo $imgurl;}?>">	
					 <?php   

					 for($i=1;$i<=$mark_count;$i++)
					   {
					    $mark_image =  get_post_meta ($post_id, '_mark_image_' . $i, true );
                   		$position  = maybe_unserialize(get_post_meta ($post_id, '_mark_image_' . $i.'_position', true ));
                    			                    
						$mark_image_left = $position["left"];
						$mark_image_top =  $position["top"];

						$floorplan_camera_options = get_post_meta($post_id, 'floorplan_camera_options', true);
						
							if(!empty($mark_image)){
							?>      

					   <a id="<?php echo $post_id,'_mark_image_'.$i;?>" href="<?php echo site_url().$mark_image;?>" class="btn" rel="map_gallery" style=" <?php if ($floorplan_camera_options == 'off'){?>opacity: 0; width:60px; height:33px;<?php }?> position: absolute; top:<?php echo $mark_image_top; ?>px; left:<?php echo $mark_image_left; ?>px; " >
								<?php if ($floorplan_camera_options == 'on') {?><img src="<?php echo plugins_url('/floorplan-generator/images/camera-button.png');?>" /><?php }?>
						</a>
			
					<?php
					}
						}
                                                ?>
                   </div>
                                              <?php 
			}
		add_shortcode('FLOORPLAN', 'display_floorplan_frontend');		
	}
		
	}