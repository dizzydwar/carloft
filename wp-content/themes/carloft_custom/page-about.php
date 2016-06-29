<?php
/**
 * @package WordPress
 * Template Name: about
 */

get_header(); ?>
       <div id="primary" class="content-area">
               
              <main id="main" class="site-main" role="main">   
                       
                       
                     <div class="row" >
                            <h1 class="col-xs-12 "><?php echo the_field("headline"); ?></h1>
                            <p class="col-xs-12 col-md-4 "><?php echo the_field("copy"); ?></p>
                     </div>
                       
		</main><!-- .site-main -->
                
	</div><!-- .content-area -->
        
<?php get_footer(); ?>
