<?php
    $class_map = array(
        'main_menu'   => 'main-menu-mobile-on',
        'top_menu'    => 'top-menu-mobile-on',
        'both_menus'  => 'both-menus-mobile-on'
    );
    $mobile_menu_opt = hu_get_option( 'header_mobile_menu_layout' );
    $mobile_menu_class = array_key_exists( $mobile_menu_opt, $class_map ) ? $class_map[ $mobile_menu_opt ] : 'main-menu-mobile-on';
?>
<header id="header" class="<?php echo apply_filters( 'hu_header_classes', implode(' ', array( $mobile_menu_class ) ) ); ?>">
  <?php if ( ! wp_is_mobile() || ( wp_is_mobile() && in_array( $mobile_menu_opt, array( 'top_menu', 'both_menus' ) ) ) ) : ?>
    <?php if ( hu_has_nav_menu('topbar') ): ?>
      <?php get_template_part('parts/header-nav-topbar'); ?>
    <?php endif; ?>
  <?php endif; ?>

  <div class="container group">
    <?php do_action('__before_after_container_inner'); ?>

    <div class="container-inner">

      <?php
        $_header_img_src = get_header_image();// hu_get_img_src_from_option('header-image');
        $_has_header_img = false != $_header_img_src && ! empty( $_header_img_src );
      ?>

      <?php if ( ! $_has_header_img || ! hu_is_checked( 'use-header-image' ) ) : ?>
          <?php if ( ! wp_is_mobile() || ( wp_is_mobile() && 'both_menus' == $mobile_menu_opt ) ) : ?>
              <div class="group pad central-header-zone">
                <?php hu_print_logo_or_title();//gets the logo or the site title ?>
                <?php if ( hu_is_checked('site-description') ): ?><p class="site-description"><?php hu_render_blog_description() ?></p><?php endif; ?>

                <?php if ( hu_is_checked('header-ads') ): ?>
                  <div id="header-widgets">
                    <?php hu_print_widgets_in_location( 'header-ads' ); ?>
                  </div><!--/#header-ads-->
                <?php endif; ?>
              </div>
          <?php endif; ?>
      <?php else :  ?>
          <div id="header-image-wrap">
              <?php hu_render_header_image( $_header_img_src ); ?>
          </div>
      <?php endif; ?>

      <?php if ( ! wp_is_mobile() || ( wp_is_mobile() && in_array( $mobile_menu_opt, array( 'main_menu', 'both_menus' ) ) ) ) : ?>
        <?php if ( hu_has_nav_menu('header') ): ?>
          <?php get_template_part('parts/header-nav-main'); ?>
        <?php endif; ?>
      <?php endif; ?>

    </div><!--/.container-inner-->

    <?php do_action('__header_after_container_inner'); ?>
  </div><!--/.container-->

</header><!--/#header-->