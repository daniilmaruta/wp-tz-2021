<?php
namespace TZ\Realty;

/**
 * Class Ajax
 */

class Ajax {

	public function __construct() {
		$this->addActions();
	}

	public function addActions() {

		add_action( 'enqueue_scripts', [ $this, 'enqueueScripts' ] );

		if ( wp_doing_ajax() ) {
			add_action( 'wp_ajax_tz_add_realty', [ $this, 'addRealty' ] );
			add_action( 'wp_ajax_nopriv_tz_add_realty', [ $this, 'addRealty' ] );
		}

	}

	public static function addRealty() {
		check_ajax_referer( 'tz-nonce', 'nonce' );

		ob_start();
		$error = false;
		// TODO Develop functional for add new Realty post
		$html = ob_get_clean();
		wp_send_json( [ 'html' => $html, 'error' => $error ] );
		wp_die();
	}

	function enqueueScripts() {
		$the_theme = wp_get_theme();
		wp_enqueue_script( 'tz_add_realty', get_stylesheet_directory_uri() . '/js/ajax.js', [ 'child-jquery3' ], $the_theme->get( 'Version' ), true );
		wp_localize_script( 'tz_add_realty', 'tz_realty_ajax',
			[
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'tz-nonce' ),
			]
		);

	}

}

new Ajax();
