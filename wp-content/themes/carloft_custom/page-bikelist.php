<?php
/**
 * @package WordPress
 * Template Name: bikelist
 */

get_header(); ?>
       <div id="primary" class="content-area">
               
              <main id="main" class="site-main" role="main">   
                     <div class="row">
                            <div class="head_area col-xs-12 col-sm-8 col-lg-4">
                                   <h1><?php echo get_field("headline"); ?></h1>
                                   <h3><?php echo get_field("subline"); ?></h3>
                                   <p><?php echo get_field("copy"); ?></p>
                            </div>
                     </div>   
                     <div class="row" id="projects">
                            <?php 
                            $args = 'cat=4';
                            query_posts( $args );
                            if ( have_posts() ) : ?>
                                    <?php
                                    // Start the loop.
                                    while ( have_posts() ) : the_post();

                                            /*
                                             * Include the Post-Format-specific template for the content.
                                             * If you want to override this in a child theme, then include a file
                                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                             */
                                            get_template_part( 'template-parts/preview', get_post_format() );

                                    // End the loop.
                                    endwhile;

                                    // Previous/next page navigation.
                                    the_posts_pagination( array(
                                            'prev_text'          => __( 'Previous page', 'twentysixteen' ),
                                            'next_text'          => __( 'Next page', 'twentysixteen' ),
                                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
                                    ) );

                            endif;
                            wp_reset_query();
                            ?>
                     </div>
                       
		</main><!-- .site-main -->
                
	</div><!-- .content-area -->
        
<?php get_footer(); ?>
