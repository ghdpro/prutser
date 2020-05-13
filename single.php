<?php get_header(); ?>

<main class="container">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div class="row">
		<div class="col-sm-8">

			<?php
			endif;

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

			if ( is_active_sidebar( 'sidebar' ) ) :
			?>

		</div>

		<aside class="col-sm-4 sidebar">

			<?php dynamic_sidebar( 'sidebar' ) ?>

		</aside>
	</div>
<?php endif; ?>
</main>

<?php get_footer(); ?>
