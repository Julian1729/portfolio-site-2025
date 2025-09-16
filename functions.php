<?php

/**
 * julian2025 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package julian2025
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function julian2025_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on julian2025, use a find and replace
		* to change 'julian2025' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('julian2025', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'julian2025'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'julian2025_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'julian2025_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function julian2025_content_width()
{
	$GLOBALS['content_width'] = apply_filters('julian2025_content_width', 640);
}
add_action('after_setup_theme', 'julian2025_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function julian2025_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'julian2025'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'julian2025'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'julian2025_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function julian2025_scripts()
{
	wp_enqueue_style('julian2025-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('julian2025-style', 'rtl', 'replace');

	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);
	wp_enqueue_script('tilt-js', get_template_directory_uri() . '/js/vendor/tilt.jquery.min.js', array('jquery'), '1.7.0', true);

	wp_enqueue_script('julian2025-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'julian2025_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Taxonomies and Post Types
require get_template_directory() . '/inc/taxonomies.php';
require get_template_directory() . '/inc/post-types.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Helper functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Allow SVG uploads
 */
function julian2025_allow_svg_uploads($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'julian2025_allow_svg_uploads');

/**
 * Fix SVG display in media library
 */
function julian2025_fix_svg_display($response, $attachment, $meta)
{
	if ($response['type'] === 'image' && $response['subtype'] === 'svg+xml') {
		$response['image'] = array(
			'src' => $response['url'],
		);
	}
	return $response;
}
add_filter('wp_prepare_attachment_for_js', 'julian2025_fix_svg_display', 10, 3);

/**
 * Sanitize SVG uploads for security
 */
function julian2025_sanitize_svg($file)
{
	$file_name = isset($file['name']) ? $file['name'] : '';
	$wp_filetype = wp_check_filetype_and_ext($file['tmp_name'], $file_name);
	$type = !empty($wp_filetype['type']) ? $wp_filetype['type'] : '';

	if ($type === 'image/svg+xml') {
		$svg_content = file_get_contents($file['tmp_name']);

		// Basic SVG sanitization - remove script tags and javascript
		$svg_content = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $svg_content);
		$svg_content = preg_replace('/javascript:/i', '', $svg_content);
		$svg_content = preg_replace('/on\w+\s*=/i', '', $svg_content);

		file_put_contents($file['tmp_name'], $svg_content);
	}

	return $file;
}
add_filter('wp_handle_upload_prefilter', 'julian2025_sanitize_svg');
