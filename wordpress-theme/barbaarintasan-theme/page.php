<?php get_header(); ?>

<div class="bsa-page-header">
    <h1><?php the_title(); ?></h1>
</div>

<div class="bsa-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
