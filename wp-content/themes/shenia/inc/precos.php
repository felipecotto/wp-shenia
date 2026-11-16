<?php
/**
 * Fonte única dos valores do site.
 *
 * Mude os números só aqui. As páginas mostram os valores de três formas:
 * 1. Block Bindings: um parágrafo ligado à fonte "shenia/preco" (aparece no editor também).
 * 2. Shortcode: [preco chave="terapia-individual.linha"].
 * 3. Em PHP: shenia_preco( 'terapia-individual.valor' ).
 *
 * A cobrança acontece no Cal.com/Stripe. Quando um valor mudar, atualize lá também.
 */

defined( 'ABSPATH' ) || exit;

function shenia_precos() {
	return array(
		'terapia-individual' => array(
			'nome'    => 'Terapia individual',
			'duracao' => '50 min',
			'eur'     => 97,
			'brl'     => 605,
			'modelo'  => 'por sessão · paga no agendamento',
		),
		'terapia-casal'      => array(
			'nome'    => 'Terapia de casal',
			'duracao' => '50 a 60 min',
			'eur'     => 107,
			'brl'     => 670,
			'modelo'  => 'por sessão · 10 sessões em 2 blocos',
			'bloco'   => array( 'eur' => 535, 'brl' => 3350 ),
		),
		'mentoria-individual' => array(
			'nome'    => 'Mentoria individual',
			'duracao' => '5 encontros de 60 min',
			'eur'     => 2987,
			'brl'     => 19198,
			'modelo'  => 'à vista com 10% de desconto ou em até 12 vezes',
		),
		'mentoria-grupo'     => array(
			'nome'    => 'Mentoria em grupo',
			'duracao' => '5 encontros de 60 min',
			'eur'     => 1250,
			'brl'     => 8988,
			'modelo'  => 'de 3 a 6 mentoradas · à vista com 10% de desconto ou em até 3 vezes',
		),
	);
}

function shenia_formatar_valor( $eur, $brl ) {
	return sprintf(
		'€%s / R$%s',
		number_format( (float) $eur, 0, ',', '.' ),
		number_format( (float) $brl, 0, ',', '.' )
	);
}

/**
 * Chaves aceitas: "<servico>.valor", "<servico>.linha", "<servico>.duracao",
 * "terapia-casal.bloco" e "mentoria.a-partir".
 */
function shenia_preco( $chave ) {
	$precos = shenia_precos();

	if ( 'mentoria.a-partir' === $chave ) {
		$m = $precos['mentoria-grupo'];
		return 'a partir de ' . shenia_formatar_valor( $m['eur'], $m['brl'] );
	}

	list( $servico, $campo ) = array_pad( explode( '.', (string) $chave, 2 ), 2, 'valor' );
	if ( empty( $precos[ $servico ] ) ) {
		return '[confirmar valor]';
	}
	$s = $precos[ $servico ];

	switch ( $campo ) {
		case 'duracao':
			return $s['duracao'];
		case 'bloco':
			return isset( $s['bloco'] ) ? shenia_formatar_valor( $s['bloco']['eur'], $s['bloco']['brl'] ) : '';
		case 'linha':
			return sprintf( '%s · %s %s', $s['duracao'], shenia_formatar_valor( $s['eur'], $s['brl'] ), $s['modelo'] );
		case 'valor':
		default:
			return shenia_formatar_valor( $s['eur'], $s['brl'] );
	}
}

add_action( 'init', function () {
	if ( function_exists( 'register_block_bindings_source' ) ) {
		register_block_bindings_source(
			'shenia/preco',
			array(
				'label'              => __( 'Preços do site', 'shenia' ),
				'get_value_callback' => function ( $args ) {
					return esc_html( shenia_preco( $args['chave'] ?? '' ) );
				},
			)
		);
	}

	add_shortcode( 'preco', function ( $atts ) {
		$atts = shortcode_atts( array( 'chave' => '' ), $atts, 'preco' );
		return esc_html( shenia_preco( $atts['chave'] ) );
	} );
} );
