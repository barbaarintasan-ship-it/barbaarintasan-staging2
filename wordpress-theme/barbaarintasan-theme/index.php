<?php get_header(); ?>

<div class="bsa-page-header">
    <h1><?php echo is_home() ? 'Maqaalada' : wp_title('', false); ?></h1>
</div>

<div class="bsa-container" style="padding: 40px 20px;">
    <?php if (have_posts()) : ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bsa-feature-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium_large')); ?>" alt="<?php the_title_attribute(); ?>" style="border-radius: 16px 16px 0 0; width: 100%; height: 200px; object-fit: cover; margin: -32px -32px 20px; width: calc(100% + 64px);">
                        </a>
                    <?php endif; ?>
                    <h3 style="margin-bottom: 8px;">
                        <a href="<?php the_permalink(); ?>" style="color: var(--bsa-slate-800);"><?php the_title(); ?></a>
                    </h3>
                    <p style="font-size: 13px; color: var(--bsa-slate-400); margin-bottom: 12px;"><?php echo get_the_date(); ?></p>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 6px; margin-top: 16px; font-weight: 700; color: var(--bsa-emerald-600); font-size: 14px;">
                        Akhri dhammaan
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <?php the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => '&larr;',
                'next_text' => '&rarr;',
            )); ?>
        </div>
    <?php else : ?>
        <p style="text-align: center; color: var(--bsa-slate-500); padding: 60px 0;">Maqaallo lama helin.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
