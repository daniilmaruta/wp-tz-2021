<?php
namespace TZ\Realty;

/**
 * Single city partial template.
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

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>
		<?php
		$args          = [
			'posts_per_page' => 10,
			'post_type'      => 'realty',
			'meta_key'       => 'city',
			'meta_value'     => $post->ID,
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

		echo ob_get_clean();
		wp_reset_postdata();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
