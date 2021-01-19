<?php
namespace TZ\Realty;

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
		$realty = new Realty( get_the_ID() );

		if ( $realty->getImagesIds() && is_array( $realty->getImagesIds() ) ) {
			foreach ( $realty->getImagesIds() as $image ) {
				printf( '<a data-fancybox="gallery" href="%s">%s</a>',
					wp_get_attachment_image_url( $image, 'large' ),
					wp_get_attachment_image( $image, 'thumbnail' )
				);
			}
		}

		if ( $realty->getCost() ) {
			echo '<h6>' . __( 'Cost', 'understrap-child' ) . ': ' . $realty->getCost() . '$</h6>';
		}
		if ( $realty->getArea() ) {
			echo '<h6>' . __( 'Area', 'understrap-child' ) . ': ' . $realty->getArea() . 'm²</h6>';
		}
		if ( $realty->getLivingArea() ) {
			echo '<h6>' . __( 'Living Area', 'understrap-child' ) . ': ' . $realty->getLivingArea() . 'm²</h6>';
		}
		if ( $realty->getFloor() ) {
			echo '<h6>' . __( 'Floor', 'understrap-child' ) . ': ' . $realty->getFloor() . '</h6>';
		}
		if ( $realty->getCity() ) {
			printf( '<h6>' . __( 'City', 'understrap-child' ) . ': <a href="%s" target="_blank">%s</a></h6>',
				get_permalink( $realty->getCity() ),
				get_the_title( $realty->getCity() )
			);
		}
		if ( $realty->getAddress() ) {
			echo '<h6>' . __( 'Address', 'understrap-child' ) . ': ' . $realty->getAddress() . '</h6>';
		}
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
