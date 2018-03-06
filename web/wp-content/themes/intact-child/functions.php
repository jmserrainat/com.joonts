<?php
/**
 * Intact functions file
 *
 * @package intact
 * by KeyDesign
 */

 add_action( 'wp_enqueue_scripts', 'kd_enqueue_parent_theme_style', 5 );

 if ( ! function_exists( 'kd_enqueue_parent_theme_style' ) ) {
     /**
      * enqueue the parent css file
      */
     function kd_enqueue_parent_theme_style() {

         wp_enqueue_style( 'bootstrap' );
         wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );
         wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
     }
 }

 add_action( 'after_setup_theme', 'kd_child_theme_setup' );

 if ( ! function_exists( 'kd_child_theme_setup' ) ) {
     /**
      * load child language files
      */
     function kd_child_theme_setup() {
         load_child_theme_textdomain( 'intact', get_stylesheet_directory() . '/languages' );
     }
 }

 // -------------------------------------
 // Edit below this line
 // -------------------------------------
