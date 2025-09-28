<?php
/**
 * Template Part: Hero Section
 * Place inside: /template-parts/hero-section.php
 */

$bg_color      = get_theme_mod('hero_bg_color', '#FFF8F1');

$pill_text     = get_theme_mod('hero_pill_text', __('Moving Business Forward', 'your-textdomain'));
$pill_url      = get_theme_mod('hero_pill_url', '#');
$pill_icon     = get_theme_mod('hero_pill_icon', '');

$title         = get_theme_mod('hero_title', __('Your Trusted Partner for Global Shipping Solutions', 'your-textdomain'));
$desc          = get_theme_mod('hero_desc', __('Delivery Panda is a logistics start up based in Dubai, we make E-commerce logistics simplified and economical.', 'your-textdomain'));

$placeholder   = get_theme_mod('hero_parcel_placeholder', __('Enter your parcel number', 'your-textdomain'));
$cta_text      = get_theme_mod('hero_cta_text', __('Track my parcel', 'your-textdomain'));
$cta_url       = get_theme_mod('hero_cta_url', '#');

$right_bg      = get_theme_mod('hero_right_bg', '');

$phone_icon    = get_theme_mod('hero_phone_icon', '');
$phone_url     = get_theme_mod('hero_phone_url', 'tel:+0000000000');

$wa_icon       = get_theme_mod('hero_whatsapp_icon', '');
$wa_url        = get_theme_mod('hero_whatsapp_url', 'https://wa.me/0000000000');
?>

<section class="hero" style="--hero-bg: <?php echo esc_attr($bg_color); ?>;">
  <div class="hero__container">
    <div class="hero__left">
      <?php if ($pill_text) : ?>
        <a class="hero__pill" href="<?php echo esc_url($pill_url); ?>">
          <?php if ($pill_icon) : ?>
            <img class="hero__pill-icon" src="<?php echo esc_url($pill_icon); ?>" alt="" loading="lazy" decoding="async">
          <?php endif; ?>
          <span class="hero__pill-text"><?php echo esc_html($pill_text); ?></span>
        </a>
      <?php endif; ?>

      <?php if ($title) : ?>
        <h1 class="hero__title"><?php echo wp_kses_post(nl2br($title)); ?></h1>
      <?php endif; ?>

      <?php if ($desc) : ?>
        <p class="hero__desc"><?php echo wp_kses_post($desc); ?></p>
      <?php endif; ?>

      <form class="hero__track" action="<?php echo esc_url($cta_url); ?>" method="get">
        <label class="screen-reader-text" for="parcel-number"><?php esc_html_e('Parcel number', 'your-textdomain'); ?></label>
        <input id="parcel-number" class="hero__track-input" type="text" name="tracking" placeholder="<?php echo esc_attr($placeholder); ?>">
        <button class="hero__track-btn" type="submit">
          <span><?php echo esc_html($cta_text); ?></span>
          <span class="hero__track-arrow" aria-hidden="true">→</span>
        </button>
      </form>
    </div>

    <div class="hero__right">
      <?php if ($right_bg) : ?>
        <img class="hero__art" src="<?php echo esc_url($right_bg); ?>" alt="" loading="lazy" decoding="async">
      <?php endif; ?>

      <div class="hero__contact">
        <?php if ($phone_icon && $phone_url) : ?>
          <a class="hero__contact-btn" href="<?php echo esc_url($phone_url); ?>">
            <img src="<?php echo esc_url($phone_icon); ?>" alt="<?php esc_attr_e('Call us', 'your-textdomain'); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>

        <?php if ($wa_icon && $wa_url) : ?>
          <a class="hero__contact-btn" href="<?php echo esc_url($wa_url); ?>" target="_blank" rel="noopener">
            <img src="<?php echo esc_url($wa_icon); ?>" alt="<?php esc_attr_e('WhatsApp', 'your-textdomain'); ?>" loading="lazy" decoding="async">
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
