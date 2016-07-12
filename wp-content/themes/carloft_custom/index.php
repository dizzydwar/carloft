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
                                   <div class="overlay col-xs-11 col-md-8 col-lg-6">
                                          <div class="headline-group">
                                                 <h3>CarLoggia</h3>
                                                 <h2>Erdgeschoss im 4. Stock</h2>
                                                 <p class="copy">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
                                          </div>

                                   </div>
                            </div>
                            
                            <div class="slide">                     
                                   <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/malte_jaeger_carloft-3_edit.jpg" alt=""/>
                                   <div class="overlay col-sm-12 col-md-6">
                                          <div class="headline-group">
                                                 <h3>CarLoggia</h3>
                                                 <h2>Erdgeschoss im 4. Stock</h2>
                                                 <p class="copy">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. </p>
                                          </div>

                                   </div>
                            </div>
                            
                            <div class="slide">                     
                                   <img src="<?php echo  get_stylesheet_directory_uri(); ?>/images/malte_jaeger_carloft_edit_2.jpg" alt=""/>
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


       <div class="row col-sm-12 fixed_height" id="big_box_row">
              <div class="col-xs-4 fixed_height big_box prinzip" id="prinzip"><div class="cont"><a data_cat_id="3" href="<?php echo get_page_link(5); ?>" ><?php echo get_field("kompletter_titel" ,5);?></a></div></div>
              <div class="col-xs-4 fixed_height big_box entwickler" id="entwickler"><div class="cont"><a data_cat_id="4" href="<?php echo get_page_link(7); ?>" ><?php echo get_field("kompletter_titel" ,7);?></a></div></div>
              <div class="col-xs-4 fixed_height big_box realisierung" id="realisierung"><div class="cont"><a data_cat_id="5" href="<?php echo get_page_link(9); ?>" ><?php echo get_field("kompletter_titel" ,9);?></a></div></div>
              
              <div class="row col-sm-12" id="big_box_sub_row">
                     <?php get_category_post_links("prinzip",3); ?>
                     <?php get_category_post_links("entwickler",4); ?>
                     <?php get_category_post_links("realisierung",5); ?>
              </div>
       </div>


       <div id="page_content_box" class="row col-sm-12">
              <div id="page_content" class="">
              
              </div>
       </div>


       <div class="row col-xs-12">
              <div class="col-sm-8 medium has_height">
                     
              </div>

              <div class="col-sm-4 dark has_height">

              </div>
       </div>
       

        
<?php get_footer();
