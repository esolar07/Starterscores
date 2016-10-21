<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starterscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<!-- display featured image if it has one -->
		<?php if( has_post_thumbnail() ) { ?>
				<figure class='featured-image'>
					<?php the_post_thumbnail(); ?>
				</figure>
		<?php } ?>
	
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php starterscores_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		
			the_excerpt();

	//		wp_link_pages( array(
	//			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'starterscores' ),
	//			'after'  => '</div>',
	//		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php starterscores_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
