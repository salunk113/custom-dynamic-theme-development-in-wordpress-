<?php
/**
 * Easy Track – Template Part
 * Location: template-parts/easytrack-section.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$show = get_theme_mod( 'easytrack_show', true );
if ( ! $show ) { return; }

$main_title = get_theme_mod( 'easytrack_title', __( 'Easy Tracking', 'yourtheme' ) );

$items = [];
for ( $i = 1; $i <= 3; $i++ ) {
    $items[] = [
        'icon'  => wp_get_attachment_image_url( get_theme_mod( "easytrack_item{$i}_icon", 0 ), 'full' ),
        'title' => get_theme_mod( "easytrack_item{$i}_title", sprintf( __( 'Feature %d', 'yourtheme' ), $i ) ),
        'desc'  => get_theme_mod( "easytrack_item{$i}_desc", __( "Let's take this conversation teams were able", 'yourtheme' ) ),
    ];
}
?>

<section class="easytrack" aria-labelledby="easytrack-title">
  <div class="easytrack__inner">
    <h2 id="easytrack-title" class="easytrack__heading">
      <?php echo esc_html( $main_title ); ?>
    </h2>

    <div class="easytrack__grid" role="list">
      <?php foreach ( $items as $index => $item ) : ?>
        <article class="easytrack__card<?php echo $index < 2 ? ' has-divider' : ''; ?>" role="listitem">
          <?php if ( ! empty( $item['icon'] ) ) : ?>
            <img class="easytrack__icon" src="<?php echo esc_url( $item['icon'] ); ?>"
                 alt="" loading="lazy" decoding="async" />
          <?php endif; ?>

          <h3 class="easytrack__title"><?php echo esc_html( $item['title'] ); ?></h3>
          <p class="easytrack__desc"><?php echo esc_html( $item['desc'] ); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
