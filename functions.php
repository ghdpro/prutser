<?php

/**
 * Setup
 */

if ( ! function_exists( 'prutser_setup' ) ) :
	function prutser_setup() {
		load_theme_textdomain( 'prutser', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support(
			'html5',
			array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' )
		);
		register_nav_menus(
			array(
				'menu-top' => __( 'Top Menu', 'prutser' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'prutser_setup' );

if ( ! function_exists( 'prutser_content_width' ) ) :
	function prutser_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'prutser_content_width', 640 );
	}
endif;
add_action( 'after_setup_theme', 'prutser_content_width', 0 );

if ( ! function_exists( 'prutser_scripts' ) ) :
	function prutser_scripts() {
		$theme = wp_get_theme();
		wp_enqueue_style(
			'prutser',
			get_stylesheet_uri(),
			array(),
			$theme->get( 'Version' )
		);
		// Required for Bootstrap
		wp_enqueue_script(
			'popperjs',
			get_template_directory_uri() . '/assets/js/popper.min.js',
			array(),
			'2.9.2',
			true
		);
		// Bootstrap 5
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/assets/js/bootstrap.min.js',
			array(),
			'5.0.1',
			true
		);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'prutser_scripts' );

if ( ! function_exists( 'prutser_widgets_init' ) ) :
	function prutser_widgets_init() {
		register_sidebar(
			array(
				'name'          => __( 'Navbar', 'prutser' ),
				'id'            => 'navbar',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Sidebar', 'prutser' ),
				'id'            => 'sidebar',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Left', 'prutser' ),
				'id'            => 'footer-left',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Middle', 'prutser' ),
				'id'            => 'footer-middle',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
		register_sidebar(
			array(
				'name'          => __( 'Footer Right', 'prutser' ),
				'id'            => 'footer-right',
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
endif;
add_action( 'widgets_init', 'prutser_widgets_init' );

/**
 * NavWalker (for menu's)
 */

if ( ! function_exists( 'prutser_register_navwalker' ) ) :
	function prutser_register_navwalker() {
		require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
	}
endif;
add_action( 'after_setup_theme', 'prutser_register_navwalker' );

function prefix_bs5_dropdown_data_attribute( $atts, $item, $args ) {
	if ( is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		if ( array_key_exists( 'data-toggle', $atts ) ) {
			unset( $atts['data-toggle'] );
			$atts['data-bs-toggle'] = 'dropdown';
		}
	}

	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3 );

/**
 * Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Remove WordPress update notifications
 */
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );
