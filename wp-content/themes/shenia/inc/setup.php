<?php
/**
 * Configuração básica do tema: suportes, CSS e limpeza do <head>.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'shenia', SHENIA_DIR . '/languages' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'responsive-embeds' );
	remove_theme_support( 'core-block-patterns' );
	add_editor_style( 'assets/css/base.css' );
} );

// CSS do tema no site.
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'shenia-base',
		SHENIA_URI . '/assets/css/base.css',
		array(),
		SHENIA_VERSION
	);
} );

// Pré-carrega as fontes usadas na primeira tela.
add_action( 'wp_head', function () {
	foreach ( array( '400', '600' ) as $peso ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( SHENIA_URI . '/assets/fonts/barlow-' . $peso . '.woff2' )
		);
	}
}, 1 );

// Remove o que o site não usa.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
add_filter( 'xmlrpc_enabled', '__return_false' );

// Comentários desligados no site todo.
add_action( 'init', function () {
	foreach ( get_post_types() as $tipo ) {
		if ( post_type_supports( $tipo, 'comments' ) ) {
			remove_post_type_support( $tipo, 'comments' );
			remove_post_type_support( $tipo, 'trackbacks' );
		}
	}
} );
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );

// Ambiente de desenvolvimento e homologação fora do Google.
// Em produção, defina WP_ENVIRONMENT_TYPE como "production" no wp-config.php.
add_action( 'init', function () {
	if ( 'production' !== wp_get_environment_type() ) {
		add_filter( 'wp_robots', 'wp_robots_no_robots' );
		add_action( 'send_headers', function () {
			header( 'X-Robots-Tag: noindex, nofollow', true );
		} );
	}
} );

// Categoria própria para os patterns do tema.
add_action( 'init', function () {
	register_block_pattern_category( 'shenia-secoes', array( 'label' => __( 'Seções Shenia', 'shenia' ) ) );
	register_block_pattern_category( 'shenia-paginas', array( 'label' => __( 'Páginas Shenia', 'shenia' ) ) );
} );
