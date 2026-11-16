<?php
/**
 * Tema Shenia Karlsson.
 *
 * Cada responsabilidade fica num arquivo em /inc.
 */

defined( 'ABSPATH' ) || exit;

define( 'SHENIA_VERSION', '0.1.0' );
define( 'SHENIA_DIR', get_template_directory() );
define( 'SHENIA_URI', get_template_directory_uri() );

require SHENIA_DIR . '/inc/setup.php';
require SHENIA_DIR . '/inc/estilos-de-bloco.php';
require SHENIA_DIR . '/inc/precos.php';
require SHENIA_DIR . '/inc/svg.php';
