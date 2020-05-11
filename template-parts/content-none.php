<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'prutser' ); ?></h1>
	</header>

	<div class="page-content">
		<?php
		if ( is_search() ) :
			?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'prutser' ); ?></p>
			<?php
			get_search_form();
		else :
			?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'prutser' ); ?></p>
			<?php
			get_search_form();

			the_widget( 'WP_Widget_Recent_Posts' );

			the_widget( 'WP_Widget_Tag_Cloud' );
		endif;
		?>
	</div>
</section>
