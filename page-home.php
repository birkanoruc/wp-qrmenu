<?php

/**
 * Template Name: Home Page
 * Template Post Type: page
 */
get_header();

echo '<main class="container">';
$terms = get_terms(array(
    'taxonomy' => 'qr-menu-category',
    'hide_empty' => true,
    'meta_key' => 'menu_order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
));

if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $args = array(
            'post_type' => 'qr-menu',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'qr-menu-category',
                    'field' => 'term_id',
                    'terms' => $term->term_id,
                ),
            ),
        );

        $query = new WP_Query($args);

        echo '<div class="row">';
        echo '<h2 class="qr-menu-category mt-4 mb-4 pt-2 pb-2 text-center" id="' . esc_attr($term->slug) . '" >' . esc_html($term->name) . '</h2>';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('template-parts/qr-menu/product-content', 'content');
            }
            wp_reset_postdata();
        }
        echo '</div>';
    }
}

echo '</main>';

get_footer();
