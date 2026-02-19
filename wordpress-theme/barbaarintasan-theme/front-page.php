<?php get_header(); ?>

<?php
$hero_title = get_theme_mod('bsa_hero_title', 'Barbaarintasan Academy');
$hero_subtitle = get_theme_mod('bsa_hero_subtitle', 'Mac-hadka ugu weyn ee lagu barto tarbiyadda caruurta. Shantii sano ee la soo dhaafay kumannaan waalidiin ah ayaa ka faa\'iiday casharadeenna.');
$hero_image = get_theme_mod('bsa_hero_image', '');
$hero_btn_text = get_theme_mod('bsa_hero_btn_text', 'Xubin Dahabi ah Noqo');
$hero_btn_url = get_theme_mod('bsa_hero_btn_url', '/koorso-iibso/');
$hero_btn2_text = get_theme_mod('bsa_hero_btn2_text', 'Koorsoyinka Daawo');
$hero_btn2_url = get_theme_mod('bsa_hero_btn2_url', 'https://appbarbaarintasan.com/courses');
$stat_parents = get_theme_mod('bsa_stat_parents', '5000+');
$stat_hours = get_theme_mod('bsa_stat_hours', '500+');
$stat_courses = get_theme_mod('bsa_stat_courses', '10+');
$app_url = get_theme_mod('bsa_app_url', 'https://appbarbaarintasan.com');
$hero_badge = get_theme_mod('bsa_hero_badge', 'Tarbiyadda Caruurta Soomaaliyeed');
?>

<!-- HERO -->
<section class="bsa-hero">
    <div class="bsa-hero-inner">
        <div class="bsa-hero-text">
            <div class="bsa-hero-badge">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                <?php echo esc_html($hero_badge); ?>
            </div>
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_subtitle); ?></p>
            <div class="bsa-hero-buttons">
                <a href="<?php echo esc_url($hero_btn_url); ?>" class="bsa-btn bsa-btn-hero-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <?php echo esc_html($hero_btn_text); ?>
                </a>
                <a href="<?php echo esc_url($hero_btn2_url); ?>" class="bsa-btn bsa-btn-hero-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                    <?php echo esc_html($hero_btn2_text); ?>
                </a>
            </div>
            <div class="bsa-hero-stats">
                <div class="bsa-hero-stat">
                    <span class="number"><?php echo esc_html($stat_parents); ?></span>
                    <span class="label"><?php echo esc_html(get_theme_mod('bsa_stat_parents_label', 'Waalidiin')); ?></span>
                </div>
                <div class="bsa-hero-stat">
                    <span class="number"><?php echo esc_html($stat_hours); ?></span>
                    <span class="label"><?php echo esc_html(get_theme_mod('bsa_stat_hours_label', 'Saacadood')); ?></span>
                </div>
                <div class="bsa-hero-stat">
                    <span class="number"><?php echo esc_html($stat_courses); ?></span>
                    <span class="label"><?php echo esc_html(get_theme_mod('bsa_stat_courses_label', 'Koorsooyin')); ?></span>
                </div>
            </div>
        </div>
        <div class="bsa-hero-image">
            <?php if ($hero_image) : ?>
                <img src="<?php echo esc_url($hero_image); ?>" alt="Barbaarintasan Academy">
            <?php else : ?>
                <img src="<?php echo esc_url(BSA_THEME_URI . '/assets/images/hero-default.png'); ?>" alt="Barbaarintasan Academy">
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- WHAT WE DO -->
<section class="bsa-section bsa-section-light">
    <div class="bsa-container">
        <div class="bsa-section-header bsa-fade-up">
            <span class="bsa-section-badge bsa-badge-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                <?php echo esc_html(get_theme_mod('bsa_features_badge', 'Waa Maxay BSA?')); ?>
            </span>
            <h2><?php echo esc_html(get_theme_mod('bsa_features_title', 'Muxuu Qabtaa Mac-hadka BarbaarintaSan Academy?')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('bsa_features_subtitle', 'BarbaarintaSan waa barnaamij bilowday 2020, kuna dhisan Diinta Islaamka iyo Aqoonta Casriga ah.')); ?></p>
        </div>
        <div class="bsa-features-grid">
            <?php
            $feature_icons = array('bsa-icon-green', 'bsa-icon-indigo', 'bsa-icon-purple', 'bsa-icon-orange', 'bsa-icon-green', 'bsa-icon-indigo');
            $feature_svgs = array(
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><circle cx="12" cy="12" r="10"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>',
            );
            $feature_title_defaults = array('Koorsooyin Casri ah', 'Bulshada Waalidka', '500+ Saacadood oo Maqal ah', 'Shahaado & Badges', 'App & Web Platform', 'AI Caawiye');
            $feature_desc_defaults = array(
                'Koorsooyin tayo sare leh oo ku saabsan tarbiyadda caruurta, lagu dhisay cilmi-baarista casriga ah iyo diinta Islaamka.',
                'Ku biir bulsho waalidiin ah oo isku taageeraya, khibrad wadaaga, oo wada barta sidii ay u kori lahaayeen caruurtooda.',
                'In ka badan 500 saacadood oo maqal ah oo waalidku wakhti kasta ka baran karaan tarbiyadda caruurta.',
                'Ka qaado shahaado markii aad koorsada dhamaystid, ku faano guushaaqa iyo badges-ka aad ku guulaysatay.',
                'Isticmaal app-ka ama web-ka si aad ugu barato meel kasta oo aad joogto, wakhti kasta oo kuu fudud.',
                'AI helper oo Soomaali ku hadla oo kaa caawiya su\'aalaha tarbiyadda caruurta iyo homework-ka ilmaha.',
            );
            for ($i = 1; $i <= 6; $i++) :
                $f_title = get_theme_mod("bsa_feature_{$i}_title", $feature_title_defaults[$i - 1]);
                $f_desc = get_theme_mod("bsa_feature_{$i}_desc", $feature_desc_defaults[$i - 1]);
            ?>
            <div class="bsa-feature-card bsa-fade-up">
                <div class="bsa-feature-icon <?php echo esc_attr($feature_icons[$i - 1]); ?>">
                    <?php echo $feature_svgs[$i - 1]; ?>
                </div>
                <h3><?php echo esc_html($f_title); ?></h3>
                <p><?php echo esc_html($f_desc); ?></p>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- COURSES - SPECIAL -->
