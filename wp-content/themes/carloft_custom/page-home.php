<?php
/**
 * @package WordPress
 * Template Name: Home
 */

get_header(); ?>
       <div id="primary" class="content-area">
               
              <main id="main" class="site-main" role="main">   
                       
                     <div id="start_screen">  
                            <?php 
                            $headline = get_field("headline");
                            $subline = get_field("subline");
                            
                            $ccetc_macht = get_field('ccetc_macht',31 ); // get all the rows
                            $first_row = $ccetc_macht[0]; // get the first row
                            $first_row_string = $first_row['ccetc_macht' ]
                                    
                            ?>
                            <div id="main_quote" class="row" >
                                   <h1> <?php echo $headline." <span class='ccetc_macht'>".$first_row_string."</span>"?> <span id="get_random"></span></h1>
                                   <h3><?php echo $subline; ?></h3>
                                   <a href="<?php the_permalink(8); ?>"><div class="btn btn-default">über ccetc < > hannes dolde</div></a>
                                   <a href="mailto:hannes.dolde@ccetc.de"><div class="btn btn-dark flow_btn">mail</div></a>
                            </div>
                            <p id="more_below"></p>
                     </div>
                       
                     <div class="row" id="projects">

                            <?php 
                            $args = array("cat" => 3,
                                          "showposts" => 4);
                            
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

                            endif;
                            wp_reset_query();
                            ?>
                     </div>
                     
                     <div class="block_separator">
                            <h2>weitere Projekte und freie Arbeiten</h2>
                     </div>
                     
                     <div class="row" id="">
                            <div class="col-s-12 col-md-8 col-xl-6 preview" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                   <div class="inner">
                                          <div class="slideshow thumb_area">
                                                 <div class="slide_content">
                                                        <ul class="clearfix slide_container">
                                                               <?php
                                                               $args = 'cat=4';
                                                               query_posts( $args );

                                                               while ( have_posts() ) : the_post();
                                                                      ?>
                                                                      <li class="slide">
                                                                             <?php
                                                                             the_post_thumbnail();
                                                                             ?>
                                                                      </li>
                                                                      <?php
                                                               endwhile;
                                                               ?>
                                                        </ul>
                                                 </div> 
                                          </div>
                                          <?php

                                          $pageID = 37;
                                          $page = get_post($pageID);
                                          ?>

                                          <div class="entry-content">
                                                 <h2 class=""><a href="<?php the_permalink($pageID); ?>" rel="bookmark"><?php echo $page->post_title; ?></a></h2>
                                                 <p><?php echo get_field("teaser",$pageID); ?></p>
                                          </div>
                        
                                          <div class="lower_row">
                                                 <a href="<?php the_permalink($pageID); ?>">zur Übersicht</a>
                                          </div>
                                   </div>
                            </div><!-- #post-## -->
                            
                            <div class="col-s-12 col-md-4 col-xl-6 preview" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                   <div class="inner">
                                          <div class="slideshow thumb_area">
                                                 <div class="slide_content">
                                                        <ul class="clearfix slide_container">
                                                               <?php
                                                               $args = 'cat=5';
                                                               query_posts( $args );

                                                               while ( have_posts() ) : the_post();
                                                                      ?>
                                                                      <li class="slide">
                                                                             <?php
                                                                             the_post_thumbnail();
                                                                             ?>
                                                                      </li>
                                                                      <?php
                                                               endwhile;
                                                               ?>
                                                        </ul>
                                                 </div> 
                                          </div>
                                          <?php

                                          $pageID = 80;
                                          $page = get_post($pageID);
                                          ?>

                                          <div class="entry-content">
                                                 <h2 class=""><a href="<?php the_permalink($pageID); ?>" rel="bookmark"><?php echo $page->post_title; ?></a></h2>
                                                 <p><?php echo get_field("teaser",$pageID); ?></p>
                                          </div>
                        
                                          <div class="lower_row">
                                                 <a href="<?php the_permalink($pageID); ?>">zur Übersicht</a>
                                          </div>
                                   </div>
                            </div><!-- #post-## -->
                     </div>
                       
		</main><!-- .site-main -->
                
	</div><!-- .content-area -->
        
<?php get_footer(); ?>
