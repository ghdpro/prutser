<?php get_header(); ?>

<main class="container">
	<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
	<div class="row">
		<div class="col-sm-8">

			<?php
			endif;

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