<section class="bsa-section bsa-section-gradient" style="padding-bottom: 30px;">
    <div class="bsa-container">
        <div class="bsa-section-header bsa-fade-up">
            <span class="bsa-section-badge bsa-badge-indigo">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                <?php echo esc_html(get_theme_mod('bsa_special_courses_badge', 'Koorsooyin Gaar ah')); ?>
            </span>
            <h2><?php echo esc_html(get_theme_mod('bsa_special_courses_title', 'Koorsooyin Gaar ah — Special Courses')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('bsa_special_courses_desc', 'Waa barnaamijyo gaar ah oo aan mar kasta si toos ah u qabano. Waana shanta nooc ee hoos ku qoran.')); ?></p>
        </div>
        <div class="bsa-courses-grid bsa-fade-up">
            <?php
            $special_courses = array(
                array('default_title' => 'Ilmahaaga Caqli Sare u Yeel', 'slug' => 'caqli-sare', 'default_tag' => 'Gaar ah'),
                array('default_title' => 'Ilmo Is-Dabira, Iskuna Filan', 'slug' => 'ilmo-is-dabira', 'default_tag' => 'Gaar ah'),
                array('default_title' => 'Aabe Baraarugay', 'slug' => 'aabe-baraarugay', 'default_tag' => 'Free'),
                array('default_title' => 'Ilmaha hadalka ka soo Daaho (Autisimka)', 'slug' => 'autism', 'default_tag' => 'Gaar ah'),
                array('default_title' => 'Xalinta Khilaafka Qoyska', 'slug' => 'xalinta-khilaafka', 'default_tag' => 'Free'),
            );
            foreach ($special_courses as $course) :
                $c_title = get_theme_mod('bsa_course_title_' . $course['slug'], $course['default_title']);
                $c_tag = get_theme_mod('bsa_course_tag_' . $course['slug'], $course['default_tag']);
                $tag_class = $c_tag === 'Free' ? 'bsa-tag-free' : 'bsa-tag-special';
                $course_img = get_theme_mod('bsa_course_img_' . $course['slug'], BSA_THEME_URI . '/assets/images/courses/' . $course['slug'] . '.png');
            ?>
            <a href="<?php echo esc_url($app_url . '/course/' . $course['slug']); ?>" class="bsa-course-card">
                <div class="bsa-course-card-img">
                    <img src="<?php echo esc_url($course_img); ?>" alt="<?php echo esc_attr($c_title); ?>">
                    <span class="bsa-course-tag <?php echo esc_attr($tag_class); ?>"><?php echo esc_html($c_tag); ?></span>
                </div>
                <div class="bsa-course-card-body">
                    <h3><?php echo esc_html($c_title); ?></h3>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- COURSES - GENERAL -->
