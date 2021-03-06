<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starterscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">	
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<!-- display featured image if it has one -->
		<?php if( has_post_thumbnail() ) { ?>
				<figure class='featured-image'>
					<a href= '<?php echo esc_url( get_permalink() ); ?>' rel='bookmark'>
						<?php the_post_thumbnail(); ?>
					</a>
				</figure>
		<?php } ?>
	</header><!-- .entry-header -->

	<?php
		if( has_excerpt( $post->ID ) ) {
            echo '<div class="deck">';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '</div><!-- .deck -->';
        }
	?>


	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'starterscores' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'starterscores' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
