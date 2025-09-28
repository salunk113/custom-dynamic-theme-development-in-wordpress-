<?php
/**
 * Footer Banner (Template Part)
 * File: template-parts/footer-banner.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$fb_title    = get_theme_mod( 'fb_title', __( "Let’s Simplify Your Logistics Journey with Us!", 'yourtheme' ) );
$fb_desc     = get_theme_mod( 'fb_desc',  __( 'Experience smooth logistics management with our innovative services', 'yourtheme' ) );
$fb_btn_text = get_theme_mod( 'fb_btn_text', __( 'Start 14-day Free Trial', 'yourtheme' ) );
$fb_btn_url  = get_theme_mod( 'fb_btn_url', '#' );
$fb_image    = get_theme_mod( 'fb_image', '' ); // image URL
$fb_overlay  = get_theme_mod( 'fb_overlay_on', true ); // gradient overlay toggle
?>

<section class="footer-banner<?php echo $fb_overlay ? ' has-overlay' : ''; ?>">
  <div class="fb-container">
    <div class="fb-content">
      <?php if ( $fb_title ) : ?>
        <h2 class="fb-title"><?php echo esc_html( $fb_title ); ?></h2>
      <?php endif; ?>

      <?php if ( $fb_desc ) : ?>
        <p class="fb-desc"><?php echo esc_html( $fb_desc ); ?></p>
      <?php endif; ?>

      <?php if ( $fb_btn_text && $fb_btn_url ) : ?>
        <a class="fb-btn" href="<?php echo esc_url( $fb_btn_url ); ?>">
          <?php echo esc_html( $fb_btn_text ); ?>
        </a>
      <?php endif; ?>
    </div>

    <?php if ( $fb_image ) : ?>
      <div class="fb-image">
        <!-- footer banner is near the fold; eager is fine. change to lazy if needed -->
        <img src="<?php echo esc_url( $fb_image ); ?>" alt="" loading="eager" fetchpriority="high">
      </div>
    <?php endif; ?>
  </div>
</section>
