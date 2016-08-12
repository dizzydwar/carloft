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

get_header(); 
       get_template_part( 'template-parts/big_box' ,'collapsed');
       ?>

       <div id="page_content_box" class="">
              <div id="page_content" class="">
                     <?php
                     while ( have_posts() ) : the_post();
                            get_template_part( 'template-parts/content', 'content' );
                            // End of the loop.
                     endwhile;
                     ?>
              </div>
       </div>

       <?php
get_footer();
