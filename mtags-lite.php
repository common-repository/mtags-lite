<?php
/*
	.
	Plugin Name: Mtags Lite
	Plugin URI: http://plugins.wanderlima.com/
	Description: Simple plugin that put description and keywords for all pages and posts of your blog and clean unnecessary info in wp_head() for secure reasons.
	Version: 1.0
	Author: Wander Lima
	Author URI: http://wanderlima.com/
	License: GPL2
	.
	Keywords: tags, user default and tags + user default
	Description: excerpt, user default and excerpt + user default
	Remove: rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link
	.
*/




// Idiomas

load_plugin_textdomain( "mtags", "/wp-content/plugins/mtags-lite/lang/" );




/***********************************************
/ 	ACÕES DE ATIVAÇÃO E DESATIVAÇÃO DO PLUGIN
/***********************************************/

function mtags_install(){

	// campos
	add_option( "mtags_keywords", 					__( "Exemplo: agencia,comunicacao,digital","mtags" ),	 					"", "yes" );
	add_option( "mtags_description", 				__( "Exemplo: Agência de Comunicação Digital em Florianópolis","mtags" ),	"", "yes" );
	add_option( "mtags_update", 					"14", 																		"", "yes" );

	// opções de comportamento
	add_option( "mtags_opt_description",			"1",	 																	"", "yes" );
	add_option( "mtags_opt_keywords",				"1", 																		"", "yes" );

	// opções adicionais
	add_option( "mtags_opt_rsd",					"",																			"", "yes" );
	add_option( "mtags_opt_wlwmanifest", 			"",																			"", "yes" );
	add_option( "mtags_opt_generator", 				"", 																		"", "yes" );
	add_option( "mtags_opt_start_post_rel", 		"", 																		"", "yes" );
	add_option( "mtags_opt_index_rel", 				"", 																		"", "yes" );
	add_option( "mtags_opt_adjacent_posts_rel", 	"",		 																	"", "yes" );

}

register_activation_hook( __FILE__, "mtags_install" );

function mtags_uninstall(){

	// campos
	delete_option( "mtags_keywords" );
	delete_option( "mtags_description" );
	delete_option( "mtags_update" );

	// opções de comportamento
	delete_option( "mtags_opt_description" );
	delete_option( "mtags_opt_keywords" );

	// opções adicionais
	delete_option( "mtags_opt_rsd" );
	delete_option( "mtags_opt_wlwmanifest" );
	delete_option( "mtags_opt_generator" );
	delete_option( "mtags_opt_start_post_rel" );
	delete_option( "mtags_opt_index_rel" );
	delete_option( "mtags_opt_adjacent_posts_rel" );

}

register_deactivation_hook( __FILE__, "mtags_uninstall" );




/***********************************************
/			PAINEL ADMINISTRATIVO
/***********************************************/

// Páginas

function mtags_editar(){
	include_once( "mtags-editar.php" );
}

function mtags_opt(){
	include_once( "mtags-opt.php" );
}

// Montar o menu

function mtags_menu() {

	add_menu_page	( "MTags Lite", 	"MTags Lite", "7", "mtags_editar", "mtags_editar", WP_PLUGIN_URL . "/mtags-lite/img/mtags-ico.png" );
	add_submenu_page( "mtags_editar", 	"MTags Lite /" . __( "Opções Avançadas","mtags" ), __( "Opções","mtags " ), "7", "mtags_opt", "mtags_opt");

}

// Ativa o menu

add_action( "admin_menu", "mtags_menu" );




/***********************************************
/		ATUALIZAR BLOG DESCRIPTION DO WP
/***********************************************/

if ( $_POST["action"] == "update" ) mtags_update();
	
function mtags_update() {

	$novo_description = $_POST["mtags_description"];
	update_option( "blogdescription", $novo_description );

}




/***********************************************
/				FUNÇÕES AUXILIARES
/***********************************************/


function Cut($string, $max_length){
	if (strlen($string) > $max_length){
		$string = substr($string, 0, $max_length);
		$pos = strrpos($string, " ");
		if($pos === false) {
				return substr($string, 0, $max_length);
		}
			return substr($string, 0, $pos);
	}else{
		return $string;
	}
}

function get_tax( $id = '' ) {

	global $post;

	if ( empty( $id ) )
		$id = $post->ID;

	if ( !empty( $id ) ) {

		$post_taxonomies = array();
		$post_type = get_post_type( $id );
		$taxonomies = get_object_taxonomies( $post_type , 'names' );

		foreach ( $taxonomies as $taxonomy ) {

			$term_links = array();
			$terms = get_the_terms( $id, $taxonomy );

			if ( is_wp_error( $terms ) )
				return $terms;

			if ( $terms ) {
				foreach ( $terms as $term ) {
					$link = get_term_link( $term, $taxonomy );
					if ( is_wp_error( $link ) )
						return $link;
					$term_links[] = '<a href="' . $link . '" rel="' . $taxonomy . '">' . $term->name . '</a>';
				}
			}

			$term_links = apply_filters( "term_links-$taxonomy" , $term_links );
			$post_terms[$taxonomy] = $term_links;

		}

		return $post_terms;

	}else {
		return false;
	}

}

