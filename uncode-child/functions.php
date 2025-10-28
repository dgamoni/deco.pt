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
add_shortcode( 'lp_ac_contacts', 'shortcode_lp_ac_contacts'); // [lp_ac_contacts]
function shortcode_lp_ac_contacts($atts) {
	$filename = "item-contacts.php";
	return includeFile($filename);
}
//load the LP scripts:
function lp_ac_enqueue_scripts() {
	//is_page() accepts page title, page ID and the slug.
    if(is_page('quero-aconselhamento-de-habitacao-e-energia')){
		$compressedFiles = 0;
		wp_enqueue_script( 'selectize_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/selectize.min.js'), array('jquery'), '', true );
		if(!$compressedFiles){
			wp_enqueue_script( 'lp_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/main.js'), array('jquery'), rand(), true );
		} else {
			wp_enqueue_script( 'lp_script', (site_url() . '/custom-pages/alteracoesclimaticas/scripts/lp_ac_js.js'), array('jquery'), rand(), true );
		}
		wp_localize_script( 'lp_script', 'lp_ac_data', array(
            'json_url' => site_url() . '/custom-pages/alteracoesclimaticas/json/Contactos_BHE.json',
        ));
	}
}    
add_action( 'wp_enqueue_scripts', 'lp_ac_enqueue_scripts' );


// --- SOLUÇÃO FINAL ELEGANTE: COMPONENTE DE MAPA AUTÓNOMO (CORRIGIDO) ---

/**
 * 1. Shortcode [mapa_final] que carrega o nosso novo componente autónomo.
 */
function shortcode_mapa_autonomo() {
    ob_start();
    $caminho_componente = ABSPATH . 'custom-pages/alteracoesclimaticas/mapa-standalone.php';

    if ( file_exists( $caminho_componente ) ) {
        include $caminho_componente;
    } else {
        return 'Erro: Componente do mapa autónomo não foi encontrado.';
    }

    return ob_get_clean();
}
add_shortcode( 'mapa_final', 'shortcode_mapa_autonomo' );

/**
 * 2. Carrega os scripts JS necessários quando o shortcode [mapa_final] é usado.
 */
function carregar_scripts_mapa_autonomo() { // O nome da função está aqui
    global $post;
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'mapa_final' ) ) {
        
        wp_enqueue_script( 
            'selectize-script-final', 
            site_url( '/custom-pages/alteracoesclimaticas/scripts/selectize.min.js' ), 
            array('jquery'), 
            null, 
            true 
        );

        wp_enqueue_script( 
            'lp-ac-script-final', 
            site_url( '/custom-pages/alteracoesclimaticas/scripts/lp_ac_js.js' ), 
            array('jquery'), 
            null, 
            true 
        );
    }
}
// A linha abaixo está agora CORRIGIDA para usar o nome de função correto.
add_action( 'wp_enqueue_scripts', 'carregar_scripts_mapa_autonomo' ); 

// --- FIM DA SOLUÇÃO ---
// 
// 
function add_meta_pixel_to_head() {
    ?>
    

<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1379220637059571');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1379220637059571&ev=PageView&noscript=1"
/></noscript>


    <?php
}
add_action( 'wp_head', 'add_meta_pixel_to_head' );
