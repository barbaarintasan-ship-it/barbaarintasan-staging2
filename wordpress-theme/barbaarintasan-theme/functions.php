<?php
/**
 * Barbaarintasan Academy Theme Functions
 *
 * @package Barbaarintasan
 * @version 1.0.0
 */

if (!defined('ABSPATH')) exit;

define('BSA_THEME_VERSION', '1.2.0');
define('BSA_THEME_DIR', get_template_directory());
define('BSA_THEME_URI', get_template_directory_uri());

function bsa_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('woocommerce');

    register_nav_menus(array(
        'primary'   => 'Main Menu',
        'footer'    => 'Footer Menu',
    ));

    add_image_size('bsa-course-thumb', 400, 400, true);
    add_image_size('bsa-hero', 800, 600, true);
    add_image_size('bsa-gallery', 400, 400, true);
}
add_action('after_setup_theme', 'bsa_theme_setup');

function bsa_enqueue_assets() {
    wp_enqueue_style('bsa-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap', array(), null);
    wp_enqueue_style('bsa-theme-style', get_stylesheet_uri(), array('bsa-google-fonts'), BSA_THEME_VERSION);
    wp_enqueue_script('bsa-theme-script', BSA_THEME_URI . '/assets/js/main.js', array(), BSA_THEME_VERSION, true);
}
add_action('wp_enqueue_scripts', 'bsa_enqueue_assets');

