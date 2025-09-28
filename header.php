<?php
/**
 * The Header template for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-container">

         <!-- Mobile/Tablet Menu Toggle -->
         <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>

        <!-- Logo (Customizer first, fallback to Site Identity, then site name) -->
        <div class="header-logo">
            <?php
            $custom_logo_src  = get_theme_mod('panda_header_logo');
            $custom_logo_href = get_theme_mod('panda_header_logo_url', home_url('/'));

            if ($custom_logo_src) : ?>
                <a href="<?php echo esc_url($custom_logo_href); ?>">
                    <img src="<?php echo esc_url($custom_logo_src); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </a>
            <?php elseif (get_theme_mod('custom_logo')) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            <?php endif; ?>
        </div>

       

        <!-- WordPress Menu (Centered) -->
        <nav class="header-nav" id="primary-menu" aria-label="Primary">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'nav-menu',
                'container'      => false,
                'menu_id'        => 'menu-primary',
            ));
            ?>
        </nav>

        <!-- Client Portal Button (Dynamic from Customizer) -->
        <div class="header-button">
            <?php
            $portal_text = get_theme_mod('client_portal_text', 'Client Portal');
            $portal_url  = get_theme_mod('client_portal_url', '#');
            if ($portal_text && $portal_url) : ?>
                <a href="<?php echo esc_url($portal_url); ?>" class="client-portal-btn">
                    <?php echo esc_html($portal_text); ?>
                </a>
            <?php endif; ?>
        </div>

    </div>
</header>