<section class="bsa-section bsa-section-light" style="padding-top: 30px;">
    <div class="bsa-container">
        <div class="bsa-section-header bsa-fade-up">
            <span class="bsa-section-badge bsa-badge-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                <?php echo esc_html(get_theme_mod('bsa_general_courses_badge', 'Koorsooyin Guud')); ?>
            </span>
            <h2><?php echo esc_html(get_theme_mod('bsa_general_courses_title', 'Koorsooyin Guud ahaan — General Courses')); ?></h2>
            <p><?php echo esc_html(get_theme_mod('bsa_general_courses_desc', 'Si iskaa ah ayaad uga baran kartaa dhamaan koorsoyinkeena guud ee da\'yarta kala duwan.')); ?></p>
        </div>
        <div class="bsa-courses-grid bsa-fade-up">
            <?php
            $general_courses = array(
                array('default_title' => '0-6 Bilood Jir — Koorsada 1aad', 'slug' => '0-6-bilood'),
                array('default_title' => '6-12 Bilood Jir — Koorsada 2aad', 'slug' => '6-12-bilood'),
                array('default_title' => '1-2 Sano Jir — Koorsada 3aad', 'slug' => '1-2-sano'),
                array('default_title' => '2-4 Sano Jir — Koorsada 4aad', 'slug' => '2-4-sano'),
                array('default_title' => '4-7 Sano Jir — Koorsada 5aad', 'slug' => '4-7-sano'),
            );
            foreach ($general_courses as $course) :
                $c_title = get_theme_mod('bsa_course_title_' . $course['slug'], $course['default_title']);
                $course_img = get_theme_mod('bsa_course_img_' . $course['slug'], BSA_THEME_URI . '/assets/images/courses/' . $course['slug'] . '.png');
            ?>
            <a href="<?php echo esc_url($app_url . '/course/' . $course['slug']); ?>" class="bsa-course-card">
                <div class="bsa-course-card-img">
                    <img src="<?php echo esc_url($course_img); ?>" alt="<?php echo esc_attr($c_title); ?>">
                    <span class="bsa-course-tag bsa-tag-general">Guud</span>
                </div>
                <div class="bsa-course-card-body">
                    <h3><?php echo esc_html($c_title); ?></h3>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- IMAGE GALLERY (Scrolling) -->