function bsa_register_widgets() {
    register_sidebar(array(
        'name'          => 'Footer Widget 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    register_sidebar(array(
        'name'          => 'Footer Widget 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'bsa_register_widgets');

function bsa_customize_register($wp_customize) {
    $wp_customize->add_section('bsa_hero_section', array(
        'title'    => 'Hero Section',
        'priority' => 30,
    ));

    $wp_customize->add_setting('bsa_hero_title', array(
        'default'           => 'Barbaarintasan Academy',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_hero_title', array(
        'label'   => 'Hero Title',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_hero_subtitle', array(
        'default'           => 'Mac-hadka ugu weyn ee lagu barto tarbiyadda caruurta',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_hero_subtitle', array(
        'label'   => 'Hero Subtitle',
        'section' => 'bsa_hero_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_hero_image', array(
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bsa_hero_image', array(
        'label'   => 'Hero Image',
        'section' => 'bsa_hero_section',
    )));

    $wp_customize->add_setting('bsa_hero_btn_text', array(
        'default'           => 'Xubin Dahabi ah Noqo',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_hero_btn_text', array(
        'label'   => 'Hero Button Text',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_hero_btn_url', array(
        'default'           => '/koorso-iibso/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_hero_btn_url', array(
        'label'   => 'Hero Button URL',
        'section' => 'bsa_hero_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('bsa_hero_btn2_text', array(
        'default'           => 'Koorsoyinka Daawo',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_hero_btn2_text', array(
        'label'   => 'Hero Button 2 Text',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_hero_btn2_url', array(
        'default'           => 'https://appbarbaarintasan.com/courses',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_hero_btn2_url', array(
        'label'   => 'Hero Button 2 URL',
        'section' => 'bsa_hero_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('bsa_stat_parents', array(
        'default'           => '5000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_parents', array(
        'label'   => 'Stats - Parents Count',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_stat_parents_label', array(
        'default'           => 'Waalidiin',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_parents_label', array(
        'label'   => 'Stats - Parents Label',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_stat_hours', array(
        'default'           => '500+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_hours', array(
        'label'   => 'Stats - Hours of Content',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_stat_hours_label', array(
        'default'           => 'Saacadood',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_hours_label', array(
        'label'   => 'Stats - Hours Label',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_stat_courses', array(
        'default'           => '10+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_courses', array(
        'label'   => 'Stats - Courses Count',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_stat_courses_label', array(
        'default'           => 'Koorsooyin',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_stat_courses_label', array(
        'label'   => 'Stats - Courses Label',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    $wp_customize->add_section('bsa_app_section', array(
        'title'    => 'App Link Settings',
        'priority' => 35,
    ));

    $wp_customize->add_setting('bsa_app_url', array(
        'default'           => 'https://appbarbaarintasan.com',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_app_url', array(
        'label'   => 'App URL',
        'section' => 'bsa_app_section',
        'type'    => 'url',
    ));

    $wp_customize->add_section('bsa_social_section', array(
        'title'    => 'Social Media Links',
        'priority' => 40,
    ));

    $social_platforms = array('facebook', 'instagram', 'youtube', 'telegram', 'tiktok');
    foreach ($social_platforms as $platform) {
        $wp_customize->add_setting("bsa_social_{$platform}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("bsa_social_{$platform}", array(
            'label'   => ucfirst($platform) . ' URL',
            'section' => 'bsa_social_section',
            'type'    => 'url',
        ));
    }

    // ==================== HERO BADGE ====================
    $wp_customize->add_setting('bsa_hero_badge', array(
        'default'           => 'Tarbiyadda Caruurta Soomaaliyeed',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_hero_badge', array(
        'label'   => 'Hero Badge Text',
        'section' => 'bsa_hero_section',
        'type'    => 'text',
    ));

    // ==================== WHAT WE DO SECTION ====================
    $wp_customize->add_section('bsa_features_section', array(
        'title'    => 'Waa Maxay BSA — Features',
        'priority' => 36,
    ));

    $wp_customize->add_setting('bsa_features_badge', array(
        'default'           => 'Waa Maxay BSA?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_features_badge', array(
        'label'   => 'Section Badge',
        'section' => 'bsa_features_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_features_title', array(
        'default'           => 'Muxuu Qabtaa Mac-hadka BarbaarintaSan Academy?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_features_title', array(
        'label'   => 'Section Title',
        'section' => 'bsa_features_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_features_subtitle', array(
        'default'           => 'BarbaarintaSan waa barnaamij bilowday 2020, kuna dhisan Diinta Islaamka iyo Aqoonta Casriga ah.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_features_subtitle', array(
        'label'   => 'Section Subtitle',
        'section' => 'bsa_features_section',
        'type'    => 'textarea',
    ));

    $feature_defaults = array(
        array('Koorsooyin Casri ah', 'Koorsooyin tayo sare leh oo ku saabsan tarbiyadda caruurta, lagu dhisay cilmi-baarista casriga ah iyo diinta Islaamka.'),
        array('Bulshada Waalidka', 'Ku biir bulsho waalidiin ah oo isku taageeraya, khibrad wadaaga, oo wada barta sidii ay u kori lahaayeen caruurtooda.'),
        array('500+ Saacadood oo Maqal ah', 'In ka badan 500 saacadood oo maqal ah oo waalidku wakhti kasta ka baran karaan tarbiyadda caruurta.'),
        array('Shahaado & Badges', 'Ka qaado shahaado markii aad koorsada dhamaystid, ku faano guushaaqa iyo badges-ka aad ku guulaysatay.'),
        array('App & Web Platform', 'Isticmaal app-ka ama web-ka si aad ugu barato meel kasta oo aad joogto, wakhti kasta oo kuu fudud.'),
        array('AI Caawiye', 'AI helper oo Soomaali ku hadla oo kaa caawiya su\'aalaha tarbiyadda caruurta iyo homework-ka ilmaha.'),
    );
    for ($i = 1; $i <= 6; $i++) {
        $def = $feature_defaults[$i - 1];
        $wp_customize->add_setting("bsa_feature_{$i}_title", array(
            'default'           => $def[0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_feature_{$i}_title", array(
            'label'   => "Feature {$i} — Title",
            'section' => 'bsa_features_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_feature_{$i}_desc", array(
            'default'           => $def[1],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("bsa_feature_{$i}_desc", array(
            'label'   => "Feature {$i} — Description",
            'section' => 'bsa_features_section',
            'type'    => 'textarea',
        ));
    }

    // ==================== COURSES SECTION HEADERS ====================
    $wp_customize->add_section('bsa_courses_text_section', array(
        'title'    => 'Koorsooyin — Qoraalka',
        'priority' => 45,
    ));

    $wp_customize->add_setting('bsa_special_courses_badge', array(
        'default'           => 'Koorsooyin Gaar ah',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_special_courses_badge', array(
        'label'   => 'Special Courses Badge',
        'section' => 'bsa_courses_text_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_special_courses_title', array(
        'default'           => 'Koorsooyin Gaar ah — Special Courses',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_special_courses_title', array(
        'label'   => 'Special Courses Title',
        'section' => 'bsa_courses_text_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_special_courses_desc', array(
        'default'           => 'Waa barnaamijyo gaar ah oo aan mar kasta si toos ah u qabano. Waana shanta nooc ee hoos ku qoran.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_special_courses_desc', array(
        'label'   => 'Special Courses Description',
        'section' => 'bsa_courses_text_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_general_courses_badge', array(
        'default'           => 'Koorsooyin Guud',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_general_courses_badge', array(
        'label'   => 'General Courses Badge',
        'section' => 'bsa_courses_text_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_general_courses_title', array(
        'default'           => 'Koorsooyin Guud ahaan — General Courses',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_general_courses_title', array(
        'label'   => 'General Courses Title',
        'section' => 'bsa_courses_text_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_general_courses_desc', array(
        'default'           => 'Si iskaa ah ayaad uga baran kartaa dhamaan koorsoyinkeena guud ee da\'yarta kala duwan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_general_courses_desc', array(
        'label'   => 'General Courses Description',
        'section' => 'bsa_courses_text_section',
        'type'    => 'textarea',
    ));

    // ==================== GALLERY SECTION ====================
    $wp_customize->add_section('bsa_gallery_section', array(
        'title'    => 'Shaqooyinka — Gallery',
        'priority' => 55,
    ));

    $wp_customize->add_setting('bsa_gallery_badge', array(
        'default'           => 'Shaqooyinkeena',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_gallery_badge', array(
        'label'   => 'Gallery Badge',
        'section' => 'bsa_gallery_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_gallery_title', array(
        'default'           => 'Arag shaqooyinka ay qabatay BSA',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_gallery_title', array(
        'label'   => 'Gallery Title',
        'section' => 'bsa_gallery_section',
        'type'    => 'text',
    ));

    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("bsa_gallery_img_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "bsa_gallery_img_{$i}", array(
            'label'   => "Gallery Image {$i}",
            'section' => 'bsa_gallery_section',
        )));
    }

    // ==================== FAMILY SECTIONS ====================
    $wp_customize->add_section('bsa_family_section', array(
        'title'    => 'Qoyska — Family Sections',
        'priority' => 60,
    ));

    $wp_customize->add_setting('bsa_family1_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bsa_family1_image', array(
        'label'   => 'Family Section 1 — Image',
        'section' => 'bsa_family_section',
    )));

    $wp_customize->add_setting('bsa_family1_title', array(
        'default'           => 'Qoys Xasiloon oo Dagan, Sidaad ku Noqon lahayd Baro Maanta!',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_family1_title', array(
        'label'   => 'Family Section 1 — Title',
        'section' => 'bsa_family_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_family1_desc', array(
        'default'           => 'Si aad Qoys Xasilaan oo Dagan u noqoto waxaad u baahan tahay aqoon. Waalidka Casharadeena qaatay ayaa fahmay isbadalka Qoyskoodi ku dhacay iyo Sida dhammaan Reerku u XASILAY!',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_family1_desc', array(
        'label'   => 'Family Section 1 — Description',
        'section' => 'bsa_family_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_family1_btn_text', array(
        'default'           => 'Nagu Soo Biir Maanta',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_family1_btn_text', array(
        'label'   => 'Family Section 1 — Button Text',
        'section' => 'bsa_family_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_family1_btn_url', array(
        'default'           => '/koorso-iibso/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_family1_btn_url', array(
        'label'   => 'Family Section 1 — Button URL',
        'section' => 'bsa_family_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('bsa_family2_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bsa_family2_image', array(
        'label'   => 'Family Section 2 — Image',
        'section' => 'bsa_family_section',
    )));

    $wp_customize->add_setting('bsa_family2_title', array(
        'default'           => 'Hooyo baraarugsan ilmaheedu uusan ku buuqayn',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_family2_title', array(
        'label'   => 'Family Section 2 — Title',
        'section' => 'bsa_family_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_family2_desc', array(
        'default'           => 'Hooyo baraarugsan eeyarkeeda waxbaranaysa Barbaarintasan ayaa soo saari karta. Wakhtigii Baraha Bulshada kaalay, ubadkaaga u hibee oo wax nala baro.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_family2_desc', array(
        'label'   => 'Family Section 2 — Description',
        'section' => 'bsa_family_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_family2_btn_text', array(
        'default'           => 'Koorsoyinka Eeg',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_family2_btn_text', array(
        'label'   => 'Family Section 2 — Button Text',
        'section' => 'bsa_family_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_family2_btn_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_family2_btn_url', array(
        'label'   => 'Family Section 2 — Button URL',
        'section' => 'bsa_family_section',
        'type'    => 'url',
    ));

    // ==================== TESTIMONIALS ====================
    $wp_customize->add_section('bsa_testimonials_section', array(
        'title'    => 'Waalidka — Testimonials',
        'priority' => 65,
    ));

    $wp_customize->add_setting('bsa_testimonials_badge', array(
        'default'           => 'Waalidka ayaa hadlaya',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_testimonials_badge', array(
        'label'   => 'Testimonials Badge',
        'section' => 'bsa_testimonials_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_testimonials_title', array(
        'default'           => 'Waxay yidhaahdeen Waalidka casharadeena qaatay',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_testimonials_title', array(
        'label'   => 'Testimonials Title',
        'section' => 'bsa_testimonials_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_testimonials_subtitle', array(
        'default'           => 'Kaliya hadalkeena ha aaminin, ee bal arag dadka casharadeena qaatay faaladooda.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_testimonials_subtitle', array(
        'label'   => 'Testimonials Subtitle',
        'section' => 'bsa_testimonials_section',
        'type'    => 'textarea',
    ));

    $testimonial_defaults = array(
        array('Fardowsa', 'Waalid ka faa\'iiday casharadeena', 'Mahadsanid ustaad Muuse. Cajaladihiisa oo dhan waa kuwo macno weyn leh. Waan jeclahay, wax badanna waan ka faa\'iiday. Alle khayr badan ha siiyo.'),
        array('Fatima Bushra', 'Maanta waxay ka mid tahay macalimiinta', 'Mahadsanid ustaad. Wiilkayga hadda Faataxada waa yaqaan, Qul Huwalle labada aayadood ee ugu horreeya wuu yaqaan, Aadaanka wuu yaqaan, cunadiisana wuu cunaa.'),
        array('Ayaan Maxamed', 'Waalidkeen wanaagsan ee nagu xiran', 'Alxamdulillaah wax badan ayaan ka faa\'iiday. 1 isbuuc markii aan qeyliddii iyo dilitaankii ka hadhay, habeenkii wiilkaygu isku kadin jiray ma isku kadinin.'),
        array('Waalid BSA', 'Xubin dheeraad ah', 'Wax badan groupyo waan ku soo jiray, kan mid la mida waligey ma arkin. Groupyada badanaa left la wada dhahaa. Laakiin kan weli hal left xataa ma arag.'),
    );
    for ($i = 1; $i <= 4; $i++) {
        $def = $testimonial_defaults[$i - 1];
        $wp_customize->add_setting("bsa_testimonial_{$i}_name", array(
            'default'           => $def[0],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_testimonial_{$i}_name", array(
            'label'   => "Testimonial {$i} — Name",
            'section' => 'bsa_testimonials_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_testimonial_{$i}_role", array(
            'default'           => $def[1],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_testimonial_{$i}_role", array(
            'label'   => "Testimonial {$i} — Role",
            'section' => 'bsa_testimonials_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_testimonial_{$i}_text", array(
            'default'           => $def[2],
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("bsa_testimonial_{$i}_text", array(
            'label'   => "Testimonial {$i} — Text",
            'section' => 'bsa_testimonials_section',
            'type'    => 'textarea',
        ));
    }

    // ==================== CTA SECTION ====================
    $wp_customize->add_section('bsa_cta_section', array(
        'title'    => 'CTA — Call to Action',
        'priority' => 70,
    ));

    $wp_customize->add_setting('bsa_cta_title', array(
        'default'           => 'Nagu Soo Biir Maanta!',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_cta_title', array(
        'label'   => 'CTA Title',
        'section' => 'bsa_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_cta_desc', array(
        'default'           => 'Ku biir kumannaan waalidiin ah oo horey u ka faa\'iiday Barbaarintasan Academy. Ilmahaaga mustaqbalka fiican u dhis.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_cta_desc', array(
        'label'   => 'CTA Description',
        'section' => 'bsa_cta_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_cta_btn_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_cta_btn_text', array(
        'label'   => 'CTA Button Text (empty = use Hero button text)',
        'section' => 'bsa_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_cta_btn_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_cta_btn_url', array(
        'label'   => 'CTA Button URL (empty = use Hero button URL)',
        'section' => 'bsa_cta_section',
        'type'    => 'url',
    ));

    // ==================== APP DOWNLOAD (CTA) ====================
    $wp_customize->add_setting('bsa_cta_app_title', array(
        'default'           => 'App-ka Soo Dagso',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_cta_app_title', array(
        'label'   => 'App Download — Title',
        'section' => 'bsa_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_cta_app_desc', array(
        'default'           => 'App-ka Barbaarintasan Academy ka soo dagso taleefankaaga si aad si fudud ugu barato meel kasta oo aad joogto.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_cta_app_desc', array(
        'label'   => 'App Download — Description',
        'section' => 'bsa_cta_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_google_play_url', array(
        'default'           => 'https://play.google.com/store/apps/details?id=com.barbaarintasan.academy',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_google_play_url', array(
        'label'   => 'Google Play Store URL',
        'section' => 'bsa_cta_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('bsa_apple_store_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('bsa_apple_store_url', array(
        'label'   => 'Apple App Store URL',
        'section' => 'bsa_cta_section',
        'type'    => 'url',
    ));

    $wp_customize->add_setting('bsa_store_google_label', array(
        'default'           => 'Ka soo dagso',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_store_google_label', array(
        'label'   => 'Google Play — Label',
        'section' => 'bsa_cta_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_store_apple_label', array(
        'default'           => 'Ka soo dagso',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_store_apple_label', array(
        'label'   => 'App Store — Label',
        'section' => 'bsa_cta_section',
        'type'    => 'text',
    ));

    // ==================== FOOTER ====================
    $wp_customize->add_section('bsa_footer_section', array(
        'title'    => 'Footer — Cagta Hoose',
        'priority' => 75,
    ));

    $wp_customize->add_setting('bsa_footer_brand_name', array(
        'default'           => 'Barbaarintasan Academy',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_footer_brand_name', array(
        'label'   => 'Footer Brand Name',
        'section' => 'bsa_footer_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_footer_desc', array(
        'default'           => 'Mac-hadka ugu weyn ee lagu barto tarbiyadda caruurta iyo barbaarinta ubadka Soomaaliyeed.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('bsa_footer_desc', array(
        'label'   => 'Footer Description',
        'section' => 'bsa_footer_section',
        'type'    => 'textarea',
    ));

    $wp_customize->add_setting('bsa_footer_email', array(
        'default'           => 'info@barbaarintasan.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('bsa_footer_email', array(
        'label'   => 'Footer Email',
        'section' => 'bsa_footer_section',
        'type'    => 'email',
    ));

    $wp_customize->add_setting('bsa_footer_copyright', array(
        'default'           => 'Barbaarintasan Academy. Xuquuqda oo dhan way xifdiysan yihiin.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_footer_copyright', array(
        'label'   => 'Footer Copyright Text',
        'section' => 'bsa_footer_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('bsa_footer_credit', array(
        'default'           => 'Waxaa sameeyay Barbaarintasan Team',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bsa_footer_credit', array(
        'label'   => 'Footer Credit Text',
        'section' => 'bsa_footer_section',
        'type'    => 'text',
    ));

    // ==================== SPECIAL COURSES ====================
    $wp_customize->add_section('bsa_special_courses_section', array(
        'title'    => 'Koorsooyin Gaar ah — Sawirrada & Qoraalka',
        'priority' => 50,
    ));

    $special_courses = array(
        array('slug' => 'caqli-sare', 'title' => 'Ilmahaaga Caqli Sare u Yeel', 'tag' => 'Gaar ah'),
        array('slug' => 'ilmo-is-dabira', 'title' => 'Ilmo Is-Dabira, Iskuna Filan', 'tag' => 'Gaar ah'),
        array('slug' => 'aabe-baraarugay', 'title' => 'Aabe Baraarugay', 'tag' => 'Free'),
        array('slug' => 'autism', 'title' => 'Ilmaha hadalka ka soo Daaho (Autisimka)', 'tag' => 'Gaar ah'),
        array('slug' => 'xalinta-khilaafka', 'title' => 'Xalinta Khilaafka Qoyska', 'tag' => 'Free'),
    );
    foreach ($special_courses as $course) {
        $slug = $course['slug'];
        $wp_customize->add_setting("bsa_course_title_{$slug}", array(
            'default'           => $course['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_course_title_{$slug}", array(
            'label'   => $course['title'] . ' — Title',
            'section' => 'bsa_special_courses_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_course_tag_{$slug}", array(
            'default'           => $course['tag'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_course_tag_{$slug}", array(
            'label'   => $course['title'] . ' — Tag',
            'section' => 'bsa_special_courses_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_course_img_{$slug}", array(
            'default'           => BSA_THEME_URI . '/assets/images/courses/' . $slug . '.png',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "bsa_course_img_{$slug}", array(
            'label'   => $course['title'] . ' — Image',
            'section' => 'bsa_special_courses_section',
        )));
    }

    // ==================== GENERAL COURSES ====================
    $wp_customize->add_section('bsa_general_courses_section', array(
        'title'    => 'Koorsooyin Guud — Sawirrada & Qoraalka',
        'priority' => 51,
    ));

    $general_courses = array(
        array('slug' => '0-6-bilood', 'title' => '0-6 Bilood Jir — Koorsada 1aad'),
        array('slug' => '6-12-bilood', 'title' => '6-12 Bilood Jir — Koorsada 2aad'),
        array('slug' => '1-2-sano', 'title' => '1-2 Sano Jir — Koorsada 3aad'),
        array('slug' => '2-4-sano', 'title' => '2-4 Sano Jir — Koorsada 4aad'),
        array('slug' => '4-7-sano', 'title' => '4-7 Sano Jir — Koorsada 5aad'),
    );
    foreach ($general_courses as $course) {
        $slug = $course['slug'];
        $wp_customize->add_setting("bsa_course_title_{$slug}", array(
            'default'           => $course['title'],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("bsa_course_title_{$slug}", array(
            'label'   => $course['title'] . ' — Title',
            'section' => 'bsa_general_courses_section',
            'type'    => 'text',
        ));

        $wp_customize->add_setting("bsa_course_img_{$slug}", array(
            'default'           => BSA_THEME_URI . '/assets/images/courses/' . $slug . '.png',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "bsa_course_img_{$slug}", array(
            'label'   => $course['title'] . ' — Image',
            'section' => 'bsa_general_courses_section',
        )));
    }
}
add_action('customize_register', 'bsa_customize_register');

function bsa_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'bsa_excerpt_length');

function bsa_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'bsa_excerpt_more');

function bsa_body_classes($classes) {
    $classes[] = 'bsa-theme';
    if (is_front_page()) {
        $classes[] = 'bsa-front-page';
    }
    return $classes;
}
add_filter('body_class', 'bsa_body_classes');

function bsa_add_editor_styles() {
    add_editor_style('style.css');
}
add_action('admin_init', 'bsa_add_editor_styles');

function bsa_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'bsa_disable_emojis');
