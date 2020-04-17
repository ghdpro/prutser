<?php

/* Setup */


if (!function_exists('prutser_setup')):
	function prutser_setup() {
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
		register_nav_menus(array(
			'menu-top' => __('Top Menu', 'prutser'),
		));
	}
endif;
add_action('after_setup_theme', 'prutser_setup');


if (!function_exists('prutser_scripts')):
	function prutser_scripts() {
		$theme = wp_get_theme();
		// See also functions below when updating CDN links!
		wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), null);
		wp_enqueue_style('prutser', get_stylesheet_uri(), array('bootstrap'), $theme->get('Version'));
		wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js', array(), null, true);
		// Bootstrap 4 requires jQuery and yes is still compatible with jQuery 1.12 as included with WordPress
		wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array('jquery'), null, true);
	}
endif;
add_action('wp_enqueue_scripts', 'prutser_scripts');


if (!function_exists( 'prutser_cdn_style_attributes' )):
	function prutser_cdn_style_attributes($html, $handle) {
		if ($handle === 'bootstrap')
			return str_replace(" media='all'", " media='all' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'", $html);
		return $html;
	}
endif;
add_filter('style_loader_tag', 'prutser_cdn_style_attributes', 10, 2);


if (!function_exists( 'prutser_cdn_script_attributes' )):
	function prutser_cdn_script_attributes($tag, $handle) {
		if ($handle === 'popper')
			return str_replace(".js'>", ".js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'>", $tag);
		if ($handle === 'bootstrap')
			return str_replace(".js'>", ".js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'>", $tag);
		return $tag;
	}
endif;
add_filter('script_loader_tag', 'prutser_cdn_script_attributes', 10, 2);
