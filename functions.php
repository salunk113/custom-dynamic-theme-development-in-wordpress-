<?php
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue styles/scripts
 * 
 */
add_action('wp_enqueue_scripts', 'mytheme_enqueue_assets');
function mytheme_enqueue_assets()
{
    // Use theme version for cache-busting of style.css.
    $theme_ver = wp_get_theme()->get('Version');

    // 1) MAIN THEME STYLESHEET (style.css at theme root)
    //    WP looks for this file; use get_stylesheet_uri() for child-theme safety.
    wp_enqueue_style(
        'mytheme-style',
        get_stylesheet_uri(),
        array(),            // no dependencies
        $theme_ver
    );

    // 2) HEADER-ONLY STYLES (assets/css/header.css)
    //    Use filemtime() so the version updates automatically when the file changes.
    $header_css_rel   = 'assets/css/header.css';
    $header_css_path  = get_theme_file_path($header_css_rel);
    $header_css_uri   = get_theme_file_uri($header_css_rel);
    $header_css_ver   = file_exists($header_css_path) ? filemtime($header_css_path) : $theme_ver;

    wp_enqueue_style(
        'mytheme-header',
        $header_css_uri,
        array('mytheme-style'),   // load after main stylesheet
        $header_css_ver
    );

    // JS
    wp_enqueue_script(
        'panda-header-js',
        get_template_directory_uri() . '/header.js',
        array(),           // no jQuery needed
        '1.0',
        true               // load in footer
    );

    // Enqueue Easy Track section stylesheet
    $theme_ver   = wp_get_theme()->get('Version');
    $easy_rel    = 'assets/css/easytrack-section.css';
    $easy_path   = get_theme_file_path($easy_rel);
    $easy_uri    = get_theme_file_uri($easy_rel);
    $easy_ver    = file_exists($easy_path) ? filemtime($easy_path) : $theme_ver;

    wp_enqueue_style(
        'figma-easytrack',     // handle
        $easy_uri,             // URL to file
        [],                    // no dependencies
        $easy_ver              // version (cache-busting)
    );


    // Enqueue Service section stylesheet

    /* Service section stylesheet */
    $svc_rel  = 'assets/css/service-section.css';
    $svc_path = get_theme_file_path($svc_rel);
    $svc_uri  = get_theme_file_uri($svc_rel);
    $svc_ver  = file_exists($svc_path) ? filemtime($svc_path) : $theme_ver;

    wp_enqueue_style(
        'figma-service',
        $svc_uri,
        [],
        $svc_ver
    );

    if (is_front_page()) {
        wp_enqueue_style(
            'hero-section',
            get_stylesheet_directory_uri() . '/assets/css/hero-section.css',
            [],
            wp_get_theme()->get('Version')
        );
    }

    // functions.php
    add_action('wp_enqueue_scripts', function () {
        $rel_path = 'assets/css/about-us.css';

        // If the file doesn't exist, bail early (prevents 404s and helps debug).
        $abs_path = get_theme_file_path($rel_path);
        if (! file_exists($abs_path)) {
            // Optional: error_log for debugging
            error_log('[yourtheme] Missing CSS: ' . $abs_path);
            return;
        }

        wp_enqueue_style(
            'yt-about-us',
            get_theme_file_uri($rel_path),         // works for parent OR child theme
            [],                                      // add deps if needed (e.g. 'yourtheme-style')
            filemtime($abs_path)                   // cache-bust on edit
        );
    }, 20); // slightly later to avoid being dequeued

    // feature section 
    // functions.php
    add_action('wp_enqueue_scripts', function () {
        $rel_path = 'assets/css/feature-section.css';

        // If the file doesn't exist, bail early (avoids 404s)
        $abs_path = get_theme_file_path($rel_path);
        if (! file_exists($abs_path)) {
            // Optional: debug in error log
            error_log('[yourtheme] Missing CSS: ' . $abs_path);
            return;
        }

        wp_enqueue_style(
            'yt-feature-section',
            get_theme_file_uri($rel_path),   // works in parent or child theme
            [],                              // dependencies if needed
            filemtime($abs_path)             // cache-busting version
        );
    }, 20);


    /* ===== Enqueue CSS + JS (cache-busted) ===== */
    add_action('wp_enqueue_scripts', function () {
        // CSS
        $css_rel = 'assets/css/testimonial-section.css';
        $css_abs = get_theme_file_path($css_rel);
        if (file_exists($css_abs)) {
            wp_enqueue_style(
                'yt-testimonial-section',
                get_theme_file_uri($css_rel),
                [],
                filemtime($css_abs)
            );
        } else {
            error_log('[yourtheme] Missing CSS: ' . $css_abs);
        }

        // JS
        $js_rel = 'assets/js/testimonial-section.js';
        $js_abs = get_theme_file_path($js_rel);
        if (file_exists($js_abs)) {
            wp_enqueue_script(
                'yt-testimonial-section',
                get_theme_file_uri($js_rel),
                [],
                filemtime($js_abs),
                true
            );
        } else {
            error_log('[yourtheme] Missing JS: ' . $js_abs);
        }
    }, 20);


    // blog section 
    add_action('wp_enqueue_scripts', function () {
        $rel = 'assets/css/blog-section.css';
        $abs = get_theme_file_path($rel);
        if (file_exists($abs)) {
            wp_enqueue_style(
                'yt-blog-section',
                get_theme_file_uri($rel),
                [],
                filemtime($abs)
            );
        } else {
            error_log('[yourtheme] Missing CSS: ' . $abs);
        }
    }, 20);

    // Enqueue Footer Banner CSS (cache-busted, parent/child safe)
    add_action('wp_enqueue_scripts', function () {
        $rel = 'assets/css/footer-banner.css';
        $abs = get_theme_file_path($rel);
        if (file_exists($abs)) {
            wp_enqueue_style(
                'yt-footer-banner',
                get_theme_file_uri($rel),
                [],
                filemtime($abs)
            );
        } else {
            error_log('[yourtheme] Missing CSS: ' . $abs);
        }
    }, 20);


    // Enqueue footer CSS
    add_action('wp_enqueue_scripts', function () {
        $rel = 'assets/css/footer.css';
        $abs = get_theme_file_path($rel);
        if (file_exists($abs)) {
            wp_enqueue_style(
                'yt-footer',
                get_theme_file_uri($rel),
                [],
                filemtime($abs)
            );
        }
    }, 20);
}
add_action('after_setup_theme', 'mytheme_setup');


