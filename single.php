<?php get_header(); ?>

<main class="container">

	<?php

	if ( have_posts() ) :

		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

		prutser_post_nav();

		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endif;

	?>

</main>

<?php get_footer(); ?>
