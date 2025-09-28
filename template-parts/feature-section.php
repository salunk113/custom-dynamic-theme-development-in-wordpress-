<?php

/**
 * Feature Section (Template Part)
 */

if (! defined('ABSPATH')) {
    exit;
}

$feature_badge_text  = get_theme_mod('fs_badge_text', __('Our Features', 'yourtheme'));
$feature_title       = get_theme_mod('fs_section_title', __('Why Panda', 'yourtheme'));

// Cards
$cards = [];
for ($i = 1; $i <= 4; $i++) {
    $cards[] = [
        'left_icon'   => get_theme_mod("fs_card{$i}_left_icon", ''),
        'right_icon'  => get_theme_mod("fs_card{$i}_right_icon", ''),
        'title'       => get_theme_mod("fs_card{$i}_title", sprintf(__('Card %d Title', 'yourtheme'), $i)),
        'description' => get_theme_mod("fs_card{$i}_desc", ''),
    ];
}
?>

<section class="fs-section" aria-labelledby="fs-title">
    <div class="fs-container">

        <?php if ($feature_badge_text) : ?>
            <div class="fs-badge">
                <?php
                $feature_badge_icon = get_theme_mod('fs_badge_icon', '');
                if ($feature_badge_icon) : ?>
                    <img class="fs-badge__icon" src="<?php echo esc_url($feature_badge_icon); ?>" alt="" loading="lazy" />
                <?php endif; ?>
                <span><?php echo esc_html($feature_badge_text); ?></span>
            </div>
        <?php endif; ?>

        <h2 id="fs-title" class="fs-title"><?php echo esc_html($feature_title); ?></h2>

        <div class="fs-grid">
            <?php foreach ($cards as $index => $card) :
                $is_primary = (0 === $index); // first card highlighted
            ?>
                <article class="fs-card<?php echo $is_primary ? ' fs-card--primary' : ''; ?>">
                    <header class="fs-card__icons">
                        <span class="fs-card__icon-left">
                            <?php if ($card['left_icon']) : ?>
                                <img src="<?php echo esc_url($card['left_icon']); ?>" alt="" loading="lazy" />
                            <?php endif; ?>
                        </span>
                        <span class="fs-card__icon-right">
                            <?php if ($card['right_icon']) : ?>
                                <img src="<?php echo esc_url($card['right_icon']); ?>" alt="" loading="lazy" />
                            <?php endif; ?>
                        </span>
                    </header>

                    <h3 class="fs-card__title"><?php echo esc_html($card['title']); ?></h3>
                    <p class="fs-card__desc"><?php echo esc_html($card['description']); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>