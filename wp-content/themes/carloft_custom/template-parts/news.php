<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$args = array( 'cat' => 6, "posts_per_page" => 3);
       
       if($slug !== ""){
              $args = array( 'category_name' => 'news+'.$slug );
       }
       
       query_posts( $args );
       if ( have_posts() ) : 
              ?>
              <div class="head">
                     <h3>News</h3>
              </div>
              
              <ul>
                     <?php
                     // Start the loop.
                     while ( have_posts() ) : the_post();
                           // space after menu-id- for jquery index of end point (" ")
                           ?>
                           <li class="menu-id-<?php echo the_ID(); ?> ">
                                  <a href="<?php the_permalink(); ?>">
                                         <div class="row">
                                                <p class='date'><?php the_date("j. M Y  |  G:i"); ?></p>
                                                <h3><?php the_title(); ?></h3>
                                         </div>
                                         <p><?php echo substr(get_field("copy"), 0, 150);?></p>
                                  </a>
                           </li>
                           <?php

                     endwhile;
              echo "</ul>";
       endif;
       wp_reset_query();
       
function load_news($slug = ""){
       
       
}


