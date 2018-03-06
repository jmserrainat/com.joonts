<?php
	function keydesign_importer() {
		add_theme_page('import-demo-full-custom', 'import-demo-full-custom', 'manage_options', 'import-demo', 'keydesign_import_demo' );
	}
	add_action( 'admin_menu', 'keydesign_importer' );

	function keydesign_import_demo() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.','intact' ) );
		}
		require plugin_dir_path( __FILE__ ) . '/import.php';
	}

	function keydesign_check_import_files($keydesign_demo_content, $rev_slider) {
		$keydesign_response = array();

		$keydesign_file_headers = @get_headers( $keydesign_demo_content );
		if( !strpos( $keydesign_file_headers[0], '200' ) ) {
		    $keydesign_response['errors'][] = 'demo_content.xml';
		}
		$keydesign_file_headers = @get_headers( $rev_slider );
		if( !strpos( $keydesign_file_headers[0], '200' ) ) {
		    $keydesign_response['errors'][] = 'revolution_slider.zip';
		}
		return $keydesign_response;
	}

	function keydesign_import_theme_files($upload_dir, $keydesign_demo_content, $rev_slider) {

	file_put_contents( $upload_dir.'/revolution_slider.zip', fopen( str_replace( " ", "%20",$rev_slider ), 'r' ) );
	file_put_contents( $upload_dir.'/demo_content.xml_.txt', fopen( str_replace( " ", "%20",$keydesign_demo_content ), 'r' ) );



	return array(
			'demo' => $upload_dir.'/demo_content.xml_.txt',
			'slider' => $upload_dir.'/revolution_slider.zip'
		);
	}
