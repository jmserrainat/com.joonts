<form name="input" action="themes.php?page=import-demo&import" method="post">
URL: <input type="text" name="url">
<input type="submit" value="Submit">
</form>

<?php

set_time_limit(-1);
if(isset($_POST['url'])) {
	$_POST['url'] = plugin_dir_path( __FILE__ ) . 'demos/' . $_POST['url'];
	class WP_Import_Custom extends WP_Import {
		var $file = '';
		function import_end() {
			// unlink($this->file);
			wp_cache_flush();
			foreach ( get_taxonomies() as $tax ) {
				delete_option( "{$tax}_children" );
				_get_term_hierarchy( $tax );
			}

			wp_defer_term_counting( false );
			wp_defer_comment_counting( false );
		}
	}


	$keydesign_demo_content = $_POST['url'].'/demo_content.xml';
	$rev_slider = $_POST['url'].'/revolution_slider.zip';

	$keydesign_check_files = keydesign_check_import_files($keydesign_demo_content, $rev_slider);
	if( isset($keydesign_check_files['erros']) ){
		foreach ($keydesign_check_files as $file) {
			echo esc_attr($file);
		}
	} else {
		$upload_dir = wp_upload_dir();
		if(!is_dir($upload_dir['path'])){
			mkdir($upload_dir['path'], 0755, true);
		}
		$imported_files = keydesign_import_theme_files($upload_dir['path'], $keydesign_demo_content, $rev_slider);

		// Import Revolution Slider
		$import_slider = new RevSliderSlider();
		$import_slider->importSliderFromPost(true, true, $imported_files['slider']);

		//print_r($imported_files);
		$wp_importer = new WP_Import_Custom();
		$wp_importer->fetch_attachments = true;
		$_POST['user_map'][0] = 0;
		$_POST['imported_authors'][0] = 'admin';
		$wp_importer->import( $imported_files['demo'] );

		// Use a static front page
		$keydesign_home = get_page_by_title( 'Home' );
		update_option( 'page_on_front', $keydesign_home->ID );
		update_option( 'show_on_front', 'page' );

		// Set up the main menu
		$json_file = file_get_contents($_POST['url'] . '/theme_options.json');
	    update_option( 'redux_ThemeTek', json_decode($json_file, true), '', 'yes' );
	
		$keydesign_menu_name = wp_get_nav_menu_object( 'Main Menu' );
		$keydesign_term_id_of_menu = $keydesign_menu_name->term_id;
		$keydesign_menu_location = get_theme_mod('nav_menu_locations');
		$keydesign_menu_location['keydesign-header-menu'] = $keydesign_term_id_of_menu;
		set_theme_mod( 'nav_menu_locations', $keydesign_menu_location );

		global $wp_rewrite;
    	$wp_rewrite->set_permalink_structure( '/%postname%/' );

	}
}
?>
