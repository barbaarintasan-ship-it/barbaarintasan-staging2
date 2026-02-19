<?php
if (post_password_required()) return;
?>

<div id="comments" class="bsa-comments" style="margin-top: 48px; padding-top: 32px; border-top: 2px solid var(--bsa-slate-200);">
    <?php if (have_comments()) : ?>
        <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 24px; color: var(--bsa-slate-800);">
            <?php comments_number('Faallo ma jirto', '1 Faallo', '%s Faallooyin'); ?>
        </h3>
        <ol style="list-style: none; padding: 0;">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 40,
            ));
            ?>
        </ol>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'         => 'Faallo ka bixi',
        'label_submit'        => 'Dir Faalada',
        'comment_notes_after' => '',
    ));
    ?>
</div>
