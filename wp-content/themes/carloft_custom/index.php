<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>
       <div class="row col-sm-12 slideshow">
              <div class="slide_content">
                     <div class="slide_container">
                            <div class="slide">                     
                                   <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/malte_jaeger_carloft-3.jpg" alt=""/>
                                   <div class="overlay col-sm-12 col-md-6">
                                          <div class="headline-group">
                                                 <h3>CarLoggia</h3>
                                                 <h2>Erdgeschoss im 4. Stock</h2>
                                                 <p class="copy">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
                                          </div>

                                   </div>
                            </div>
                            <div class="slide">                     
                                   <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/malte_jaeger_carloft-3.jpg" alt=""/>
                                   <div class="overlay col-sm-12 col-md-6">
                                          <div class="headline-group">
                                                 <h3>CarLoggia</h3>
                                                 <h2>Erdgeschoss im 4. Stock</h2>
                                                 <p class="copy">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
                                          </div>

                                   </div>
                            </div>
                     </div>
              </div>
       </div>
       <div class="row col-sm-12" id="big_box_row">
              <a href="<?php echo get_page_link(5); ?>" class="col-xs-12 col-sm-4 has_ratio big_box prinzip" id="prinzip" data-ratio="0.5"><?php echo get_field("titel_komplett" ,5);?></a>
              <a href="<?php echo get_page_link(7); ?>" class="col-xs-12 col-sm-4 has_ratio big_box entwickler" id="entwickler" data-ratio="0.5"><?php echo get_field("titel_komplett" ,7);?></a>
              <a href="<?php echo get_page_link(9); ?>" class="col-xs-12 col-sm-4 has_ratio big_box realisierung" id="realisierung" data-ratio="0.5"><?php echo get_field("titel_komplett" ,9);?></a>
              
              <div class="row col-sm-12" id="big_box_sub_row">
                     <?php get_category_post_links("prinzip",3); ?>
                     <?php get_category_post_links("entwickler",4); ?>
                     <?php get_category_post_links("realisierung",5); ?>
              </div>
       </div>
       <div class="col-sm-8 medium has_height">

       </div>
       <div class="col-sm-4 dark has_height">

       </div>
<?php
function get_category_post_links($class, $id){
       $args = "cat=".$id;
       query_posts( $args );
       if ( have_posts() ) : 
              ?>
              <ul class='row big_box_sub_menu <?php echo $class; ?>' >
              <?php
              
               // Start the loop.
               while ( have_posts() ) : the_post();

                     ?>
                     <li class="col-sm-3">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                     </li>
                     <?php

               endwhile;
               echo "</ul>";
       endif;
       wp_reset_query();
}

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">   
                       
                       
                       
                     <div class="row">
                            <?php 
                            $args = 'cat=3';
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
                                            //get_template_part( 'template-parts/content', get_post_format() );

                                    // End the loop.
                                    endwhile;
                            endif;
                            wp_reset_query();
                            ?>
                     </div>
                       
                       
                       
		</main><!-- .site-main -->
	</div><!-- .content-area -->
        
<?php get_footer(); ?>
