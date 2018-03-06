<?php

/**
 * Initialize portfolio custom post type
 */

 // ------------------------------------------------------------------------
 // Register portfolio custom post type
 // ------------------------------------------------------------------------

 	function keydesign_portfolio_post_type() {
 		$labels = array(
 			'name'               => esc_html_x( 'Portfolio', 'post type general name', 'keydesign' ),
 			'singular_name'      => esc_html_x( 'Portfolio', 'post type singular name', 'keydesign' ),
 			'menu_name'          => esc_html_x( 'Portfolio', 'admin menu', 'keydesign' ),
 			'name_admin_bar'     => esc_html_x( 'Portfolio', 'add new on admin bar', 'keydesign' ),
 			'add_new'            => esc_html_x( 'Add New', 'portfolio', 'keydesign' ),
 			'add_new_item'       => esc_html__( 'Add New Portfolio Item', 'keydesign' ),
 			'new_item'           => esc_html__( 'New Portfolio Item', 'keydesign' ),
 			'edit_item'          => esc_html__( 'Edit Portfolio Item', 'keydesign' ),
 			'view_item'          => esc_html__( 'View Portfolio Item', 'keydesign' ),
 			'all_items'          => esc_html__( 'All Portfolio Items', 'keydesign' ),
 			'search_items'       => esc_html__( 'Search Portfolio Items', 'keydesign' ),
 			'parent_item_colon'  => esc_html__( 'Parent Portfolios:', 'keydesign' ),
 			'not_found'          => esc_html__( 'No portfolio items found.', 'keydesign' ),
 			'not_found_in_trash' => esc_html__( 'No portfolio items found in Trash.', 'keydesign' )
 		);

    $labels = apply_filters( 'keydesign_portfolio_item_labels', $labels ); // allow filtering

 		$args = array(
 			'labels'             => $labels,
 	    'description'        => esc_html__( 'Description.', 'keydesign' ),
 			'public'             => true,
 			'publicly_queryable' => true,
 			'show_ui'            => true,
 			'show_in_menu'       => true,
 			'menu_icon'          => 'dashicons-schedule',
 			'query_var'          => true,
 			'rewrite'            => array( 'slug' => 'portfolio' ),
 			'capability_type'    => 'post',
 			'has_archive'        => false,
 			'hierarchical'       => false,
 			'menu_position'      => null,
 			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
 			'taxonomies' 				 => array('post_tag','portfolio-category')
 		);

    $args = apply_filters( 'keydesign_portfolio_item_args', $args ); // allow filtering

 		register_post_type( 'portfolio', $args );

 	// Create portfolio categories taxonomy
 		register_taxonomy(
 			'portfolio-category',
 			array('portfolio'),
 			array(
 				'hierarchical'=> true,
 				'label' => esc_html__( 'Categories','keydesign' ),
 				'rewrite' => array( 'slug' => 'portfolio-category' ),
 			)
 		);
 	}

  function keydesign_custom_flush_rules()
  {
  	//defines the post type so the rules can be flushed.
  	keydesign_portfolio_post_type();
  	//flush the rules.
  	flush_rewrite_rules();
  }
  add_action('after_theme_switch', 'keydesign_custom_flush_rules');
  add_action('init', 'keydesign_portfolio_post_type');

?>
