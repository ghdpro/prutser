<?php

if ( ! function_exists( 'prutser_entry_posted_on' ) ) :
	function prutser_entry_posted_on() {
		$time_format = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_format = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_format,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on"><i class="fas fa-clock"></i><a href="%1$s" rel="bookmark">%2$s</a></span>',
			esc_url( get_permalink() ),
			$time_string // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	}
endif;

if ( ! function_exists( 'prutser_entry_footer' ) ) :
	function prutser_entry_footer() {
		// Do not display post author for now

		prutser_entry_posted_on();

		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list ) {
			printf(
				'<span class="cat-links"><i class="fas fa-folder"></i><span class="screen-reader-text">%1$s</span>%2$s</span>',
				'Posted in ',
				$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf(
				'<span class="tags-links"><i class="fas fa-tag"></i><span class="screen-reader-text">%1$s</span>%2$s</span>',
				'Tags: ',
				$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fas fa-comment"></i>';
			comments_popup_link(
				sprintf(
					wp_kses(
						'Leave a Comment<span class="screen-reader-text"> on %s</span>',
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					'Edit <span class="screen-reader-text">%s</span>',
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-pencil-alt"></i>',
			'</span>'
		);

	}
endif;

if ( ! function_exists( 'prutser_post_nav' ) ) {
	function prutser_post_nav() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'prutser' ); ?></h2>
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fas fa-angle-left"></i>%title', 'Previous post link', 'prutser' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title<i class="fas fa-angle-right"></i>', 'Next post link', 'prutser' ) );
				}
				?>
			</div>
		</nav>
		<?php
	}
}

if ( ! function_exists( 'prutser_pagination' ) ) {
	function prutser_pagination( $args = array(), $class = 'pagination' ) {
		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) {
			return;
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'  => 2,
				'prev_next' => true,
				'prev_text' => '<i class="fas fa-angle-double-left"></i>',
				'next_text' => '<i class="fas fa-angle-double-right"></i>',
				'type'      => 'array',
				'current'   => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );
		?>
		<nav aria-label="<?php echo __( 'Posts navigation', 'prutser' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
			<ul class="pagination justify-content-center">
				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php echo str_replace( 'page-numbers', 'page-link', $link ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</li>
					<?php
				}
				?>
			</ul>
		</nav>
		<?php
	}
}