// Customizer Settings
function panda_customize_register($wp_customize)
{

    // footer section start

    $wp_customize->add_section('footer_section', [
        'title'       => __('Footer', 'yourtheme'),
        'priority'    => 45,
        'description' => __('Controls for footer branding and links.', 'yourtheme'),
    ]);

    // Logo
    $wp_customize->add_setting('ft_logo', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ft_logo', [
        'label' => __('Footer Logo', 'yourtheme'),
        'section' => 'footer_section',
    ]));

    // Description
    $wp_customize->add_setting('ft_desc', [
        'default' => __('Delivery Panda is a logistics start up based in Dubai, we make E commerce logistics simplified and economical.', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ft_desc', [
        'label' => __('Footer Description', 'yourtheme'),
        'section' => 'footer_section',
        'type' => 'textarea',
    ]);

    // Simplified: company links (4 slots)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("ft_company_links[$i][text]", ['sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_setting("ft_company_links[$i][url]", ['sanitize_callback' => 'esc_url_raw']);
        $wp_customize->add_control("ft_company_link_text_$i", [
            'label' => "Company Link $i Text",
            'section' => 'footer_section',
            'type' => 'text',
            'settings' => "ft_company_links[$i][text]",
        ]);
        $wp_customize->add_control("ft_company_link_url_$i", [
            'label' => "Company Link $i URL",
            'section' => 'footer_section',
            'type' => 'url',
            'settings' => "ft_company_links[$i][url]",
        ]);
    }

    // Similarly repeat for services, resources, socials...
    /* --- Our Services links (4 slots) --- */
    for ($i = 1; $i <= 4; $i++) {
        // text
        $wp_customize->add_setting("ft_services_links[$i][text]", [
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_services_link_text_$i", [
            'label'    => sprintf(__('Services Link %d Text', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'text',
            'settings' => "ft_services_links[$i][text]",
        ]);

        // url
        $wp_customize->add_setting("ft_services_links[$i][url]", [
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_services_link_url_$i", [
            'label'    => sprintf(__('Services Link %d URL', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'url',
            'settings' => "ft_services_links[$i][url]",
        ]);
    }

    /* --- Resources links (4 slots) --- */
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("ft_resources_links[$i][text]", [
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_resources_link_text_$i", [
            'label'    => sprintf(__('Resources Link %d Text', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'text',
            'settings' => "ft_resources_links[$i][text]",
        ]);

        $wp_customize->add_setting("ft_resources_links[$i][url]", [
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_resources_link_url_$i", [
            'label'    => sprintf(__('Resources Link %d URL', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'url',
            'settings' => "ft_resources_links[$i][url]",
        ]);
    }

    /* --- Socials links (4 slots) --- */
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("ft_socials_links[$i][text]", [
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_socials_link_text_$i", [
            'label'    => sprintf(__('Socials Link %d Text (e.g. Facebook)', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'text',
            'settings' => "ft_socials_links[$i][text]",
        ]);

        $wp_customize->add_setting("ft_socials_links[$i][url]", [
            'sanitize_callback' => 'esc_url_raw',
            'default'           => '',
            'type'              => 'theme_mod',
        ]);
        $wp_customize->add_control("ft_socials_link_url_$i", [
            'label'    => sprintf(__('Socials Link %d URL', 'yourtheme'), $i),
            'section'  => 'footer_section',
            'type'     => 'url',
            'settings' => "ft_socials_links[$i][url]",
        ]);
    }


    // Copyright
    $wp_customize->add_setting('ft_copy', [
        'default' => '© Copyright Delivery Panda 2024 - Designed by Hoztok Technologies',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ft_copy', [
        'label' => __('Footer Copyright', 'yourtheme'),
        'section' => 'footer_section',
        'type' => 'text',
    ]);

    // footer section end

    //start - footer image banner section 

    $wp_customize->add_section('footer_banner', [
        'title'       => __('Footer Banner', 'yourtheme'),
        'priority'    => 40,
        'description' => __('Controls for the call-to-action banner above the footer.', 'yourtheme'),
    ]);

    // Title
    $wp_customize->add_setting('fb_title', [
        'default'           => __("Let’s Simplify Your Logistics Journey with Us!", 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('fb_title', [
        'label'   => __('Title', 'yourtheme'),
        'section' => 'footer_banner',
        'type'    => 'text',
    ]);

    // Description
    $wp_customize->add_setting('fb_desc', [
        'default'           => __('Experience smooth logistics management with our innovative services', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('fb_desc', [
        'label'   => __('Description', 'yourtheme'),
        'section' => 'footer_banner',
        'type'    => 'textarea',
    ]);

    // Button text
    $wp_customize->add_setting('fb_btn_text', [
        'default'           => __('Start 14-day Free Trial', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('fb_btn_text', [
        'label'   => __('Button Text', 'yourtheme'),
        'section' => 'footer_banner',
        'type'    => 'text',
    ]);

    // Button URL
    $wp_customize->add_setting('fb_btn_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('fb_btn_url', [
        'label'   => __('Button URL', 'yourtheme'),
        'section' => 'footer_banner',
        'type'    => 'url',
    ]);

    // Right-side image
    $wp_customize->add_setting('fb_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fb_image', [
        'label'    => __('Banner Image', 'yourtheme'),
        'section'  => 'footer_banner',
        'settings' => 'fb_image',
    ]));

    // Overlay toggle
    $wp_customize->add_setting('fb_overlay_on', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    $wp_customize->add_control('fb_overlay_on', [
        'label'   => __('Enable dark-to-transparent overlay', 'yourtheme'),
        'section' => 'footer_banner',
        'type'    => 'checkbox',
    ]);

    // end - footer image banner section 

    // blog section start 

    // helper: get posts list for selects
    $choices = [0 => __('— Select a post —', 'yourtheme')];
    $posts   = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'numberposts'    => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'suppress_filters' => false,
    ]);
    foreach ($posts as $p) {
        $choices[$p->ID] = esc_html(wp_trim_words($p->post_title ?: __('(no title)', 'yourtheme'), 12, '…'));
    }

    $wp_customize->add_section('blog_section', [
        'title'       => __('Blog Section', 'yourtheme'),
        'priority'    => 38,
        'description' => __('Controls the Blogs strip on the home page.', 'yourtheme'),
    ]);

    // Badge
    $wp_customize->add_setting('bs_badge_text', [
        'default'           => __('Blogs', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('bs_badge_text', [
        'label' => __('Badge Text', 'yourtheme'),
        'section' => 'blog_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('bs_badge_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bs_badge_icon', [
        'label'    => __('Badge Icon (PNG/SVG 16–24px)', 'yourtheme'),
        'section'  => 'blog_section',
        'settings' => 'bs_badge_icon',
    ]));

    // Title
    $wp_customize->add_setting('bs_section_title', [
        'default'           => __('See Our Latest Blogs!', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('bs_section_title', [
        'label' => __('Section Title', 'yourtheme'),
        'section' => 'blog_section',
        'type' => 'text',
    ]);

    // View all button
    $wp_customize->add_setting('bs_viewall_text', [
        'default'           => __('View All', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('bs_viewall_text', [
        'label' => __('"View All" Text', 'yourtheme'),
        'section' => 'blog_section',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('bs_viewall_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'bs_viewall_icon', [
        'label'    => __('"View All" Icon (PNG/SVG)', 'yourtheme'),
        'section'  => 'blog_section',
        'settings' => 'bs_viewall_icon',
    ]));

    $wp_customize->add_setting('bs_viewall_url', [
        'default'           => get_post_type_archive_link('post'),
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('bs_viewall_url', [
        'label' => __('"View All" URL', 'yourtheme'),
        'section' => 'blog_section',
        'type' => 'url',
    ]);

    // Read more text
    $wp_customize->add_setting('bs_readmore_text', [
        'default'           => __('READ MORE', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('bs_readmore_text', [
        'label' => __('"Read more" Text', 'yourtheme'),
        'section' => 'blog_section',
        'type' => 'text',
    ]);

    // Four selectable post slots
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("bs_post_{$i}", [
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control("bs_post_{$i}", [
            /* translators: %d: slot number */
            'label'    => sprintf(__('Select Post %d', 'yourtheme'), $i),
            'section'  => 'blog_section',
            'type'     => 'select',
            'choices'  => $choices,
        ]);
    }

    // blog section end 



    // Section
    $wp_customize->add_section('panda_header_section', array(
        'title'    => __('Header Settings', 'panda'),
        'priority' => 30,
    ));

    /* ---------- Logo (image + link URL) ---------- */
    // Logo image
    $wp_customize->add_setting('panda_header_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'panda_header_logo',
            array(
                'label'    => __('Header Logo Image', 'panda'),
                'section'  => 'panda_header_section',
                'settings' => 'panda_header_logo',
            )
        )
    );

    // Logo click URL
    $wp_customize->add_setting('panda_header_logo_url', array(
        'default'           => home_url('/'),
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('panda_header_logo_url', array(
        'label'       => __('Header Logo Link URL', 'panda'),
        'description' => __('Where the logo should link to.', 'panda'),
        'section'     => 'panda_header_section',
        'type'        => 'url',
    ));

    /* ---------- Client Portal button ---------- */
    $wp_customize->add_setting('client_portal_text', array(
        'default'           => 'Client Portal',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('client_portal_text', array(
        'label'   => __('Client Portal Button Text', 'panda'),
        'section' => 'panda_header_section',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('client_portal_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('client_portal_url', array(
        'label'   => __('Client Portal Button URL', 'panda'),
        'section' => 'panda_header_section',
        'type'    => 'url',
    ));


    // Easy Track Section

    // Section
    $wp_customize->add_section('easytrack_section', [
        'title'       => __('Easy Track Section', 'yourtheme'),
        'priority'    => 35,
        'description' => __('Controls for the Easy Tracking strip.', 'yourtheme'),
    ]);

    // Toggle
    $wp_customize->add_setting('easytrack_show', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    $wp_customize->add_control('easytrack_show', [
        'type'    => 'checkbox',
        'section' => 'easytrack_section',
        'label'   => __('Show section', 'yourtheme'),
    ]);

    // Main title
    $wp_customize->add_setting('easytrack_title', [
        'default'           => __('Easy Tracking', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('easytrack_title', [
        'type'    => 'text',
        'section' => 'easytrack_section',
        'label'   => __('Main Title', 'yourtheme'),
    ]);

    // Live preview for title (optional)
    if ($wp_customize->selective_refresh) {
        $wp_customize->selective_refresh->add_partial('easytrack_title', [
            'selector'        => '#easytrack-title',
            'render_callback' => function () {
                return esc_html(get_theme_mod('easytrack_title', __('Easy Tracking', 'yourtheme')));
            },
        ]);
    }

    // Repeatable-like: 3 items (icon, title, desc)
    for ($i = 1; $i <= 3; $i++) {
        // Icon
        $wp_customize->add_setting("easytrack_item{$i}_icon", [
            'default'           => 0,
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            "easytrack_item{$i}_icon",
            [
                'section'     => 'easytrack_section',
                'label'       => sprintf(__('Item %d Icon', 'yourtheme'), $i),
                'mime_type'   => 'image',
                'description' => __('Upload a square icon (SVG, PNG, or WEBP recommended).', 'yourtheme'),
            ]
        ));

        // Title
        $wp_customize->add_setting("easytrack_item{$i}_title", [
            'default'           => sprintf(__('Feature %d', 'yourtheme'), $i),
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("easytrack_item{$i}_title", [
            'type'    => 'text',
            'section' => 'easytrack_section',
            'label'   => sprintf(__('Item %d Title', 'yourtheme'), $i),
        ]);

        // Description
        $wp_customize->add_setting("easytrack_item{$i}_desc", [
            'default'           => __("Let's take this conversation teams were able", 'yourtheme'),
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("easytrack_item{$i}_desc", [
            'type'        => 'textarea',
            'section'     => 'easytrack_section',
            'label'       => sprintf(__('Item %d Description', 'yourtheme'), $i),
            'input_attrs' => ['rows' => 3],
        ]);
    }

    // Service Section

    // Panel (optional) – keeps things tidy if you add more sections later.
    $wp_customize->add_panel('theme_home_panel', [
        'title'       => __('Homepage', 'your-textdomain'),
        'priority'    => 10,
    ]);

    // Section
    $wp_customize->add_section('hero_section', [
        'title'    => __('Hero Section', 'your-textdomain'),
        'priority' => 10,
        'panel'    => 'theme_home_panel',
    ]);

    // Background color
    $wp_customize->add_setting('hero_bg_color', [
        'default'           => '#FFF8F1',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'hero_bg_color',
        [
            'label'   => __('Background Color', 'your-textdomain'),
            'section' => 'hero_section',
        ]
    ));

    // Left pill (button)
    $wp_customize->add_setting('hero_pill_text', [
        'default'           => __('Moving Business Forward', 'your-textdomain'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_pill_text', [
        'label'   => __('Pill: Text', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('hero_pill_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_pill_url', [
        'label'   => __('Pill: URL', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('hero_pill_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_pill_icon',
        [
            'label'   => __('Pill: Icon Image', 'your-textdomain'),
            'section' => 'hero_section',
        ]
    ));

    // Title + description
    $wp_customize->add_setting('hero_title', [
        'default'           => __('Your Trusted Partner for Global Shipping Solutions', 'your-textdomain'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('hero_title', [
        'label'   => __('Hero Title', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('hero_desc', [
        'default'           => __('Delivery Panda is a logistics start up based in Dubai, we make E-commerce logistics simplified and economical.', 'your-textdomain'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('hero_desc', [
        'label'   => __('Hero Description', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ]);

    // Parcel input placeholder
    $wp_customize->add_setting('hero_parcel_placeholder', [
        'default'           => __('Enter your parcel number', 'your-textdomain'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_parcel_placeholder', [
        'label'   => __('Parcel Placeholder', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);

    // CTA button
    $wp_customize->add_setting('hero_cta_text', [
        'default'           => __('Track my parcel', 'your-textdomain'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_cta_text', [
        'label'   => __('CTA Button Text', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('hero_cta_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_cta_url', [
        'label'   => __('CTA Button URL', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);

    // Right side background image (hero art)
    $wp_customize->add_setting('hero_right_bg', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_right_bg',
        [
            'label'   => __('Right Side Background Image', 'your-textdomain'),
            'section' => 'hero_section',
        ]
    ));

    // Phone + WhatsApp icons + URLs
    $wp_customize->add_setting('hero_phone_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_phone_icon',
        [
            'label'   => __('Phone Icon Image', 'your-textdomain'),
            'section' => 'hero_section',
        ]
    ));

    $wp_customize->add_setting('hero_phone_url', [
        'default'           => 'tel:+0000000000',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_phone_url', [
        'label'   => __('Phone URL (tel:...)', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('hero_whatsapp_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hero_whatsapp_icon',
        [
            'label'   => __('WhatsApp Icon Image', 'your-textdomain'),
            'section' => 'hero_section',
        ]
    ));

    $wp_customize->add_setting('hero_whatsapp_url', [
        'default'           => 'https://wa.me/0000000000',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_whatsapp_url', [
        'label'   => __('WhatsApp URL', 'your-textdomain'),
        'section' => 'hero_section',
        'type'    => 'url',
    ]);

    // about us section

    // Panel (optional) to group
    if (method_exists($wp_customize, 'add_panel')) {
        $wp_customize->add_panel('panel_about', array(
            'title'       => __('About Us Section', 'yourtheme'),
            'priority'    => 40,
        ));
    }

    // Section: Header
    $wp_customize->add_section('about_header', array(
        'title'    => __('Header & Hero', 'yourtheme'),
        'panel'    => 'panel_about',
        'priority' => 10,
    ));

    // Button text
    $wp_customize->add_setting('about_button_text', array(
        'default'           => __('About Us', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    $wp_customize->add_control('about_button_text', array(
        'label'   => __('Button Text', 'yourtheme'),
        'section' => 'about_header',
        'type'    => 'text',
    ));

    // Button icon (image)
    $wp_customize->add_setting('about_button_icon', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        'about_button_icon',
        array(
            'label'    => __('Button Icon (image)', 'yourtheme'),
            'section'  => 'about_header',
            'mime_type' => 'image',
        )
    ));

    // Title
    $wp_customize->add_setting('about_title', array(
        'default'           => __('Tracking Our Growth Through Key Stats of Our Achievements', 'yourtheme'),
        'sanitize_callback' => function ($v) {
            return wp_kses_post($v);
        },
    ));
    $wp_customize->add_control('about_title', array(
        'label'   => __('Title (supports line breaks)', 'yourtheme'),
        'section' => 'about_header',
        'type'    => 'textarea',
    ));

    // Description
    $wp_customize->add_setting('about_desc', array(
        'default'           => '',
        'sanitize_callback' => function ($v) {
            return wp_kses_post($v);
        },
    ));
    $wp_customize->add_control('about_desc', array(
        'label'   => __('Description', 'yourtheme'),
        'section' => 'about_header',
        'type'    => 'textarea',
    ));

    // Main image
    $wp_customize->add_setting('about_main_image', array(
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        'about_main_image',
        array(
            'label'    => __('Right Side Image', 'yourtheme'),
            'section'  => 'about_header',
            'mime_type' => 'image',
        )
    ));

    // Section: Stats Grid (2 rows × 4 = 8 cards)
    $wp_customize->add_section('about_cards', array(
        'title'    => __('Stats Grid (8 squares)', 'yourtheme'),
        'panel'    => 'panel_about',
        'priority' => 20,
        'description' => __('Each card: Image, label text, number/years, and an optional URL.', 'yourtheme'),
    ));

    for ($i = 1; $i <= 8; $i++) {
        // Image
        $wp_customize->add_setting("about_card_{$i}_image", array(
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            "about_card_{$i}_image",
            array(
                'label'    => sprintf(__('Card %d Image', 'yourtheme'), $i),
                'section'  => 'about_cards',
                'mime_type' => 'image',
            )
        ));

        // Label text
        $wp_customize->add_setting("about_card_{$i}_text", array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("about_card_{$i}_text", array(
            'label'   => sprintf(__('Card %d Text (e.g., "Innovative Logistics")', 'yourtheme'), $i),
            'section' => 'about_cards',
            'type'    => 'text',
        ));

        // Number / Years text
        $wp_customize->add_setting("about_card_{$i}_number", array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("about_card_{$i}_number", array(
            'label'   => sprintf(__('Card %d Number (e.g., "20+ Yrs")', 'yourtheme'), $i),
            'section' => 'about_cards',
            'type'    => 'text',
        ));

        // URL
        $wp_customize->add_setting("about_card_{$i}_link", array(
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("about_card_{$i}_link", array(
            'label'   => sprintf(__('Card %d Link (optional)', 'yourtheme'), $i),
            'section' => 'about_cards',
            'type'    => 'url',
        ));
    }
}
add_action('customize_register', 'panda_customize_register');

function mytheme_setup()
{
    add_theme_support('title-tag');
    // add_theme_support('custom-logo');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'panda'),
    ));
}
// functions.php


// --- Service Section: Customizer ---
function figma_customize_service_section(WP_Customize_Manager $c)
{

    $c->add_section('svc_section', [
        'title'       => __('Service Section', 'yourtheme'),
        'priority'    => 36,
        'description' => __('Controls the Services block on the homepage.', 'yourtheme'),
    ]);

    // Show/Hide
    $c->add_setting('svc_show', [
        'default'           => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    $c->add_control('svc_show', [
        'type'    => 'checkbox',
        'section' => 'svc_section',
        'label'   => __('Show section', 'yourtheme'),
    ]);

    // Pill button
    $c->add_setting('svc_pill_text', [
        'default'           => __('Our Services', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $c->add_control('svc_pill_text', [
        'section' => 'svc_section',
        'label'   => __('Pill Button Text', 'yourtheme'),
        'type'    => 'text',
    ]);

    $c->add_setting('svc_pill_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $c->add_control('svc_pill_url', [
        'section' => 'svc_section',
        'label'   => __('Pill Button URL', 'yourtheme'),
        'type'    => 'url',
    ]);

    // Title & description
    $c->add_setting('svc_title', [
        'default'           => __('Tailored Shipping Solutions, Global Reach', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $c->add_control('svc_title', [
        'section' => 'svc_section',
        'label'   => __('Title', 'yourtheme'),
        'type'    => 'text',
    ]);

    $c->add_setting('svc_desc', [
        'default'           => __('Lorem ipsum…', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $c->add_control('svc_desc', [
        'section' => 'svc_section',
        'label'   => __('Description', 'yourtheme'),
        'type'    => 'textarea',
    ]);

    // Decorative images
    $c->add_setting('svc_panda_img', ['default' => 0, 'sanitize_callback' => 'absint']);
    $c->add_control(new WP_Customize_Media_Control($c, 'svc_panda_img', [
        'section'   => 'svc_section',
        'label'     => __('Panda Decorative Image (right)', 'yourtheme'),
        'mime_type' => 'image',
    ]));

    $c->add_setting('svc_square_img', ['default' => 0, 'sanitize_callback' => 'absint']);
    $c->add_control(new WP_Customize_Media_Control($c, 'svc_square_img', [
        'section'   => 'svc_section',
        'label'     => __('Square Decorative Image', 'yourtheme'),
        'mime_type' => 'image',
    ]));

    // 4 service cards
    for ($i = 1; $i <= 4; $i++) {
        $c->add_setting("svc_card{$i}_img", ['default' => 0, 'sanitize_callback' => 'absint']);
        $c->add_control(new WP_Customize_Media_Control($c, "svc_card{$i}_img", [
            'section'   => 'svc_section',
            'label'     => sprintf(__('Card %d – Background Image', 'yourtheme'), $i),
            'mime_type' => 'image',
        ]));

        $c->add_setting("svc_card{$i}_title", ['default' => sprintf(__('Service %d', 'yourtheme'), $i), 'sanitize_callback' => 'sanitize_text_field']);
        $c->add_control("svc_card{$i}_title", [
            'section' => 'svc_section',
            'label'   => sprintf(__('Card %d – Title', 'yourtheme'), $i),
            'type'    => 'text',
        ]);

        $c->add_setting("svc_card{$i}_icon", ['default' => 0, 'sanitize_callback' => 'absint']);
        $c->add_control(new WP_Customize_Media_Control($c, "svc_card{$i}_icon", [
            'section'   => 'svc_section',
            'label'     => sprintf(__('Card %d – Icon (round)', 'yourtheme'), $i),
            'mime_type' => 'image',
        ]));

        $c->add_setting("svc_card{$i}_url", ['default' => '#', 'sanitize_callback' => 'esc_url_raw']);
        $c->add_control("svc_card{$i}_url", [
            'section' => 'svc_section',
            'label'   => sprintf(__('Card %d – Link URL', 'yourtheme'), $i),
            'type'    => 'url',
        ]);
    }

    // Footer CTA
    $c->add_setting('svc_cta_text', [
        'default'           => __('View All Services', 'yourtheme'),
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $c->add_control('svc_cta_text', [
        'section' => 'svc_section',
        'label'   => __('Footer Button Text', 'yourtheme'),
        'type'    => 'text',
    ]);

    $c->add_setting('svc_cta_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $c->add_control('svc_cta_url', [
        'section' => 'svc_section',
        'label'   => __('Footer Button URL', 'yourtheme'),
        'type'    => 'url',
    ]);

    // hero section  stylesheet


}
add_action('customize_register', 'figma_customize_service_section');


// featured section start


/**
 * Sanitizers
 */
function yourtheme_fs_sanitize_text($val)
{
    return wp_kses_post($val);
}
function yourtheme_fs_sanitize_url($val)
{
    return esc_url_raw($val);
}

/**
 * Customizer: Feature Section
 */
add_action('customize_register', function ($wp_customize) {

    // Section
    $wp_customize->add_section('feature_section', [
        'title'       => __('Feature Section', 'yourtheme'),
        'priority'    => 35,
        'description' => __('Controls for the features row shown on the front page.', 'yourtheme'),
    ]);

    // Badge text
    $wp_customize->add_setting('fs_badge_text', [
        'default'           => __('Our Features', 'yourtheme'),
        'sanitize_callback' => 'yourtheme_fs_sanitize_text',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('fs_badge_text', [
        'label'   => __('Badge Text', 'yourtheme'),
        'section' => 'feature_section',
        'type'    => 'text',
    ]);

    // Badge icon (image URL)
    $wp_customize->add_setting('fs_badge_icon', [
        'default'           => '',
        'sanitize_callback' => 'yourtheme_fs_sanitize_url',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fs_badge_icon', [
        'label'       => __('Badge Icon (16px–24px PNG/SVG)', 'yourtheme'),
        'section'     => 'feature_section',
        'settings'    => 'fs_badge_icon',
    ]));

    // Section Title
    $wp_customize->add_setting('fs_section_title', [
        'default'           => __('Why Panda', 'yourtheme'),
        'sanitize_callback' => 'yourtheme_fs_sanitize_text',
    ]);
    $wp_customize->add_control('fs_section_title', [
        'label'   => __('Section Title', 'yourtheme'),
        'section' => 'feature_section',
        'type'    => 'text',
    ]);

    // 4 Feature Cards (grouped, simple approach – no third-party repeater)
    for ($i = 1; $i <= 4; $i++) {

        // Title
        $wp_customize->add_setting("fs_card{$i}_title", [
            'default'           => (1 === $i) ? __('Simplified One Click', 'yourtheme') : (2 === $i ? __('Economical Rates', 'yourtheme') : (3 === $i ? __('Lastmile Logistics', 'yourtheme') : __('Cash On Delivery', 'yourtheme'))),
            'sanitize_callback' => 'yourtheme_fs_sanitize_text',
        ]);
        $wp_customize->add_control("fs_card{$i}_title", [
            /* translators: %d: card number */
            'label'   => sprintf(__('Card %d — Title', 'yourtheme'), $i),
            'section' => 'feature_section',
            'type'    => 'text',
        ]);

        // Description
        $default_desc = [
            1 => __('Our experienced team delivers tailored logistics solutions for safe, timely shipments.', 'yourtheme'),
            2 => __('Our advanced tracking systems provide real-time updates, ensuring complete visibility.', 'yourtheme'),
            3 => __('Enjoy clear and transparent pricing without hidden fees, maximizing your budget for logistics.', 'yourtheme'),
            4 => __('Our dedicated support team is available around the clock to assist you with any questions.', 'yourtheme'),
        ];

        $wp_customize->add_setting("fs_card{$i}_desc", [
            'default'           => $default_desc[$i],
            'sanitize_callback' => 'yourtheme_fs_sanitize_text',
        ]);
        $wp_customize->add_control("fs_card{$i}_desc", [
            /* translators: %d: card number */
            'label'   => sprintf(__('Card %d — Description', 'yourtheme'), $i),
            'section' => 'feature_section',
            'type'    => 'textarea',
        ]);

        // Left Icon
        $wp_customize->add_setting("fs_card{$i}_left_icon", [
            'default'           => '',
            'sanitize_callback' => 'yourtheme_fs_sanitize_url',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "fs_card{$i}_left_icon", [
            /* translators: %d: card number */
            'label'       => sprintf(__('Card %d — Left Icon (PNG/SVG)', 'yourtheme'), $i),
            'section'     => 'feature_section',
            'settings'    => "fs_card{$i}_left_icon",
        ]));

        // Right Icon
        $wp_customize->add_setting("fs_card{$i}_right_icon", [
            'default'           => '',
            'sanitize_callback' => 'yourtheme_fs_sanitize_url',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "fs_card{$i}_right_icon", [
            /* translators: %d: card number */
            'label'       => sprintf(__('Card %d — Right Icon (PNG/SVG, e.g. arrow)', 'yourtheme'), $i),
            'section'     => 'feature_section',
            'settings'    => "fs_card{$i}_right_icon",
        ]));
    }
});


// testimonial section 

/* ===== Register Testimonial CPT ===== */
add_action('init', function () {
    register_post_type('testimonial', [
        'labels' => [
            'name'          => __('Testimonials', 'yourtheme'),
            'singular_name' => __('Testimonial', 'yourtheme'),
            'add_new_item'  => __('Add New Testimonial', 'yourtheme'),
            'edit_item'     => __('Edit Testimonial', 'yourtheme'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'editor', 'thumbnail'],
        'menu_icon'    => 'dashicons-testimonial',
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'testimonials'],
    ]);
});

/* ===== Custom Fields (Meta Box) ===== */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'yourtheme'),
        function ($post) {
            $client_name = get_post_meta($post->ID, '_client_name', true);
            $client_role = get_post_meta($post->ID, '_client_role', true);
            $client_link = get_post_meta($post->ID, '_client_link', true);
            $rating      = (int) get_post_meta($post->ID, '_rating', true);

            wp_nonce_field('save_testimonial_details', 'testimonial_nonce'); ?>
        <p><label><?php _e('Client Name', 'yourtheme'); ?></label>
            <input type="text" class="widefat" name="client_name" value="<?php echo esc_attr($client_name); ?>">
        </p>
        <p><label><?php _e('Client Role / Post', 'yourtheme'); ?></label>
            <input type="text" class="widefat" name="client_role" value="<?php echo esc_attr($client_role); ?>">
        </p>
        <p><label><?php _e('"Let\'s Connect" URL', 'yourtheme'); ?></label>
            <input type="url" class="widefat" name="client_link" value="<?php echo esc_attr($client_link); ?>" placeholder="https://...">
        </p>
        <p><label><?php _e('Rating (1–5)', 'yourtheme'); ?></label>
            <input type="number" name="rating" min="0" max="5" step="1" value="<?php echo esc_attr($rating ?: 5); ?>">
        </p>
<?php },
        'testimonial',
        'normal',
        'default'
    );
});

add_action('save_post_testimonial', function ($post_id) {
    if (! isset($_POST['testimonial_nonce']) || ! wp_verify_nonce($_POST['testimonial_nonce'], 'save_testimonial_details')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_client_name', sanitize_text_field($_POST['client_name'] ?? ''));
    update_post_meta($post_id, '_client_role', sanitize_text_field($_POST['client_role'] ?? ''));
    update_post_meta($post_id, '_client_link', esc_url_raw($_POST['client_link'] ?? ''));
    $rating = isset($_POST['rating']) ? (int) $_POST['rating'] : 0;
    update_post_meta($post_id, '_rating', max(0, min(5, $rating)));
});

/* ===== Shortcode: [testimonials per_page="3"] (paginated list) ===== */
add_shortcode('testimonials', function ($atts) {
    $atts = shortcode_atts(['per_page' => 3], $atts, 'testimonials');
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $q = new WP_Query([
        'post_type'      => 'testimonial',
        'posts_per_page' => (int) $atts['per_page'],
        'paged'          => $paged,
        'post_status'    => 'publish',
    ]);

    ob_start();
    if ($q->have_posts()) :
        echo '<div class="ts-sc-list">';
        while ($q->have_posts()) : $q->the_post();
            $name   = get_post_meta(get_the_ID(), '_client_name', true) ?: get_the_title();
            $role   = get_post_meta(get_the_ID(), '_client_role', true);
            $rating = (int) get_post_meta(get_the_ID(), '_rating', true);
            $rating = max(0, min(5, $rating));
            echo '<div class="ts-sc-item">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('thumbnail', ['class' => 'ts-sc-avatar']);
            }
            echo '<div class="ts-sc-content">' . wpautop(wp_kses_post(get_the_content())) . '</div>';
            echo '<div class="ts-sc-name"><strong>' . esc_html($name) . '</strong>' . ($role ? ' — ' . esc_html($role) : '') . '</div>';
            echo '<div class="ts-sc-stars">';
            for ($i = 1; $i <= 5; $i++) {
                echo '<span class="ts-star' . ($i <= $rating ? ' is-on' : '') . '">★</span>';
            }
            echo '</div>';
            echo '</div>';
        endwhile;
        echo '</div>';

        $big = 999999999;
        echo '<div class="ts-sc-pagination">';
        echo paginate_links([
            'base'    => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'  => '?paged=%#%',
            'current' => max(1, $paged),
            'total'   => $q->max_num_pages,
        ]);
        echo '</div>';
    else :
        echo '<p>' . esc_html__('No testimonials found.', 'yourtheme') . '</p>';
    endif;
    wp_reset_postdata();

    return ob_get_clean();
});

/* ===== Customizer: badge + title + description ===== */
add_action('customize_register', function ($wp_customize) {

    $wp_customize->add_section('testimonial_section', [
        'title'       => __('Testimonial Section', 'yourtheme'),
        'priority'    => 36,
        'description' => __('Controls for the testimonial slider heading/badge.', 'yourtheme'),
    ]);

    $wp_customize->add_setting('ts_badge_text', [
        'default'           => __('Testimonials', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ts_badge_text', [
        'label'   => __('Badge Text', 'yourtheme'),
        'section' => 'testimonial_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ts_badge_icon', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ts_badge_icon', [
        'label'    => __('Badge Icon (PNG/SVG 16–24px)', 'yourtheme'),
        'section'  => 'testimonial_section',
        'settings' => 'ts_badge_icon',
    ]));

    $wp_customize->add_setting('ts_section_title', [
        'default'           => __('Our Valued Customers Share Their Stories', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ts_section_title', [
        'label'   => __('Section Title', 'yourtheme'),
        'section' => 'testimonial_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ts_section_desc', [
        'default'           => __('Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without', 'yourtheme'),
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ts_section_desc', [
        'label'   => __('Section Description', 'yourtheme'),
        'section' => 'testimonial_section',
        'type'    => 'textarea',
    ]);
});
