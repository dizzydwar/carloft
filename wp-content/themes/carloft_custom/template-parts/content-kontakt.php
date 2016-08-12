<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>">
	<div class="entry-content no-pad">
               <div class="first-block">
                     <div class="row">
                            <div class="col-xs-12 col-sm-8">
                                   <h3><?php the_title();?></h3>
                                   <h1><?php echo get_field("headline");?></h1>
                            </div>
                     </div>

                     <div class="row">
                            <div class="col-xs-12 col-sm-8">
                                   <p class="big copy"><?php echo get_field("copy"); ?></p>
                            </div>
                            <?php
                            if(get_field('image')){
                                   $image = get_field('image');
                                   ?>
                                   <div class="col-xs-12 col-sm-4">
                                          <img class="fit" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                   </div>
                                   <?php
                            } 
                            ?>
                     </div>
              </div>
              <div class="row">
                     <?php
                     //kontakt page
                     if(get_field("form")){
                            ?>
                            <div class="col-xs-12 col-sm-4">
                            <?php
                            the_field("form");
                            ?>
                            </div>

                            <script src="http://carloft.ccetc.de/wp-content/plugins/contact-form-7/includes/js/jquery.form.js"></script>
                            <script src="http://carloft.ccetc.de/wp-content/plugins/contact-form-7/includes/js/scripts.js"></script>
                            <?php
                     }
                     ?>
                            
                     <div class="col-xs-12 col-sm-4">
                            <p class="big"><?php the_field("name");?></p>
                            <p><?php the_field("anschrift_1"); ?></p>
                            <p><?php the_field("anschrift_2"); ?></p>
                            <p><?php the_field("telefon"); ?></p>
                            <p><?php the_field("fax"); ?></p>
                            <a class="noajax highlight" href="mailto:<?php the_field("email"); ?>"><?php the_field("email"); ?></a>
                     </div>
                            
              </div> 
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
