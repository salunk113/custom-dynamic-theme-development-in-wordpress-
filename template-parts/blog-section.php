<?php
/**
 * Blog Section (Template Part)
 * File: template-parts/blog-section.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$badge_text   = get_theme_mod( 'bs_badge_text', __( 'Blogs', 'yourtheme' ) );
$badge_icon   = get_theme_mod( 'bs_badge_icon', '' ); // image URL
$section_title= get_theme_mod( 'bs_section_title', __( 'See Our Latest Blogs!', 'yourtheme' ) );

$viewall_text = get_theme_mod( 'bs_viewall_text', __( 'View All', 'yourtheme' ) );
$viewall_icon = get_theme_mod( 'bs_viewall_icon', '' ); // image URL (arrow)
$viewall_url  = get_theme_mod( 'bs_viewall_url', get_post_type_archive_link( 'post' ) );

$readmore_text= get_theme_mod( 'bs_readmore_text', __( 'READ MORE', 'yourtheme' ) );

// Selected posts (IDs) from Customizer; if empty, fallback to latest posts
$selected_ids = array_filter( [
	get_theme_mod( 'bs_post_1', 0 ),
	get_theme_mod( 'bs_post_2', 0 ),
	get_theme_mod( 'bs_post_3', 0 ),
	get_theme_mod( 'bs_post_4', 0 ),
] );

$query_args = [
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'posts_per_page'      => 4,
];

if ( ! empty( $selected_ids ) ) {
	$query_args['post__in'] = array_map( 'intval', $selected_ids );
	$query_args['orderby']  = 'post__in'; // keep Customizer order
} else {
	$query_args['orderby']  = 'date';
	$query_args['order']    = 'DESC';
}

$q = new WP_Query( $query_args );
?>

<section class="bs-section" aria-labelledby="bs-title">
	<div class="bs-container">

		<!-- Badge -->
		<?php if ( $badge_text ) : ?>
			<div class="bs-badge">
				<?php if ( $badge_icon ) : ?>
					<img class="bs-badge__icon" src="<?php echo esc_url( $badge_icon ); ?>" alt="" loading="lazy">
				<?php endif; ?>
				<span><?php echo esc_html( $badge_text ); ?></span>
			</div>
		<?php endif; ?>

		<!-- Header row -->
		<div class="bs-head">
			<h2 id="bs-title" class="bs-title"><?php echo esc_html( $section_title ); ?></h2>

			<?php if ( $viewall_text && $viewall_url ) : ?>
				<a class="bs-viewall" href="<?php echo esc_url( $viewall_url ); ?>">
					<span><?php echo esc_html( $viewall_text ); ?></span>
					<?php if ( $viewall_icon ) : ?>
						<img class="bs-viewall__icon" src="<?php echo esc_url( $viewall_icon ); ?>" alt="" loading="lazy">
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Grid -->
		<?php if ( $q->have_posts() ) : ?>
			<div class="bs-grid">
				<?php while ( $q->have_posts() ) : $q->the_post(); ?>
					<article class="bs-card">
						<a class="bs-thumb" href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'large', [
									'loading' => 'lazy',
									'class'   => 'bs-thumb__img',
									'alt'     => the_title_attribute( [ 'echo' => false ] ),
								] );
							} else {
								// optional placeholder style block
								echo '<div class="bs-thumb__placeholder"></div>';
							}
							?>
						</a>

						<h3 class="bs-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<div class="bs-card__excerpt">
							<?php
							$excerpt = get_the_excerpt();
							echo esc_html( wp_trim_words( $excerpt, 22, '…' ) );
							?>
						</div>

						<a class="bs-card__more" href="<?php the_permalink(); ?>">
							<?php echo esc_html( $readmore_text ); ?>
						</a>
					</article>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="bs-empty"><?php esc_html_e( 'No posts found.', 'yourtheme' ); ?></p>
		<?php endif; ?>

	</div>
</section>
