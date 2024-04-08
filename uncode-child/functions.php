<?php
add_action('after_setup_theme', 'uncode_language_setup');
function uncode_language_setup()
{
	load_child_theme_textdomain('uncode', get_stylesheet_directory() . '/languages');
}

function theme_enqueue_styles()
{
	$production_mode = ot_get_option('_uncode_production');
	$resources_version = ($production_mode === 'on') ? null : rand();
	if ( function_exists('get_rocket_option') && ( get_rocket_option( 'remove_query_strings' ) || get_rocket_option( 'minify_css' ) || get_rocket_option( 'minify_js' ) ) ) {
		$resources_version = null;
	}
	$parent_style = 'uncode-style';
	$child_style = array('uncode-style');
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/library/css/style.css', array(), $resources_version);
	wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', $child_style, $resources_version);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles', 100);

// load core functions
require_once get_stylesheet_directory() . '/core/load.php';

//LP Alterações Climáticas 2022.03
// Shortcode to output custom PHP in Visual Composer
function includeFile($filename){
	ob_start();
	$filename = ABSPATH .'/'.trim("custom-pages/alteracoesclimaticas/" . $filename);
	if (is_file($filename)){
		@include($filename);
	}
	return ob_get_clean();
}
add_shortcode( 'lp_ac_map', 'shortcode_lp_ac_map');
function shortcode_lp_ac_map($atts) {
	$filename = "item-map.php";
	return includeFile($filename);
}
add_shortcode( 'lp_ac_contacts', 'shortcode_lp_ac_contacts');
function shortcode_lp_ac_contacts($atts) {
	$filename = "item-contacts.php";
	return includeFile($filename);
}
//load the LP scripts:
function lp_ac_enqueue_scripts() {
	//is_page() accepts page title, page ID and the slug.
    if(is_page('alteracoes-climaticas')){
		$compressedFiles = 1;
		wp_enqueue_script( 'selectize_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/selectize.min.js'), array('jquery'), '', true );
		if(!$compressedFiles){
			wp_enqueue_script( 'lp_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/main.js'), array('jquery'), '', true );
		} else {
			wp_enqueue_script( 'lp_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/lp_ac_js.js'), array('jquery'), '', true );
		}
	}
}    
add_action( 'wp_enqueue_scripts', 'lp_ac_enqueue_scripts' );