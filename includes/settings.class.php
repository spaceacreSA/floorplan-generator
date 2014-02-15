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
					update_option( 'floorplan_camera_options', 'on' );
				}
				else{
					update_option( 'floorplan_camera_options', 'off' );
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
		
		##SET CATEGORIES FOR CUSTOM POST TYPE
	//	register_taxonomy("Office", array("floorplans"));
		
		
	/*	function remove_metaboxes(){
			remove_meta_box('slugdiv', 'obpcontacts', 'normal'); // Slug
			remove_meta_box('submitdiv', 'obpcontacts', 'side'); // Publish box
		}
		add_action( 'add_meta_boxes', 'remove_metaboxes', 11 );*/
		
		##INIT DIRECTORY FOR UPLOADING PDF##
		$dir_name = WP_CONTENT_DIR.'/uploads/floorplans/';
		if ( ! is_dir($dir_name) )
		{
			wp_mkdir_p($dir_name) or die("Could not create Floorplan Generator directory " . $dir_name);
		}
		
		
	}
	
}