function get_tax_list( $id = '' , $echo = true ) {

	global $post;

	if ( empty( $id ) )
		$id = $post->ID;

	if ( !empty( $id ) ) {
		$my_terms = get_tax( $id );
		if ( $my_terms ) {
			$my_taxonomies = array();
			foreach ( $my_terms as $taxonomy => $terms ) {
				$my_taxonomy = get_taxonomy( $taxonomy );
				if ( !empty( $terms ) )
					$my_taxonomies[] = $my_taxonomy->name . ",";
//					$my_taxonomies[] = '<span class="' . $my_taxonomy->name . '-links">' . '<span class="entry-utility-prep entry-utility-prep-' . $my_taxonomy->name . '-links">' . $my_taxonomy->labels->name . ': ' . implode( $terms , ', ' ) . '</span></span>';
			}

			if ( !empty( $my_taxonomies ) ) {
				$output = "";
//				$output = '<ul>' . "\n";
				foreach ( $my_taxonomies as $my_taxonomy ) {
					$output .= $my_taxonomy;
//					$output .= '<li>' . $my_taxonomy . '</li>' . "\n";
				}
				$output .= "";
//				$output .= '</ul>' . "\n";
			}

			if ( $echo )
				echo $output;
			else
				return $output;
		} else {
			return;
		}
	} else {
		return false;
	}
} 




/***********************************************
/				RETURN DO PLUGIN
/***********************************************/


// Funções das keywords

function mtags_keywords( $opt ){

	$resultado = "";

	if( $opt == "0" ) // Padrão
		$resultado = mtags_padrao_keywords();

	else if( $opt == "1" ) // Padrão + Tags
		$resultado = mtags_padrao_tags_keywords();

	else if( $opt == "2" ) // Tags
		$resultado = mtags_tags_keywords();

	if( $resultado == "" )
		$resultado = get_option( "mtags_keywords" );

	$resultado = Cut( $resultado, 250 );

	return $resultado;

}

// Retorna string de keywords padrão

function mtags_padrao_keywords(){

	$resultado = get_option( "mtags_keywords" );
	return $resultado;

}

// Retorna string de tags do post

function mtags_tags_keywords(){

	global $post;
	$tags = "";

	if( is_single() ){

		$terms = wp_get_post_terms( $post->ID, 'category' );
		foreach( $terms as $term ) {
			$tags = $tags . $term->name . ',';
		}

		$terms = wp_get_post_terms( $post->ID, 'post_tag' );
		foreach( $terms as $term ) {
			$tags = $tags . $term->name . ',';
		}

		return $tags;

	}else{

		 mtags_padrao_keywords();

	}

}

// Retorna string das keywords padrão e das tags do post

function mtags_padrao_tags_keywords(){

	$keywords = mtags_tags_keywords();
	$resultado = "$keywords " . mtags_padrao_keywords();

	return $resultado;

}

// Funções do description

function mtags_description($opt){

	$resultado = "";

	if( $opt == "0" ) // Padrão
		$resultado = mtags_padrao_description();

	else if( $opt == "1" ) // Padrão + Excerpt
		$resultado = mtags_padrao_excerpt_description();

	else if( $opt == "2" ) // Excerpt
		$resultado = mtags_excerpt_description();

	if( $resultado == "" )
		$resultado = get_option( "mtags_description" );

	$resultado = Cut( $resultado, 155 );

	return $resultado;

}

// Retorna string do description padrão

function mtags_padrao_description(){

	$resultado = get_option( "mtags_description" );
	return $resultado;

}

// Retorna string do excerpt do post

function mtags_excerpt_description(){

	global $post;
	global $wpdb;

	if( is_single() ){

		$excerpt = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->posts . ' WHERE ID = ' . $post->ID . ' LIMIT 1' );
		return $excerpt[0]->post_excerpt;

	}else if( is_page() ){

		$meu_post = get_post( $post->ID );
		$resultado = strip_tags( $meu_post->post_content );

		return $resultado;

	}else{

		mtags_padrao_description();

	}

}

// Retorna string do excerpt e das tags do post

function mtags_padrao_excerpt_description(){

	$excerpt = mtags_excerpt_description();
	$resultado = "$excerpt " . mtags_padrao_description();

	return $resultado;

}

// Mágica

function mtags_lite(){

	$keywords = 	mtags_keywords( get_option( "mtags_opt_keywords" ) );
	$description =	mtags_description( get_option( "mtags_opt_description" ) );

	echo "<meta name=\"keywords\" content=\"" . $keywords . "\" />\n";
	echo "<meta name=\"description\" content=\"" . $description . "\" />\n";
	echo "<meta name=\"revisit-after\" content=\"" . get_option( "mtags_update" ) . " days\" />\n";

}


// Inicia o plugin

add_action( "wp_head", "mtags_lite" );


// Opções adicionais

$rsd = 					get_option( "mtags_opt_rsd" );
$wlwmanifest = 			get_option( "mtags_opt_wlwmanifest" );
$generator =			get_option( "mtags_opt_generator" );
$start_post_rel =		get_option( "mtags_opt_start_post_rel" );
$index_rel = 			get_option( "mtags_opt_index_rel" );
$adjacent_posts_rel = 	get_option( "mtags_opt_adjacent_posts_rel" );

if ( $rsd == "1" ) 
	remove_action( "wp_head", "rsd_link" );

if ( $wlwmanifest == "1" ) 
	remove_action( "wp_head", "wlwmanifest_link" );

if ( $generator == "1" ) 
	remove_action( "wp_head", "wp_generator" );

if ( $start_post_rel == "1" ) 
	remove_action( "wp_head", "start_post_rel_link" );

if ( $index_rel == "1" ) 
	remove_action( "wp_head", "index_rel_link" );

if ( $adjacent_posts_rel == "1" ) 
	remove_action( "wp_head", "adjacent_posts_rel_link" );

?>