<section class="bsa-gallery">
    <div class="bsa-section-header bsa-fade-up" style="padding: 0 20px 30px;">
        <span class="bsa-section-badge bsa-badge-orange">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            <?php echo esc_html(get_theme_mod('bsa_gallery_badge', 'Shaqooyinkeena')); ?>
        </span>
        <h2><?php echo esc_html(get_theme_mod('bsa_gallery_title', 'Arag shaqooyinka ay qabatay BSA')); ?></h2>
    </div>
    <div class="bsa-gallery-track" id="bsa-gallery">
        <?php
        $has_customizer_gallery = false;
        for ($gi = 1; $gi <= 10; $gi++) {
            $gimg = get_theme_mod("bsa_gallery_img_{$gi}", '');
            if ($gimg) {
                $has_customizer_gallery = true;
                echo '<div class="bsa-gallery-item"><img src="' . esc_url($gimg) . '" alt="Barbaarintasan Academy" loading="lazy"></div>';
            }
        }

        if (!$has_customizer_gallery) :
            $gallery_args = array(
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'posts_per_page' => 14,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'post_status'    => 'inherit',
                'meta_query'     => array(
                    array(
                        'key'     => '_wp_attachment_metadata',
                        'compare' => 'EXISTS',
                    ),
                ),
            );
            $gallery_query = new WP_Query($gallery_args);
            if ($gallery_query->have_posts()) :
                while ($gallery_query->have_posts()) : $gallery_query->the_post();
                    $img_url = wp_get_attachment_image_url(get_the_ID(), 'bsa-gallery');
                    if ($img_url) :
            ?>
                <div class="bsa-gallery-item">
                    <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
                </div>
            <?php
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;

            if (!$gallery_query->have_posts() || $gallery_query->post_count < 4) :
                $placeholder_images = array(
                    'Generated-Image-October-10-2025-9_39PM.png',
                    'Generated-Image-October-10-2025-9_25PM.png',
                    'Generated-Image-October-10-2025-8_44PM.png',
                    'Generated-Image-October-11-2025-6_22PM.png',
                    'Generated-Image-October-10-2025-8_46PM.png',
                    'wii-weel-2.png',
                    'gabar-weel-dhaqaysa1-1-1024x838.png',
                );
                foreach ($placeholder_images as $img) :
                    $full_url = get_site_url() . '/wp-content/uploads/2025/10/' . $img;
                    $alt_url = get_site_url() . '/wp-content/uploads/2025/11/' . $img;
            ?>
                <div class="bsa-gallery-item">
                    <img src="<?php echo esc_url($full_url); ?>" alt="Barbaarintasan Academy" loading="lazy"
                         onerror="this.src='<?php echo esc_url($alt_url); ?>'">
                </div>
            <?php
                endforeach;
            endif;
        endif;
        ?>
    </div>
</section>

<!-- FAMILY SECTIONS -->
<?php
$family1_image = get_theme_mod('bsa_family1_image', get_site_url() . '/wp-content/uploads/2025/10/Generated-Image-October-10-2025-9_25PM.png');
$family1_title = get_theme_mod('bsa_family1_title', 'Qoys Xasiloon oo Dagan, Sidaad ku Noqon lahayd Baro Maanta!');
$family1_desc = get_theme_mod('bsa_family1_desc', 'Si aad Qoys Xasilaan oo Dagan u noqoto waxaad u baahan tahay aqoon. Waalidka Casharadeena qaatay ayaa fahmay isbadalka Qoyskoodi ku dhacay iyo Sida dhammaan Reerku u XASILAY!');
$family1_btn_text = get_theme_mod('bsa_family1_btn_text', 'Nagu Soo Biir Maanta');
$family1_btn_url = get_theme_mod('bsa_family1_btn_url', $hero_btn_url);

$family2_image = get_theme_mod('bsa_family2_image', get_site_url() . '/wp-content/uploads/2025/11/somali-mother-e1764201507430-1024x531.png');
$family2_title = get_theme_mod('bsa_family2_title', 'Hooyo baraarugsan ilmaheedu uusan ku buuqayn');
$family2_desc = get_theme_mod('bsa_family2_desc', 'Hooyo baraarugsan eeyarkeeda waxbaranaysa Barbaarintasan ayaa soo saari karta. Wakhtigii Baraha Bulshada kaalay, ubadkaaga u hibee oo wax nala baro.');
$family2_btn_text = get_theme_mod('bsa_family2_btn_text', 'Koorsoyinka Eeg');
$family2_btn_url = get_theme_mod('bsa_family2_btn_url', $app_url . '/courses');
?>
<section class="bsa-family-section">
    <div class="bsa-family-grid bsa-fade-up">
        <div class="bsa-family-image">
            <img src="<?php echo esc_url($family1_image); ?>" alt="<?php echo esc_attr($family1_title); ?>" loading="lazy">
        </div>
        <div class="bsa-family-content">
            <h3><?php echo esc_html($family1_title); ?></h3>
            <p><?php echo esc_html($family1_desc); ?></p>
            <a href="<?php echo esc_url($family1_btn_url); ?>" class="bsa-btn-inline">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                <?php echo esc_html($family1_btn_text); ?>
            </a>
        </div>
    </div>
