<?php

/**
 * Setup
 */

if ( ! function_exists( 'prutser_setup' ) ) :
	function prutser_setup() {
		load_theme_textdomain( 'prutser', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
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
			'1.16.1',
			true
		);
		// Bootstrap 4 requires jQuery and yes is still compatible with jQuery 1.12 as included with WordPress
		wp_enqueue_script(
			'bootstrap',
			get_template_directory_uri() . '/assets/js/bootstrap.min.js',
			array( 'jquery' ),
			'4.4.1',
			true
		);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'prutser_scripts' );

/**
 * NavWalker (for menu's)
 */

if ( ! function_exists( 'prutser_register_navwalker' ) ) :
	function prutser_register_navwalker() {
		require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
	}
endif;
add_action( 'after_setup_theme', 'prutser_register_navwalker' );

/**
 * Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';
