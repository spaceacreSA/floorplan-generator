<?php
//WP Tooling class for support. Make sure to add this to every plugin

#Version 0.1
#17/02/2014

class wp_tooling
{	
	function __construct()
	{		
		function wptooling_menu() {
			add_menu_page ( 'WP Tooling', 'WP Tooling', 'manage_options', 'wp-tooling', 'wptooling_plugins' );
			//add_submenu_page( 'wp-tooling', 'Plugins', 'Plugins', 'manage_options', 'wp-tooling', 'wptooling_plugins');
			add_submenu_page( 'wp-tooling', 'Feedback', 'Feedback', 'manage_options', 'wp-tooling', 'wptooling_feedback');	
			add_submenu_page( 'wp-tooling', 'Help', 'Help', 'manage_options', 'help', 'wptooling_faq');	
		}
		add_action ( 'admin_menu', 'wptooling_menu' );	
				
		function wptooling_plugins()
		{
		}
		
		function wptooling_faq()
		{
		?>
		<ul>
			<li><a href="http://wptooling.com/forum" target="_blank">Forums</a></li>
			<li><a href="http://wptooling.com/faq" target="_blank">FAQs</a></li>
		</ul>
		<?php 
		}
		
		function wptooling_feedback()
		{
			?>
			<br/>
			<div>
			<iframe src='http://wptooling.com/feedback-so-we-can-make-our-plugins-even-better' style="width:100%; height:500px;" frameborder='0'></iframe>
			</div>
			<a href="http://wptooling.com/feedback-so-we-can-make-our-plugins-even-better" target="_blank">Open in new tab.</a>
		<?php 
		}
	}
}