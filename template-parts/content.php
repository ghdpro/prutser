<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		endif;
		?>
	</header>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					'Continue reading<i class="fas fa-angle-right"></i><span class="screen-reader-text"> "%s"</span>',
					array(
						'i'    => array(
							'class' => array(),
						),
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'prutser' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer">
		<?php prutser_entry_footer(); ?>
	</footer>

</article>

