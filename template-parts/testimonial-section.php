<?php
/**
 * Testimonial Section (Template Part)
 * File: template-parts/testimonial-section.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$badge_text   = get_theme_mod( 'ts_badge_text', __( 'Testimonials', 'yourtheme' ) );
$badge_icon   = get_theme_mod( 'ts_badge_icon', '' ); // image URL (optional)
$sec_title    = get_theme_mod( 'ts_section_title', __( 'Our Valued Customers Share Their Stories', 'yourtheme' ) );
$sec_desc     = get_theme_mod( 'ts_section_desc', __( 'Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without', 'yourtheme' ) );

// Pull some testimonials (used for the slider on the front page)
$q = new WP_Query( [
	'post_type'      => 'testimonial',
	'posts_per_page' => 9,
	'post_status'    => 'publish',
] );
?>
<section class="ts-section" aria-labelledby="ts-title">
	<div class="ts-container">

		<?php if ( $badge_text ) : ?>
			<div class="ts-badge">
				<?php if ( $badge_icon ) : ?>
					<img class="ts-badge__icon" src="<?php echo esc_url( $badge_icon ); ?>" alt="" loading="lazy" />
				<?php endif; ?>
				<span><?php echo esc_html( $badge_text ); ?></span>
			</div>
		<?php endif; ?>

		<h2 id="ts-title" class="ts-title"><?php echo esc_html( $sec_title ); ?></h2>
		<?php if ( $sec_desc ) : ?>
			<p class="ts-desc"><?php echo esc_html( $sec_desc ); ?></p>
		<?php endif; ?>

		<?php if ( $q->have_posts() ) : ?>
			<div class="ts-slider" data-interval="2000">
				<div class="ts-track">
					<?php while ( $q->have_posts() ) : $q->the_post();
						$client_name  = get_post_meta( get_the_ID(), '_client_name', true );
						$client_role  = get_post_meta( get_the_ID(), '_client_role', true );
						$client_link  = get_post_meta( get_the_ID(), '_client_link', true ); // URL for "Let's Connect"
						$rating       = (int) get_post_meta( get_the_ID(), '_rating',  true ); // 1..5
						$rating       = max( 0, min( 5, $rating ) );
						$thumb_url    = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
					?>
					<article class="ts-card">
						<div class="ts-card__head">
							<?php if ( $thumb_url ) : ?>
								<img class="ts-avatar" src="<?php echo esc_url( $thumb_url ); ?>" alt="" loading="lazy">
							<?php endif; ?>
						</div>

						<div class="ts-card__body">
							<div class="ts-quote"><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></div>

							<hr class="ts-sep">

							<div class="ts-meta">
								<div class="ts-person">
									<div class="ts-name"><?php echo esc_html( $client_name ?: get_the_title() ); ?></div>
									<?php if ( $client_role ) : ?>
										<div class="ts-role"><?php echo esc_html( $client_role ); ?></div>
									<?php endif; ?>
								</div>
								<div class="ts-right">
									<?php if ( $client_link ) : ?>
										<a class="ts-link" href="<?php echo esc_url( $client_link ); ?>">
											<?php esc_html_e( "Let's Connect", 'yourtheme' ); ?>
										</a>
									<?php endif; ?>
									<div class="ts-stars" aria-label="<?php echo esc_attr( $rating ); ?> stars">
										<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
											<span class="ts-star<?php echo ( $i <= $rating ? ' is-on' : '' ); ?>" aria-hidden="true">★</span>
										<?php endfor; ?>
									</div>
								</div>
							</div>
						</div>
					</article>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		<?php else : ?>
			<p class="ts-empty"><?php esc_html_e( 'No testimonials yet.', 'yourtheme' ); ?></p>
		<?php endif; ?>

	</div>
</section>
