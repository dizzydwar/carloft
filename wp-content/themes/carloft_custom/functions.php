<?php

function my_enqueue_assets() {

    //wp_enqueue_style( "parent-style", home_url() . '/wp-content/themes/twentysixteen/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style( 'bootstrap',home_url(). '/wp-content/bootstrap/css/bootstrap.min.css');
    
    wp_enqueue_script("jQuery","https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js","", '2.1.4', true );
    wp_enqueue_script("bootstrap",get_site_url()."/wp-content/bootstrap/js/bootstrap.js",array( 'jQuery' ), '1.0', true );
    wp_enqueue_script("basic",get_stylesheet_directory_uri(). "/js/main.js",array( 'jQuery' ), '1.0', true );
    wp_enqueue_script("easing",get_stylesheet_directory_uri(). "/js/jquery.easing.1.3.js",array( 'jQuery' ), '1.0', true );
    
    wp_enqueue_script("ajax_calls",get_stylesheet_directory_uri()."/js/ajax_calls.js",array( 'jQuery' ), '1.0', true );
    wp_localize_script("ajax_calls", "ajaxcalls", array("ajaxurl" => admin_url( "admin-ajax.php" )));    
       
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_assets' );



function print_pre($term){
       echo "<pre>";
       print_r($term);
       echo "</pre>";
}




add_action( 'wp_ajax_nopriv_ajax_load_page', 'ajax_load_page' );
add_action( 'wp_ajax_ajax_load_page', 'ajax_load_page' );

function ajax_load_page() {
       
       $id = $_POST[id];
       $slug = $_POST[slug];

       global $post;
       
       // by name       
       if(!empty($slug)){
              // Category
              if(get_category_by_slug($slug)){
                     $args = array('category_name' => $slug );
                     $myposts = get_posts( $args );
                     foreach( $myposts as $post ) :  setup_postdata($post);
                            get_template_part( 'template-parts/content', get_post_format() );
                     endforeach; 
              }
              //post
              else if(get_page_by_path($slug,OBJECT,"post")){
                     $post = get_page_by_path($slug,OBJECT,"post");
                     
                     setup_postdata($post);
                     get_template_part( 'template-parts/content', get_post_format() );    
              }
              //page
              else{
                     $post = get_page_by_path($slug,OBJECT,"page");
                     
                     setup_postdata($post);
                     
                     get_template_part( 'template-parts/content', get_post_format() );    
              }
       }
       // by ID
       else{
              // category
              if(get_category($id)){
                     $args = array('category' => $id );
                     $myposts = get_posts( $args );
                     foreach( $myposts as $post ) :  setup_postdata($post);
                            get_template_part( 'template-parts/content', get_post_format() );
                     endforeach; 
              }
              // post
              else{
                     $post = get_page($id);
                     setup_postdata($post);
                     
                     get_template_part( 'template-parts/content', get_post_format() ); 
              } 
       }       
       wp_reset_postdata();
       die();
}


function get_category_post_links($class, $id){
       $args = "cat=".$id;
       query_posts( $args );
       if ( have_posts() ) : 
              ?>
              <ul class='row big_box_sub_menu <?php echo  $class." cat_id_".$id; ?>' >
              <?php

                     // Start the loop.
                     while ( have_posts() ) : the_post();
                           ?>
                           <li class="col-xs-6 col-sm-3">
                                  <a data_cat_id="<?php echo $id; ?>" data_anchor="<?php echo the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </li>
                           <?php

                     endwhile;
                     ?>
              </ul>
              <?php
       endif;
       wp_reset_query();
}

function load_news($slug = ""){
       
       $args = array( 'cat' => 6, "posts_per_page" => 3);
       
       if($slug !== ""){
              $args = array( 'category_name' => 'news+'.$slug );
       }
       
       query_posts( $args );
       if ( have_posts() ) : 
              ?>
              <ul class='row col-xs-12'>
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
}

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
                                                 <?php the_post_thumbnail(); ?>
                                                 <div class="overlay col-xs-6">
                                                        <div class="headline-group">
                                                               <h3>Projekte</h3>
                                                               <h2 class="menu-id-<?php echo the_ID(); ?> headline"><a  href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                               <p class="copy"><?php echo substr(get_field("subline"), 0, 150);?></p>
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
