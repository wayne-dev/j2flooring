<?php
/*
  Plugin Name: J2 flooring
  Plugin URI: https://sadecweb.com/
  Description: 
  Version: 1.30
  Author: Sadecweb
  Author URI: https://www.sadecweb.com/
  Text Domain: sadecweb
  Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define WC_PLUGIN_FILE.
if ( ! defined( 'SD_PLUGIN_PATH' ) ) {
	define( 'SD_PLUGIN_PATH',plugin_dir_path( __FILE__ ));
}
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	function rugbuilder_scripts(){
		    if ( get_query_var( 'rugbuilder' ) ) {

				wp_register_script('rugbuilder',plugin_dir_url(__FILE__) .'/template/rugbuilder.js',array( 'jquery' ));
				wp_register_script('rugbuilder-scrollbar',plugin_dir_url(__FILE__) .'/template/js/jquery.scrollbar.js',array( 'jquery' ));
				wp_register_script('rugbuilder-zoom',plugin_dir_url(__FILE__) .'/template/js/jquery.zoom.min.js',array( 'jquery' ));
				
				wp_enqueue_script( 'rugbuilder' );
				wp_enqueue_script( 'rugbuilder-scrollbar' );
				wp_enqueue_script( 'rugbuilder-zoom' );

				wp_register_script('canvas',plugin_dir_url(__FILE__) .'/template/js/canvas.js',array( 'jquery' ));
				wp_enqueue_script( 'canvas' );
				
				$global_var = array( 
					"rugbuilder" => array(
						'background' => '',
						'border' => '',
						'width' => '',
						'height' => ''
					),
					"ajax_url" => admin_url( 'admin-ajax.php' ),
					"loading_img" => plugin_dir_url(__FILE__) . "/assets/img/ajax-loader.gif"
				);
				wp_localize_script('rugbuilder','global_var',$global_var);
			} else {
				wp_register_script('canvas-thumbnail',plugin_dir_url(__FILE__) .'assets/canvas_mini_thumbnail.js',array( 'jquery' ));
				wp_enqueue_script( 'canvas-thumbnail' );
			}
	}
	add_action( 'wp_enqueue_scripts', 'rugbuilder_scripts',0,100 );

	function admin_rugbuilder_scripts(){
		wp_register_script('canvas-thumbnail',plugin_dir_url(__FILE__) .'assets/canvas_mini_thumbnail.js',array( 'jquery' ));
		wp_enqueue_script( 'canvas-thumbnail' );

		wp_register_style( 'canvas-style', plugin_dir_url(__FILE__) . 'assets/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'canvas-style' );
	}
	add_action( 'admin_enqueue_scripts', 'admin_rugbuilder_scripts' );

	require_once("taxonomy-images/taxonomy-images.php");
	global $img_taxes;
	$taxonomy_image = get_option("taxonomy_image_plugin");
	foreach($taxonomy_image as $key => $img_id){
		$img = wp_get_attachment_image_src( $img_id, 'thumbnail' ) ;
		$img_taxes[$key] = $img[0];
	}

	require_once("radio-buttons-for-taxonomies/radio-buttons-for-taxonomies.php");
	require_once("inc/post-type.php");
	require_once("inc/rewrite.php");
	require_once("inc/taxonomy.php");
	require_once("inc/metaboxes.php");
	require_once("inc/ajax.php");
	require_once("inc/woocommerce.php");
}  

?>
