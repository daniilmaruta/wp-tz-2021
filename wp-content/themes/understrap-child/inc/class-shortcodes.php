<?php

namespace TZ\Realty;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Shortcodes {

	public function __construct() {
		add_shortcode( 'realty_objects', [ $this, 'realtyObjects' ] );
	}

	public static function realtyObjects( $atts ) {

		$atts          = shortcode_atts( array(
			'count' => '10',
		), $atts );
		$args          = [
			'posts_per_page' => $atts['count'],
			'post_type'      => 'realty'
		];
		$realtyObjects = new \WP_Query( $args );
		ob_start();
		if ( $realtyObjects->have_posts() ) {
			echo '<ul>';
			while ( $realtyObjects->have_posts() ) {

				$realtyObjects->the_post();
				$realty        = new Realty( get_the_ID() );
				$featuredImage = $realty->getFeaturedImage();
				echo '<li>';
				echo '<div class="realtyFeaturedImage"><a href="' . get_permalink( get_the_ID() ) . '">' . $featuredImage . '</a></div>';
				echo '<div class="realtyDescription">' . $realty->getDescription() . '</div>';
				echo '</li>';

			}
			echo '</ul>';
		}

		$html = ob_get_clean();
		wp_reset_postdata();

		return $html;
	}

}

new Shortcodes();
