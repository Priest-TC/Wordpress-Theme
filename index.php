<?php get_header(); ?>
<div class="col-md-5 offset-md-2 blog-main">

<?php
 if ( have_posts() ) {
 while ( have_posts() ) : the_post();
 ?>
 <div class="blog-post">
 <h2 class="blog-post-title"><?php the_post_thumbnail(); ?> <?php the_title(); ?></h2>
 <p class="blog-post-meta"><?php echo get_avatar( $id_or_email=get_the_author_meta( 'ID' ), $size=64 ); ?><br>
 <?php the_date(); ?> by <?php the_author(); ?></p>
 <?php the_content(); ?>

 </div><!-- /.blog-post -->

<?php
 endwhile;
 }
 ?>
<!--  <nav>
 <ul class="pager">
 <li><?php next_posts_link('Previous'); ?></li>
 <li><?php previous_posts_link('Next'); ?></li>
 </ul>
 </nav> -->

</div><!-- /.blog-main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

