<?php
/**
 * Service Section – Template Part
 * Location: template-parts/service-section.php
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$show = get_theme_mod( 'svc_show', true );
if ( ! $show ) { return; }

// Header content
$pill_text = get_theme_mod( 'svc_pill_text', __( 'Our Services', 'yourtheme' ) );
$pill_url  = get_theme_mod( 'svc_pill_url', '#' );

$title     = get_theme_mod( 'svc_title', __( 'Tailored Shipping Solutions, Global Reach', 'yourtheme' ) );
$desc      = get_theme_mod( 'svc_desc', __( 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without', 'yourtheme' ) );

// Decorative images
$panda_id  = get_theme_mod( 'svc_panda_img', 0 );
$panda_src = $panda_id ? wp_get_attachment_image_url( $panda_id, 'full' ) : '';

$square_id  = get_theme_mod( 'svc_square_img', 0 );
$square_src = $square_id ? wp_get_attachment_image_url( $square_id, 'full' ) : '';

// 4 service cards
$cards = [];
for ( $i = 1; $i <= 4; $i++ ) {
    $img_id   = get_theme_mod( "svc_card{$i}_img", 0 );
    $icon_id  = get_theme_mod( "svc_card{$i}_icon", 0 );
    $cards[]  = [
        'title' => get_theme_mod( "svc_card{$i}_title", sprintf( __( 'Service %d', 'yourtheme' ), $i ) ),
        'url'   => get_theme_mod( "svc_card{$i}_url", '#' ),
        'img'   => $img_id ? wp_get_attachment_image_url( $img_id, 'large' ) : '',
        'icon'  => $icon_id ? wp_get_attachment_image_url( $icon_id, 'thumbnail' ) : '',
    ];
}

// Footer button
$cta_text = get_theme_mod( 'svc_cta_text', __( 'View All Services', 'yourtheme' ) );
$cta_url  = get_theme_mod( 'svc_cta_url', '#' );
?>

<section class="svc" aria-labelledby="svc-title">
  <div class="svc__container">

    <!-- decorative art -->
    <?php if ( $square_src ) : ?>
      <img class="svc__deco svc__deco--square" src="<?php echo esc_url( $square_src ); ?>" alt="" loading="lazy" decoding="async" />
    <?php endif; ?>
    <?php if ( $panda_src ) : ?>
      <img class="svc__deco svc__deco--panda" src="<?php echo esc_url( $panda_src ); ?>" alt="" loading="lazy" decoding="async" />
    <?php endif; ?>

    <!-- header -->
    <div class="svc__head">
      <?php if ( $pill_text ) : ?>
        <a class="svc__pill" href="<?php echo esc_url( $pill_url ); ?>">
          <span><?php echo esc_html( $pill_text ); ?></span>
          <span aria-hidden="true" class="svc__pill-arrow">→</span>
        </a>
      <?php endif; ?>

      <h2 id="svc-title" class="svc__title"><?php echo esc_html( $title ); ?></h2>
      <?php if ( $desc ) : ?>
        <p class="svc__desc"><?php echo esc_html( $desc ); ?></p>
      <?php endif; ?>
    </div>

    <!-- cards grid -->
    <div class="svc__grid">
      <?php foreach ( $cards as $c ) : ?>
        <article class="svc__card">
          <?php if ( $c['img'] ) : ?>
            <img class="svc__card-img" src="<?php echo esc_url( $c['img'] ); ?>" alt="" loading="lazy" decoding="async" />
          <?php endif; ?>

          <a class="svc__card-link" href="<?php echo esc_url( $c['url'] ); ?>">
            <span class="svc__card-title"><?php echo esc_html( $c['title'] ); ?></span>
            <?php if ( $c['icon'] ) : ?>
              <img class="svc__card-icon" src="<?php echo esc_url( $c['icon'] ); ?>" alt="" loading="lazy" decoding="async" />
            <?php else : ?>
              <span class="svc__card-icon-fallback" aria-hidden="true">↗</span>
            <?php endif; ?>
          </a>

          <span class="svc__overlay" aria-hidden="true"></span>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- footer cta -->
    <?php if ( $cta_text ) : ?>
      <div class="svc__cta">
        <a class="svc__cta-btn" href="<?php echo esc_url( $cta_url ); ?>">
          <?php echo esc_html( $cta_text ); ?> <span aria-hidden="true">→</span>
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>
