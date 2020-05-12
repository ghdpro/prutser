<?php get_header(); ?>

<main class="container">

	<?php

	if ( have_posts() ) :
		?>
		<header class="page-header">
			<h1 class="page-title">
				<?php esc_html_e( 'Search results for: ', 'prutser' ); ?>
				<span class="page-description"><?php echo get_search_query(); ?></span>
			</h1>
		</header>
		<?php
		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', 'excerpt' );

		endwhile;

		prutser_pagination();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;

	?>

</main>

<?php get_footer(); ?>
