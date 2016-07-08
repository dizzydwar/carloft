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


add_action( 'wp_ajax_nopriv_ajax_get_random', 'ajax_get_random' );
add_action( 'wp_ajax_ajax_get_random', 'ajax_get_random' );

function ajax_get_random() {
       $rows = get_field('ccetc_macht' , 31); // get all the rows
       $rand_row = $rows[ array_rand( $rows ) ]; // get a random row
       $rand_row_string = $rand_row['ccetc_macht' ]; // get the sub field value 
       
       
       echo $rand_row_string;
       die();
}


add_action( 'wp_ajax_nopriv_ajax_load_page', 'ajax_load_page' );
add_action( 'wp_ajax_ajax_load_page', 'ajax_load_page' );

function ajax_load_page() {
       
       $cat_id = $_POST[cat_id];
       $id = $_POST[id];
       
       if($cat_id != 0){
              global $post;
              $args = array('category' => $cat_id );
              $myposts = get_posts( $args );
              foreach( $myposts as $post ) :  setup_postdata($post);
                     get_template_part( 'template-parts/content', get_post_format() );
                     
              endforeach;
       }else if($id != 0){
              global $post;
              
              $post = get_post( $id );
              setup_postdata($post);
              get_template_part( 'template-parts/content', get_post_format() );
              
       }
      
       die();
}

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
                            <a data_cat_id="<?php echo $id; ?>" data_anchor="<?php echo the_ID(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                     </li>
                     <?php

               endwhile;
               echo "</ul>";
       endif;
       wp_reset_query();
}

/*
function wpa_category_nav_class( $classes, $item ){
       
       $cat = get_field("kategorie",$item->object_id);
       if(!empty($cat)){
              $classes[] = 'menu-cat-' . $cat;
       }
       
       return $classes;
}
add_filter( 'nav_menu_css_class', 'wpa_category_nav_class', 10, 2 );
*/