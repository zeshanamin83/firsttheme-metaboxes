<?php 

function firsttheme_metaboxes_admin_assets() {	
	
	global $pagenow;
		
	if( $pagenow !== 'post.php' && $pagenow !== 'post-new.php' ) return;
		wp_enqueue_script( 'firsttheme-metaboxes-admin-scripts-1', plugins_url('firsttheme-metaboxes/dist/assets/js/admin.js'), array( 'jquery' ), '', true );
		wp_enqueue_style( 'firsttheme-metaboxes-admin-stylesheet-1', plugins_url('firsttheme-metaboxes/dist/assets/css/admin.css'), array(), '', 'all' );
	
	
}

add_action('admin_enqueue_scripts', 'firsttheme_metaboxes_admin_assets');

