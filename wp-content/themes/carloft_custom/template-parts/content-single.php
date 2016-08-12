<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("row"); ?>>
	<div class="row col-xs-12 entry-content no-pad">
               
              <div class="row first-block">
                     <div class="col-sm-8 no-pad">
                            <h3><?php the_title();?></h3>
                            <h1><?php echo get_field("headline");?></h1>
                            <p class="big"><?php echo get_field("copy"); ?></p>
                     </div>
              </div>
              <?php
              if( have_rows('rows_2') ){
                     // loop through rows (parent repeater)
                     while( have_rows('rows_2') ): the_row(); ?>
                            <div class="row <?php echo the_sub_field("class"); ?>">
                                   <?php 
                                   // loop through cols (sub repeater)
                                   if( have_rows('cols') ){
                                          while( have_rows('cols') ): the_row();
                                                 ?>
                                                 <div class="<?php echo the_sub_field('class'); ?>">
                                                        <?php 
                                                        if(get_sub_field('headline') !== ""){
                                                               ?>
                                                               <h1><?php echo the_sub_field('headline'); ?></h1>
                                                               <?php
                                                        }
                                                        if(get_sub_field('copy') !== ""){
                                                               ?>
                                                               <p><?php echo the_sub_field('copy'); ?></p>
                                                               <?php
                                                        }  
                                                        if(get_sub_field('image')){
                                                               $image = get_sub_field('image');
                                                               ?>
                                                               <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                                               <?php
                                                        }  
                                                        if(get_sub_field('caption') !== ""){
                                                               ?>
                                                               <p class="caption"><?php echo the_sub_field('caption'); ?></p>
                                                               <?php
                                                        }
                                                        ?>
                                                 </div>
                                          <?php 
                                          endwhile; 
                                   } ?>
                             </div>	

                     <?php endwhile; 
              }
              //kontakt page
              if(get_the_ID() == 11){
                     the_field("form");
              }
              ?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
       