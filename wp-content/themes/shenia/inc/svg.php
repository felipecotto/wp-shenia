<?php
/**
 * SVGs do tema (logo e texturas), lidos de assets/svg e impressos inline.
 */

defined( 'ABSPATH' ) || exit;

function shenia_svg( $nome, $rotulo = '' ) {
	$arquivo = SHENIA_DIR . '/assets/svg/' . sanitize_file_name( $nome ) . '.svg';
	if ( ! file_exists( $arquivo ) ) {
		return '';
	}
	$svg = file_get_contents( $arquivo ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( $rotulo ) {
		$svg = preg_replace( '/<svg /', '<svg role="img" aria-label="' . esc_attr( $rotulo ) . '" ', $svg, 1 );
	} else {
		$svg = preg_replace( '/<svg /', '<svg aria-hidden="true" focusable="false" ', $svg, 1 );
	}
	return $svg;
}
