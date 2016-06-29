<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
<div class="col-xs-12 col-sm-6 col-md-4 col-xl-3 preview fixed_height" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <div class="inner">
              <div class="thumb_area" data-ratio="2" >  
                     <?php twentysixteen_post_thumbnail(); ?>
              </div>
	
              <div class="entry-content">
                     <p class="date_created"><?php echo get_the_date("j. n. Y"); ?></p>
                     <h2 class=""><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                     <?php the_content(); ?>
              </div>
              <div class="lower_row">
                     <a href="<?php the_permalink(); ?>">zum Projekt</a>
              </div>
       </div>
</div><!-- #post-## -->
