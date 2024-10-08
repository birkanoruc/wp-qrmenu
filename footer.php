<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package happydiyetiz
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info content text-center mt-2 bg-dark text-light pt-2 pb-2">
		<?php
		/* translators: 1: Theme name, 2: Theme author. */
		printf(esc_html__('Tema: %1$s by %2$s.', 'happydiyetiz'), 'happymoodcake', '<a href="https://birkanoruc.com.tr/">Birkanoruc.com.tr</a>');
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>