

<?php
/**
 * Footer Section
 * File: template-parts/footer.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Branding
$footer_logo  = get_theme_mod( 'ft_logo', '' );
$footer_desc  = get_theme_mod( 'ft_desc', __( 'Delivery Panda is a logistics start up based in Dubai, we make E commerce logistics simplified and economical.', 'yourtheme' ) );

// Links (Company, Services, Resources, Socials)
$company_links   = get_theme_mod( 'ft_company_links', [] );
$services_links  = get_theme_mod( 'ft_services_links', [] );
$resources_links = get_theme_mod( 'ft_resources_links', [] );
$socials_links   = get_theme_mod( 'ft_socials_links', [] );

// Copyright
$footer_copy = get_theme_mod( 'ft_copy', '© Copyright Delivery Panda 2024 - Designed by Hoztok Technologies' );

?>
<footer class="site-footer">
  <div class="ft-container">

    <!-- Logo + description -->
    <div class="ft-col ft-branding">
      <?php if ( $footer_logo ) : ?>
        <div class="ft-logo">
          <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php bloginfo('name'); ?>" loading="lazy">
        </div>
      <?php endif; ?>
      <?php if ( $footer_desc ) : ?>
        <p class="ft-desc"><?php echo esc_html( $footer_desc ); ?></p>
      <?php endif; ?>
    </div>

    <!-- Company -->
    <div class="ft-col">
      <h4 class="ft-heading"><?php esc_html_e( 'Company', 'yourtheme' ); ?></h4>
      <ul class="ft-list">
        <?php if ( is_array($company_links) ) :
          foreach ( $company_links as $link ) :
            if ( ! empty( $link['text'] ) && ! empty( $link['url'] ) ) : ?>
              <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endif;
          endforeach;
        endif; ?>
      </ul>
    </div>

    <!-- Services -->
    <div class="ft-col">
      <h4 class="ft-heading"><?php esc_html_e( 'Our Services', 'yourtheme' ); ?></h4>
      <ul class="ft-list">
        <?php if ( is_array($services_links) ) :
          foreach ( $services_links as $link ) :
            if ( ! empty( $link['text'] ) && ! empty( $link['url'] ) ) : ?>
              <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endif;
          endforeach;
        endif; ?>
      </ul>
    </div>

    <!-- Resources -->
    <div class="ft-col">
      <h4 class="ft-heading"><?php esc_html_e( 'Resources', 'yourtheme' ); ?></h4>
      <ul class="ft-list">
        <?php if ( is_array($resources_links) ) :
          foreach ( $resources_links as $link ) :
            if ( ! empty( $link['text'] ) && ! empty( $link['url'] ) ) : ?>
              <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endif;
          endforeach;
        endif; ?>
      </ul>
    </div>

    <!-- Socials -->
    <div class="ft-col">
      <h4 class="ft-heading"><?php esc_html_e( 'Socials', 'yourtheme' ); ?></h4>
      <ul class="ft-list">
        <?php if ( is_array($socials_links) ) :
          foreach ( $socials_links as $link ) :
            if ( ! empty( $link['text'] ) && ! empty( $link['url'] ) ) : ?>
              <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endif;
          endforeach;
        endif; ?>
      </ul>
    </div>

  </div>

  <div class="ft-bottom">
    <p><?php echo esc_html( $footer_copy ); ?></p>
  </div>
</footer>



<?php wp_footer(); ?>
</body>
</html>
