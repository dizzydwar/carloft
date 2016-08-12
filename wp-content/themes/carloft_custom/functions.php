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

show_admin_bar( false );

add_filter('single_template', 'category_list');

function category_list($the_template){
       $the_template;
       foreach( (array) get_the_category() as $cat ) {
              if(has_category("prinzip") || has_category("entwickler") || has_category("realisierung")){
                     return STYLESHEETPATH . "/category-list.php"; 
              }
       }
       return $the_template;
}

class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
                
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . " " .$item->title. '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
        function start_lvl(&$output, $depth) {
              $indent = str_repeat("\t", $depth);
              $output .= "\n$indent<ul class=\"my-sub-menu\">\n";
       }
}

register_nav_menus( array(
	'secondary_menu' => 'main pages menu'
) );

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
                     $post_name =  $post -> post_name;
                     
                     get_template_part( 'template-parts/content', $post_name );    
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
              <ul class='row big_box_sub_menu no-pad <?php echo  $class." cat_id_".$id; ?>' >
              <?php

                     // Start the loop.
                     while ( have_posts() ) : the_post();
                           ?>
                           <li class="col-xs-6 col-sm-3 no-pad">
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
                                         <div class="clearfix">
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
              <div class="slideshow">
                     <div class="slide_content">
                            <div class="slide_container">
                                   <?php
                                    while ( have_posts() ) : the_post();
                                          ?>
                                          <div class="slide">   
                                                 <div class="img_container">
                                                        <?php the_post_thumbnail(); ?>
                                                 </div>
                                                 <div class="overlay col-xs-12 col-lg-8 ">
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
