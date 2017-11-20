<?php
/**
 * Plugin Name:     Procedural Image Generator
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          robert@pardalis.se
 * Author URI:      YOUR SITE HERE
 * Text Domain:     procedural-image-generator
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Procedural_Image_Generator
 */

include_once( plugin_dir_path( __FILE__ ) . 'vendor/autoload.php' );
include_once( plugin_dir_path( __FILE__ ) . 'vendor/roberteliason/pig/autoload.php' );


function generate_post_image( $post_id ) {
	$post = get_post( $post_id );
	$upload_dir = wp_upload_dir();
	$colors = [ 'rgba(255,220,190,0.15)',
		'rgba(190,255,220,0.15)',
		'rgba(220,190,255,0.15)',
		'rgba(255,220,250,0.10)',
		'rgba(150,255,220,0.10)',
		'rgba(220,250,255,0.10)', ];

	$ThePIG = New PIG_Space\Generators\Logo_PIG(
		$post->post_content,
		$colors,
		'transparent',
		55, 35, 25, 4200
	);

	$ThePIG->saveSVG($upload_dir['basedir'].'/background_'.$post_id.'.svg');
}
add_action( 'save_post', 'generate_post_image' );