<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function load_projects(){
       
       $args = array( 'cat' => 7);
       
       query_posts( $args );
       if ( have_posts() ) : 
              ?>
              <div class="row slideshow">
                     <div class="slide_content">
                            <div class="slide_container">
                                   <?php
                                    while ( have_posts() ) : the_post();
                                          ?>
                                          <div class="slide">   
                                                 <div class="img_container">
                                                        <?php the_post_thumbnail(); ?>
                                                 </div>
                                                 <div class="overlay col-xs-12">
                                                        <div class="headline-group">
                                                               <h3>Projekte</h3>
                                                               <h2 class="menu-id-<?php echo the_ID(); ?> headline"><a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                               <?php 
                                                               if(get_field("copy")){
                                                                      ?>
                                                                      <p class="copy"><?php echo substr(get_field("copy"), 0, 150);?></p>
                                                                      <?php
                                                               }
                                                               ?>
                                                        </div>
                                                 </div>
                                          </div>
                                          <?php
                                    endwhile;
                                    ?>
                            </div>
                     </div>
              </div>
              <?php
       endif;
       wp_reset_query();
}