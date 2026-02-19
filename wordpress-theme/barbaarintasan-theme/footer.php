<footer class="bsa-footer">
    <div class="bsa-footer-inner">
        <div class="bsa-footer-brand">
            <?php if (has_custom_logo()) : ?>
                <?php
                $logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                ?>
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="bsa-footer-logo">
            <?php else : ?>
                <img src="<?php echo esc_url(BSA_THEME_URI . '/assets/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>" class="bsa-footer-logo">
            <?php endif; ?>
            <div class="bsa-footer-brand-name"><?php echo esc_html(get_theme_mod('bsa_footer_brand_name', 'Barbaarintasan Academy')); ?></div>
            <p><?php echo esc_html(get_theme_mod('bsa_footer_desc', 'Mac-hadka ugu weyn ee lagu barto tarbiyadda caruurta iyo barbaarinta ubadka Soomaaliyeed.')); ?></p>
        </div>

        <div class="bsa-footer-col">
            <h4>Koorsooyin</h4>
            <ul class="bsa-footer-links">
                <li><a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')); ?>/courses">Dhammaan Koorsoyinka</a></li>
                <li><a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')); ?>/course/caqli-sare">Caqli Sare</a></li>
                <li><a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')); ?>/course/autism">Autisimka</a></li>
                <li><a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')); ?>/course/ilmo-is-dabira">Ilmo Is-Dabira</a></li>
                <li><a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')); ?>/course/aabe-baraarugay">Aabe Baraarugay</a></li>
            </ul>
        </div>

        <div class="bsa-footer-col">
            <h4>Xiriirka</h4>
            <ul class="bsa-footer-links">
                <?php
                $social_links = array(
                    'facebook'  => 'Facebook',
                    'instagram' => 'Instagram',
                    'youtube'   => 'YouTube',
                    'telegram'  => 'Telegram',
                    'tiktok'    => 'TikTok',
                );
                foreach ($social_links as $key => $label) :
                    $url = get_theme_mod("bsa_social_{$key}", '');
                    if ($url) :
                ?>
                    <li><a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><?php echo esc_html($label); ?></a></li>
                <?php
                    endif;
                endforeach;
                ?>
                <li><a href="mailto:<?php echo esc_attr(get_theme_mod('bsa_footer_email', 'info@barbaarintasan.com')); ?>"><?php echo esc_html(get_theme_mod('bsa_footer_email', 'info@barbaarintasan.com')); ?></a></li>
            </ul>
        </div>

        <div class="bsa-footer-col">
            <h4>Bogagga</h4>
            <ul class="bsa-footer-links">
                <?php
                if (has_nav_menu('footer')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                    ));
                } else {
                    bsa_default_footer_menu();
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="bsa-footer-bottom">
        <span>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('bsa_footer_copyright', 'Barbaarintasan Academy. Xuquuqda oo dhan way xifdiysan yihiin.')); ?></span>
        <span><?php echo esc_html(get_theme_mod('bsa_footer_credit', 'Waxaa sameeyay Barbaarintasan Team')); ?></span>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
function bsa_default_footer_menu() {
    echo '<li><a href="' . esc_url(home_url('/')) . '">Bogga Hore</a></li>';
    echo '<li><a href="' . esc_url(home_url('/koorso-iibso/')) . '">Xubin Noqo</a></li>';
    echo '<li><a href="' . esc_url(home_url('/nala-soo-xiriir/')) . '">Nala Soo Xiriir</a></li>';
    echo '<li><a href="' . esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')) . '">App-ka Gal</a></li>';
}
?>
