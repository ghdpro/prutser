<?php
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ( 1 === $comment_count ) {
				printf(
					esc_html( 'One thought on &ldquo;%1$s&rdquo;' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					// phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
					esc_html( _n( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'prutser' ) ),
					number_format_i18n( $comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="comment-navigation justify-content-between" id="comment-nav-above">
			<div class="row">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'prutser' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older Comments', 'prutser' ) ); ?>
					</div>
				<?php } ?>
				<?php if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer Comments &rarr;', 'prutser' ) ); ?>
					</div>
				<?php } ?>
			</div>
		</nav>
	<?php endif; ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="comment-navigation" id="comment-nav-above">
			<div class="row">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'prutser' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older Comments', 'prutser' ) ); ?>
					</div>
				<?php } ?>
				<?php if ( get_next_comments_link() ) { ?>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer Comments &rarr;', 'prutser' ) ); ?>
					</div>
				<?php } ?>
			</div>
		</nav>
			<?php
	endif;

		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html( 'Comments are closed.' ); ?></p>
			<?php
		endif;

	endif;

	comment_form();
	?>
</div>
