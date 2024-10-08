<article <?php post_class('col-md-4 col-sm-12') ?> id="product-<?php the_ID() ?>">
    <div class="card">
        <figure class="text-center">
            <?php the_post_thumbnail(); ?>
        </figure>
        <div class="card-body">
            <h5 class="card-title"><?php the_title() ?></h5>
            <div class="price"><?= get_post_meta(get_the_ID(), 'price', true); ?></div>
            <div class="card-text"><?php the_content() ?></div>
        </div>
    </div>
</article>