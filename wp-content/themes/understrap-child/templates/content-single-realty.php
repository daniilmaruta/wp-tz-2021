<?php
/**
 * Single realty post partial template.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">

		<h4><?php _e( 'Description', 'understrap-child' ); ?></h4>

		<?php the_content(); ?>

		<?php
		$cost        = get_field( 'cost' );
		$area        = get_field( 'area' );
		$livingArea  = get_field( 'living_are' );
		$floor       = get_field( 'floor' );
		$city        = get_field( 'city' );
		$address     = get_field( 'address' );
		$images      = [];
		$countImages = 6;
		for ( $i = 1; $countImages > $i; $i ++ ) {
			$image = get_field( 'image_' . $i );
			if ( $image ) {
				array_push( $images, $image );
			}
		}

		if ( $images ) {
			foreach ( $images as $image ) {
				printf( '<a data-fancybox="gallery" href="%s">%s</a>',
					wp_get_attachment_image_url( $image, 'large' ),
					wp_get_attachment_image( $image, 'thumbnail' )
				);
			}
		}

		if ( $cost ) {
			echo '<h6>Cost: ' . $cost . '$</h6>';
		}
		if ( $area ) {
			echo '<h6>Area: ' . $area . 'm²</h6>';
		}
		if ( $livingArea ) {
			echo '<h6>Living Area: ' . $livingArea . 'm²</h6>';
		}
		if ( $floor ) {
			echo '<h6>Floor: ' . $floor . '</h6>';
		}
		if ( $city ) {
		    printf( '<h6>City: <a href="%s" target="_blank">%s</a></h6>',
			    get_permalink( $city ),
			    $city->post_title
            );
		}
		if ( $address ) {
			echo '<h6>Address: ' . $address . '</h6>';
		}
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
