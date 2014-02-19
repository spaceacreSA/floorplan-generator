<?php 
class floorplan_settings{
	function __construct()
	{
		//SET CAMERAS ON OR OFF
		function save_camera_options()
		{
			$postID = $_POST ['post_ID'];
			$post = get_post ( $postID );
		
			if ($post->post_type == 'floorplans') {
				if ($_POST['camera_options'] == 'on') {
					update_post_meta($postID, 'floorplan_camera_options', 'off');
				}
				else{
					update_post_meta($postID, 'floorplan_camera_options', 'on');
					}
			}
		}
		add_action ( 'save_post', 'save_camera_options' );
		
		#SET CUSTOM POST TYPE
		add_action( 'init', 'create_post_type' );
		function create_post_type()
		{
			register_post_type(
			'floorplans',
			array
			(
			'labels' => array(
			'name' => __('Floorplans'),
			'singular_name' => __('Floorplan'),
			'all_items' => __('View All'),
			'edit_item' => __('Edit Floorplan'),
			'new_item' => __('New Floorplan'),
			'view_item' => __('View Floorplan'),
			'search_items' => __('Search Floorplans')),
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array(
			'slug' => 'floorplans',
			'with_front' => false),
			'has_archive' => true,
			'query_var' => true,
			'menu_position' => 25,
			'supports' => array('title','excerpt', 'author','editor','thumbnail','excerpt','custom-fields','revisions','comments','page-attributes')
			)
			);
		}
		
		function floorplans_menu() 
			{
				add_menu_page ( 'WP Tooling', 'WP Tooling', 'manage_options', 'wp-tooling', 'floorplans_plugins' );
				add_submenu_page( 'edit.php?post_type=floorplans', 'Feedback', 'Feedback', 'manage_options', 'wp-tooling', 'floorplans_feedback');
				add_submenu_page( 'edit.php?post_type=floorplans', 'Help', 'Help', 'manage_options', 'help', 'floorplans_faq');
				add_submenu_page( 'edit.php?post_type=floorplans', 'Settings', 'Settings', 'manage_options', 'settings', 'floorplans_settings');	
			}
		add_action ( 'admin_menu', 'floorplans_menu' );
		
		function floorplans_plugins()
			{
			}
		
		function floorplans_faq()
			{
					?>
					<ul>
						<li><a href="http://wptooling.com/forum" target="_blank">Forums</a></li>
						<li><a href="http://wptooling.com/faq" target="_blank">FAQs</a></li>
					</ul>
					<?php 
			}
				
		function floorplans_feedback()
			{
						?>
						<br/>
						<div>
						<iframe src='http://wptooling.com/feedback-so-we-can-make-our-plugins-even-better' style="width:100%; height:500px;" frameborder='0'></iframe>
						</div>
						<a href="http://wptooling.com/feedback-so-we-can-make-our-plugins-even-better" target="_blank">Open in new tab.</a>
						<?php 
			}
			
		function floorplans_settings()
		{
			?>
			<br/>
			<div>Floorplan Settings</div>
			<div>
			<input type='checkbox' name="floorplan_backlinks"> Don't show 'Plugin by WP Tooling' on website
			</div>
			<?php 
		}
		
		##INIT DIRECTORY FOR UPLOADING PDF##
		$dir_name = WP_CONTENT_DIR.'/uploads/floorplans/';
		if ( ! is_dir($dir_name) )
			{
				wp_mkdir_p($dir_name) or die("Could not create Floorplan Generator directory " . $dir_name);
			}
		
		
	}
	
}