</section>

<section class="bsa-family-section" style="background: var(--bsa-slate-50);">
    <div class="bsa-family-grid reversed bsa-fade-up">
        <div class="bsa-family-image">
            <img src="<?php echo esc_url($family2_image); ?>" alt="<?php echo esc_attr($family2_title); ?>" loading="lazy">
        </div>
        <div class="bsa-family-content">
            <h3><?php echo esc_html($family2_title); ?></h3>
            <p><?php echo esc_html($family2_desc); ?></p>
            <a href="<?php echo esc_url($family2_btn_url); ?>" class="bsa-btn-inline">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
                <?php echo esc_html($family2_btn_text); ?>
            </a>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<?php
$t_badge = get_theme_mod('bsa_testimonials_badge', 'Waalidka ayaa hadlaya');
$t_title = get_theme_mod('bsa_testimonials_title', 'Waxay yidhaahdeen Waalidka casharadeena qaatay');
$t_subtitle = get_theme_mod('bsa_testimonials_subtitle', 'Kaliya hadalkeena ha aaminin, ee bal arag dadka casharadeena qaatay faaladooda.');

$t_name_defaults = array('Fardowsa', 'Fatima Bushra', 'Ayaan Maxamed', 'Waalid BSA');
$t_role_defaults = array('Waalid ka faa\'iiday casharadeena', 'Maanta waxay ka mid tahay macalimiinta', 'Waalidkeen wanaagsan ee nagu xiran', 'Xubin dheeraad ah');
$t_text_defaults = array(
    'Mahadsanid ustaad Muuse. Cajaladihiisa oo dhan waa kuwo macno weyn leh. Waan jeclahay, wax badanna waan ka faa\'iiday. Alle khayr badan ha siiyo.',
    'Mahadsanid ustaad. Wiilkayga hadda Faataxada waa yaqaan, Qul Huwalle labada aayadood ee ugu horreeya wuu yaqaan, Aadaanka wuu yaqaan, cunadiisana wuu cunaa.',
    'Alxamdulillaah wax badan ayaan ka faa\'iiday. 1 isbuuc markii aan qeyliddii iyo dilitaankii ka hadhay, habeenkii wiilkaygu isku kadin jiray ma isku kadinin.',
    'Wax badan groupyo waan ku soo jiray, kan mid la mida waligey ma arkin. Groupyada badanaa left la wada dhahaa. Laakiin kan weli hal left xataa ma arag.',
);
$t_avatar_colors = array(
    'linear-gradient(135deg, var(--bsa-emerald-400), var(--bsa-emerald-600))',
    'linear-gradient(135deg, var(--bsa-indigo-500), var(--bsa-indigo-600))',
    'linear-gradient(135deg, var(--bsa-purple-500), var(--bsa-purple-600))',
    'linear-gradient(135deg, var(--bsa-orange-500), var(--bsa-orange-600))',
);
?>
<section class="bsa-section bsa-section-gradient">
    <div class="bsa-container">
        <div class="bsa-section-header bsa-fade-up">
            <span class="bsa-section-badge bsa-badge-green">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                <?php echo esc_html($t_badge); ?>
            </span>
            <h2><?php echo esc_html($t_title); ?></h2>
            <p><?php echo esc_html($t_subtitle); ?></p>
        </div>
        <div class="bsa-testimonials-grid bsa-fade-up">
            <?php for ($ti = 1; $ti <= 4; $ti++) :
                $tname = get_theme_mod("bsa_testimonial_{$ti}_name", $t_name_defaults[$ti - 1]);
                $trole = get_theme_mod("bsa_testimonial_{$ti}_role", $t_role_defaults[$ti - 1]);
                $ttext = get_theme_mod("bsa_testimonial_{$ti}_text", $t_text_defaults[$ti - 1]);
                $tletter = mb_substr($tname, 0, 1);
            ?>
            <div class="bsa-testimonial-card">
                <div class="bsa-testimonial-stars">
                    <?php for ($si = 0; $si < 5; $si++) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    <?php endfor; ?>
                </div>
                <p class="bsa-testimonial-text"><?php echo esc_html($ttext); ?></p>
                <div class="bsa-testimonial-author">
                    <div class="bsa-testimonial-avatar" style="background: <?php echo $t_avatar_colors[$ti - 1]; ?>;"><?php echo esc_html($tletter); ?></div>
                    <div class="bsa-testimonial-author-info">
                        <h4><?php echo esc_html($tname); ?></h4>
                        <p><?php echo esc_html($trole); ?></p>
                    </div>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<?php
