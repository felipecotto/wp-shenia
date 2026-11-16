<?php
/**
 * Variações de estilo dos blocos nativos.
 * O visual de cada uma fica em assets/css/base.css (classes is-style-*).
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	$estilos = array(
		'core/group'     => array(
			'fundo-ouro'        => __( 'Fundo ouro', 'shenia' ),
			'fundo-areia'       => __( 'Fundo areia', 'shenia' ),
			'fundo-areia-claro' => __( 'Fundo areia claro', 'shenia' ),
			'fundo-oliva'       => __( 'Fundo oliva (texto claro)', 'shenia' ),
			'fundo-grafite'     => __( 'Fundo grafite (texto claro)', 'shenia' ),
		),
		'core/paragraph' => array(
			'sobretitulo' => __( 'Sobretítulo', 'shenia' ),
			'marcador'    => __( 'Marcador de revisão', 'shenia' ),
		),
		'core/list'      => array(
			'linhas' => __( 'Lista com linhas', 'shenia' ),
		),
		'core/button'    => array(
			'secundario' => __( 'Secundário (contorno)', 'shenia' ),
			'link'       => __( 'Link com seta', 'shenia' ),
		),
	);

	foreach ( $estilos as $bloco => $variacoes ) {
		foreach ( $variacoes as $nome => $rotulo ) {
			register_block_style( $bloco, array( 'name' => $nome, 'label' => $rotulo ) );
		}
	}
} );
