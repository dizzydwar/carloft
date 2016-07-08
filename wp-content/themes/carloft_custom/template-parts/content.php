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

	<div class="row col-xs-12 entry-content">
               <div class="row col-sm-8">
                     <h3><?php the_title();?></h3>
                     <h1><?php echo get_field("headline");?></h1>
                     <p class="big"><?php echo get_field("copy"); ?></p>
               </div>
               
              <?php
              if( have_rows('rows') ){
                     // loop through rows (parent repeater)
                     while( have_rows('rows') ): the_row(); ?>
                            <div class="row <?php echo get_sub_field('class'); ?>">
                                   <h1><?php the_sub_field('headline'); ?></h1>
                                   <p class="big"><?php the_sub_field('copy'); ?></p>

                                   <?php 

                                   // check for rows (sub repeater)
                                   if( have_rows('images') ){?>

                                          <?php  
                                          // loop through rows (sub repeater)
                                          while( have_rows('images') ): the_row();
                                          ?>
                                          <div class="row <?php echo get_sub_field('class');?>">
                                                 <img class="fit" src="<?php echo the_sub_field("image"); ?>"/>
                                                 <p><?php echo get_sub_field('caption');?></p>
                                          </div>
                                          <?php endwhile; 

                                   } ?>
                             </div>	

                     <?php endwhile; // while( has_sub_field('to-do_lists') ):
              }
              ?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
