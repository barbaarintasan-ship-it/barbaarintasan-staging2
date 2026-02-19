<?php get_header(); ?>

<div class="bsa-page-header">
    <h1>Raadinta: "<?php echo get_search_query(); ?>"</h1>
    <p><?php printf('%d natiijo', $wp_query->found_posts); ?></p>
</div>

<div class="bsa-container" style="padding: 40px 20px;">
    <?php if (have_posts()) : ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bsa-feature-card">
                    <h3 style="margin-bottom: 8px;">
                        <a href="<?php the_permalink(); ?>" style="color: var(--bsa-slate-800);"><?php the_title(); ?></a>
                    </h3>
                    <p style="font-size: 13px; color: var(--bsa-slate-400); margin-bottom: 12px;"><?php echo get_the_date(); ?></p>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p style="text-align: center; color: var(--bsa-slate-500); padding: 60px 0;">Waxba lama helin. Fadlan raadiso erayo kale.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
