<?php get_header(); ?>

<main class="container">

	<?php

	if ( have_posts() ) :

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