<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package happydiyetiz
 */

if (!function_exists('happydiyetiz_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function happydiyetiz_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('Posted on %s', 'post date', 'happydiyetiz'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('happydiyetiz_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function happydiyetiz_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('by %s', 'post author', 'happydiyetiz'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('happydiyetiz_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function happydiyetiz_entry_footer()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(', ', 'happydiyetiz'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'happydiyetiz') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'happydiyetiz'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'happydiyetiz') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'happydiyetiz'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'happydiyetiz'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('happydiyetiz_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function happydiyetiz_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;


if (!function_exists('happydiyetiz_header_nav_logo')) :
	function happydiyetiz_header_nav_logo()
	{
		?>
		<a href="<?= home_url('/') ?>" class="navbar-brand">
			<?php
			$custom_logo_id = get_theme_mod('custom_logo');
			$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
			if (has_custom_logo()) {
				echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '">';
			} else {
				echo '<h1>' . get_bloginfo('name') . '</h1>';
			}
			?>
		</a>
<?php
	}
endif;

if (!function_exists('happydiyetiz_header_nav_menu')) :
	function happydiyetiz_header_nav_menu()
	{
		if (has_nav_menu('qr-menu')) {
			$menu_items = wp_get_nav_menu_items('qr-menu');
			if ($menu_items) {
				echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
				foreach ($menu_items as $item) {
					echo '<li class="nav-item"><a class="nav-link" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
				}
				echo '</ul>';
			}
		} else {
			/* En basit derecede giriş yapmış kullanıcı kontrolü */
			if (current_user_can('manage_options')) {
				printf( /* translators: %s: Yeni Menü Ekle Linki */
					__('<span class="classynav-info">Primary Menu is null. <a href="%s">Create New Menu </a></span>', 'umag'),
					admin_url() . 'nav-menus.php'
				);
			}
		}
	}
endif;
