<?php

function my_enqueue_assets() {

    wp_enqueue_style( "parent-style", home_url() . '/wp-content/themes/twentysixteen/style.css' );
    wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/style.css',array("parent-style"));
    wp_enqueue_style( 'bootstrap',home_url(). '/wp-content/bootstrap/css/bootstrap.min.css',array("parent-style"));
    
    wp_enqueue_script("jQuery","https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js","", '2.1.4', true );
    wp_enqueue_script("bootstrap",get_site_url()."/wp-content/bootstrap/js/bootstrap.js",array( 'jQuery' ), '1.0', true );
    wp_enqueue_script("basic",get_stylesheet_directory_uri(). "/js/main.js",array( 'jQuery' ), '1.0', true );
    
    //wp_enqueue_script("ajax_calls",get_site_url()."/wp-content/themes/ccetc/js/ajax_calls.js",array( 'jQuery' ), '1.0', true );
    //wp_localize_script("ajax_calls", "ajaxcalls", array("ajaxurl" => admin_url( "admin-ajax.php" )));    
       
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