$cta_title = get_theme_mod('bsa_cta_title', 'Nagu Soo Biir Maanta!');
$cta_desc = get_theme_mod('bsa_cta_desc', 'Ku biir kumannaan waalidiin ah oo horey u ka faa\'iiday Barbaarintasan Academy. Ilmahaaga mustaqbalka fiican u dhis.');
$cta_btn_text = get_theme_mod('bsa_cta_btn_text', '');
$cta_btn_url = get_theme_mod('bsa_cta_btn_url', '');
if (empty($cta_btn_text)) $cta_btn_text = $hero_btn_text;
if (empty($cta_btn_url)) $cta_btn_url = $hero_btn_url;
$cta_app_title = get_theme_mod('bsa_cta_app_title', 'App-ka Soo Dagso');
$cta_app_desc = get_theme_mod('bsa_cta_app_desc', 'App-ka Barbaarintasan Academy ka soo dagso taleefankaaga si aad si fudud ugu barato meel kasta oo aad joogto.');
$google_play_url = get_theme_mod('bsa_google_play_url', 'https://play.google.com/store/apps/details?id=com.barbaarintasan.academy');
$apple_store_url = get_theme_mod('bsa_apple_store_url', '#');
?>
<section class="bsa-cta">
    <h2><?php echo esc_html($cta_title); ?></h2>
    <p><?php echo esc_html($cta_desc); ?></p>
    <a href="<?php echo esc_url($cta_btn_url); ?>" class="bsa-btn bsa-btn-hero-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        <?php echo esc_html($cta_btn_text); ?>
    </a>

    <div class="bsa-cta-app">
        <div class="bsa-cta-app-divider">
            <span></span>
            <span class="bsa-cta-app-divider-text"><?php echo esc_html($cta_app_title); ?></span>
            <span></span>
        </div>
        <p class="bsa-cta-app-desc"><?php echo esc_html($cta_app_desc); ?></p>
        <div class="bsa-cta-store-btns">
            <a href="<?php echo esc_url($google_play_url); ?>" target="_blank" rel="noopener" class="bsa-store-btn bsa-store-google">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 0 1-.61-.92V2.734a1 1 0 0 1 .609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.199-1.6l2.302 1.328-2.303 1.328L15.6 12l2.098-1.893zM5.864 2.658L16.8 8.99l-2.302 2.302-8.634-8.634z"/></svg>
                <div>
                    <small><?php echo esc_html(get_theme_mod('bsa_store_google_label', 'Ka soo dagso')); ?></small>
                    <strong>Google Play</strong>
                </div>
            </a>
            <a href="<?php echo esc_url($apple_store_url); ?>" target="_blank" rel="noopener" class="bsa-store-btn bsa-store-apple">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/></svg>
                <div>
                    <small><?php echo esc_html(get_theme_mod('bsa_store_apple_label', 'Ka soo dagso')); ?></small>
                    <strong>App Store</strong>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- WP Content (if any page content exists) -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php if (get_the_content()) : ?>
    <section class="bsa-section">
        <div class="bsa-content">
            <?php the_content(); ?>
        </div>
    </section>
    <?php endif; ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
