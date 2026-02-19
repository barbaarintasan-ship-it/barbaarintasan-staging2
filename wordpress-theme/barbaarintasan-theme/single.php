<?php get_header(); ?>

<div class="bsa-page-header">
    <h1><?php the_title(); ?></h1>
    <p><?php echo get_the_date(); ?> &middot; <?php the_author(); ?></p>
</div>

<div class="bsa-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php the_title_attribute(); ?>">
        <?php endif; ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
