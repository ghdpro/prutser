<?php get_header(); ?>

<main class="container">

	<?php

	if ( have_posts() ) :
		?>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
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
