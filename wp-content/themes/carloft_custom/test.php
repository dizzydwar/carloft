<?php
print_pre($post);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
       <?php $post -> post_title; ?>
</article>