<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


                            </div><!-- #content -->

                            <footer id="colophon" class="site-footer row col-xs-12" role="contentinfo">
                                   <div class="row col-xs-4 clearfix logos">
                                          <a href="<?php  echo home_url(); ?>" class="logo1"><?php echo bloginfo("title"); ?></a>
                                          <a href="<?php  echo home_url(); ?>" class="logo2"><?php echo bloginfo("title"); ?></a>
                                   </div>
                                   <div class="row col-xs-12 col-sm-4">
                                          <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                                  <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
                                                          <?php
                                                                  wp_nav_menu( array(
                                                                          'theme_location' => 'primary',
                                                                          'menu_class'     => 'primary-menu',
                                                                   ) );
                                                          ?>
                                                  </nav><!-- .main-navigation -->
                                          <?php endif; ?>
                                   </div>
                                   <div class="row col-xs-12 col-sm-4">
                                          <?php if ( has_nav_menu( 'social' ) ) : ?>
                                                  <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
                                                          <?php
                                                                  wp_nav_menu( array(
                                                                          'theme_location' => 'social',
                                                                          'menu_class'     => 'social-links-menu',
                                                                          'depth'          => 1,
                                                                          'link_before'    => '<span class="screen-reader-text">',
                                                                          'link_after'     => '</span>',
                                                                  ) );
                                                          ?>
                                                  </nav><!-- .social-navigation -->
                                          <?php endif; ?>
                                   </div>
                            </footer><!-- .site-footer -->

                            <div class="site-info row col-xs-12">
                                   <?php
                                           /**
                                            * Fires before the twentysixteen footer text for footer customization.
                                            *
                                            * @since Twenty Sixteen 1.0
                                            */
                                           do_action( 'twentysixteen_credits' );
                                   ?>
                                   <span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
                                   <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
                            </div><!-- .site-info -->
                     </div><!-- .site-inner -->
              </div><!-- .site -->
              <?php wp_footer(); ?>
       </body>
</html>
