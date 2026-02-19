<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">
    <meta name="theme-color" content="#059669">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bsa-header" id="bsa-header">
    <div class="bsa-header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="bsa-logo">
            <?php if (has_custom_logo()) : ?>
                <?php
                $logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                ?>
                <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
            <?php else : ?>
                <img src="<?php echo esc_url(BSA_THEME_URI . '/assets/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
            <?php endif; ?>
            <div>
                <div class="bsa-logo-text">Barbaarintasan</div>
                <div class="bsa-logo-sub">ACADEMY</div>
            </div>
        </a>

        <nav class="bsa-nav">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '<ul class="bsa-nav-list">%3$s</ul>',
                    'depth'          => 1,
                ));
            } else {
                bsa_default_menu();
            }
            ?>
            <a href="<?php echo esc_url(get_theme_mod('bsa_hero_btn_url', '/koorso-iibso/')); ?>" class="bsa-btn-primary">
                <?php echo esc_html(get_theme_mod('bsa_hero_btn_text', 'Xubin Dahabi ah Noqo')); ?>
            </a>
        </nav>

        <button class="bsa-mobile-toggle" id="bsa-mobile-toggle" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</header>

<div class="bsa-mobile-nav" id="bsa-mobile-nav">
    <div class="bsa-mobile-nav-content">
        <div class="bsa-mobile-nav-header">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="bsa-mobile-brand">
                <?php if (has_custom_logo()) :
                    $logo_id = get_theme_mod('custom_logo');
                    $logo_url = wp_get_attachment_image_url($logo_id, 'full');
                ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>">
                <?php else : ?>
                    <img src="<?php echo esc_url(BSA_THEME_URI . '/assets/images/logo.png'); ?>" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
                <span>Barbaarintasan</span>
            </a>
            <button id="bsa-mobile-close" aria-label="Close menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="bsa-mobile-nav-links">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="bsa-mobile-link">
                <span class="bsa-mobile-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </span>
                <span>Hoyga</span>
            </a>
            <a href="<?php echo esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com') . '/courses'); ?>" class="bsa-mobile-link">
                <span class="bsa-mobile-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/></svg>
                </span>
                <span>Koorsooyinkeena</span>
            </a>
            <a href="<?php echo esc_url(home_url('/koorso-iibso/')); ?>" class="bsa-mobile-link">
                <span class="bsa-mobile-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </span>
                <span>Barnaamijyadeena</span>
            </a>
            <a href="<?php echo esc_url(home_url('/nala-soo-xiriir/')); ?>" class="bsa-mobile-link">
                <span class="bsa-mobile-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </span>
                <span>Xogteena</span>
            </a>
        </div>
        <div class="bsa-mobile-nav-cta">
            <a href="<?php echo esc_url(get_theme_mod('bsa_hero_btn_url', '/koorso-iibso/')); ?>" class="bsa-mobile-cta-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php echo esc_html(get_theme_mod('bsa_hero_btn_text', 'Xubin Dahabi ah Noqo')); ?>
            </a>
        </div>
    </div>
</div>

<?php
function bsa_default_menu() {
    echo '<ul class="bsa-nav-list">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Bogga Hore</a></li>';
    echo '<li><a href="' . esc_url(get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com')) . '/courses">Koorsoyinka</a></li>';
    echo '<li><a href="' . esc_url(home_url('/koorso-iibso/')) . '">Qorshayaasha</a></li>';
    echo '<li><a href="' . esc_url(home_url('/nala-soo-xiriir/')) . '">Nala Soo Xiriir</a></li>';
    echo '</ul>';
}

?>
