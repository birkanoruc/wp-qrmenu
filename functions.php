<?php

/**
 * happydiyetiz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package happydiyetiz
 */

define('HAPPYDIYETIZ_THEME_VERSION', wp_get_theme()->get('Version'));

if (!defined('_S_VERSION')) {
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
function happydiyetiz_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on happydiyetiz, use a find and replace
		* to change 'happydiyetiz' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('happydiyetiz', get_template_directory() . '/languages');

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

	/**
	 * Add Image Size
	 */
	add_image_size('qr_menu_product', 300, 300, true);


	/**
	 * Register Custom Post Type
	 */
	function custom_post_type_example()
	{
		$labels = array(
			'name'               => esc_html__('QR Menü', 'happydiyetiz'),
			'singular_name'      => esc_html__('Ürün', 'happydiyetiz'),
			'add_new'            => esc_html__('Yeni Ekle', 'happydiyetiz'),
			'add_new_item'       => esc_html__('Yeni ürün ekle', 'happydiyetiz'),
			'edit_item'          => esc_html__('Ürünü düzenle', 'happydiyetiz'),
			'view_item'          => esc_html__('Ürünü görüntüle', 'happydiyetiz'),
			'search_items'       => esc_html__('Ürünleri ara', 'happydiyetiz'),
			'not_found'          => esc_html__('Ürün bulunamadı', 'happydiyetiz'),
			'not_found_in_trash' => esc_html__('Çöp kutusunda ürün bulunamadı!', 'happydiyetiz'),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'has_archive'         => true,
			'menu_position'       => 5,
			'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields'),
		);

		register_post_type('qr-menu', $args);

		// Register Custom Taxonomy for Custom Post Type
		$taxonomy_args = array(
			'hierarchical'      => true,
			'public'                     => true,
			'labels'            => array(
				'name'              => esc_html__('QR Menü Kategorileri', 'happydiyetiz'),
				'singular_name'     => esc_html__('Kategori', 'happydiyetiz'),
			),
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'qr-menu-kategori'),
		);

		register_taxonomy('qr-menu-category', 'qr-menu', $taxonomy_args);
	}

	add_action('init', 'custom_post_type_example');

	/**
	 * Add QR Menu Order Field
	 */
	function add_menu_order_field_to_taxonomy_terms($term)
	{
		$menu_order = get_term_meta($term->term_id, 'menu_order', true);
?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="menu_order"><?php esc_html_e('Sıra', 'happydiyetiz'); ?></label>
			</th>
			<td>
				<input type="number" name="menu_order" id="menu_order" value="<?php if (!empty($menu_order)) {
																					echo esc_attr($menu_order);
																				} else {
																					echo 0;
																				} ?>" />
			</td>
		</tr>
<?php
	}
	add_action('qr-menu-category_edit_form_fields', 'add_menu_order_field_to_taxonomy_terms', 10, 1);

	/**
	 * Save QR Menu Order Field
	 */
	function save_menu_order_field_to_taxonomy_terms($term_id)
	{
		if (isset($_POST['menu_order'])) {
			$menu_order = sanitize_text_field($_POST['menu_order']);
			update_term_meta($term_id, 'menu_order', $menu_order);
		}
	}
	add_action('edited_qr-menu-category', 'save_menu_order_field_to_taxonomy_terms', 10, 1);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'qr-menu' => esc_html__('QR Menü', 'happydiyetiz'),
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
			'happydiyetiz_custom_background_args',
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
add_action('after_setup_theme', 'happydiyetiz_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function happydiyetiz_content_width()
{
	$GLOBALS['content_width'] = apply_filters('happydiyetiz_content_width', 640);
}
add_action('after_setup_theme', 'happydiyetiz_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function happydiyetiz_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'happydiyetiz'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'happydiyetiz'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'happydiyetiz_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function happydiyetiz_scripts()
{
	/**
	 * CSS include
	 */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), HAPPYDIYETIZ_THEME_VERSION);

	wp_enqueue_style('happydiyetiz-style', get_stylesheet_uri(), array(), _S_VERSION);

	wp_style_add_data('happydiyetiz-style', 'rtl', 'replace');

	/**
	 * JS include
	 */
	wp_enqueue_script('bootsrap.bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), HAPPYDIYETIZ_THEME_VERSION, true);

	wp_enqueue_script('happydiyetiz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'happydiyetiz_scripts');

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

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
