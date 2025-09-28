<?php
/**
 * Template Part: About Us Section
 * Usage: get_template_part( 'template-parts/about-us' );
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$about_button_text = get_theme_mod( 'about_button_text', __( 'About Us', 'yourtheme' ) );
$about_button_icon = get_theme_mod( 'about_button_icon' ); // attachment ID
$about_title       = get_theme_mod( 'about_title', __( 'Tracking Our Growth Through Key Stats of Our Achievements', 'yourtheme' ) );
$about_desc        = get_theme_mod( 'about_desc', __( 'We offer warehousing and fulfilment service for SMEs...', 'yourtheme' ) );
$about_image_id    = get_theme_mod( 'about_main_image' );
$about_image_url   = $about_image_id ? wp_get_attachment_image_url( $about_image_id, 'large' ) : '';
?>
<section class="aboutus">
  <div class="aboutus__wrap">
    <div class="aboutus__header">
      <a class="aboutus__pill" href="<?php echo esc_url( home_url( '/about' ) ); ?>">
        <?php if ( $about_button_icon ) : ?>
          <img class="aboutus__pill-icon" src="<?php echo esc_url( wp_get_attachment_image_url( $about_button_icon, 'thumbnail' ) ); ?>" alt="">
        <?php endif; ?>
        <span><?php echo esc_html( $about_button_text ); ?></span>
      </a>

      <h2 class="aboutus__title"><?php echo wp_kses_post( nl2br( $about_title ) ); ?></h2>

      <?php if ( $about_desc ) : ?>
        <p class="aboutus__desc"><?php echo wp_kses_post( $about_desc ); ?></p>
      <?php endif; ?>
    </div>

    <div class="aboutus__media">
      <?php if ( $about_image_url ) : ?>
        <img class="aboutus__image" src="<?php echo esc_url( $about_image_url ); ?>" alt="">
      <?php endif; ?>
    </div>

    <div class="aboutus__grid">
      <?php for ( $i = 1; $i <= 8; $i++ ) :
        $img_id   = get_theme_mod( "about_card_{$i}_image" );
        $img_url  = $img_id ? wp_get_attachment_image_url( $img_id, 'medium' ) : '';
        $text     = get_theme_mod( "about_card_{$i}_text", '' );
        $number   = get_theme_mod( "about_card_{$i}_number", '' ); // e.g. "20+ Yrs"
        $link     = get_theme_mod( "about_card_{$i}_link", '' );
      ?>
        <article class="aboutus__card">
          <?php if ( $img_url ) : ?>
            <?php if ( $link ) : ?>
              <a class="aboutus__card-media" href="<?php echo esc_url( $link ); ?>">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="">
              </a>
            <?php else : ?>
              <div class="aboutus__card-media">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="">
              </div>
            <?php endif; ?>
          <?php endif; ?>

          <div class="aboutus__card-body">
            <?php if ( $text ) : ?>
              <div class="aboutus__card-text"><?php echo esc_html( $text ); ?></div>
            <?php endif; ?>

            <?php if ( $number ) : ?>
              <div class="aboutus__card-number"><?php echo esc_html( $number ); ?></div>
            <?php endif; ?>
          </div>
        </article>
      <?php endfor; ?>
    </div>
  </div>
</section>
