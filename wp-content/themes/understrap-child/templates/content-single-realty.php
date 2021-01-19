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

		echo $realty->getDescription();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
