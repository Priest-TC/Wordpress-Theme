<?php
get_header();
?>
<div class="col-md-5 offset-md-2 blog-main">
        <div id="content" class="blog-post" role="main">
                <?php
                while( have_posts() ) :
                        the_post(); ?>

                        <h2 class="blog-post-title"><?php the_title(); ?></h2>
                        <p class="blog-post-meta"><?php echo get_avatar( $id_or_email=get_the_author_meta( 'ID' ), $size=64 ); ?><br>
                        <?php the_date(); ?> by <?php the_author(); ?><?php the_tags(); ?></p>
                        <?php the_content(); ?>

                        <?php
                        if( comments_open() || get_comments_number() ) {
                                        comments_template();
                        }

                        endwhile;
                ?>
        </div><!--#content-->
</div><!--#primary-->

<?php
get_sidebar();
get_footer();

$my_defaults = array(
	'before'		=> '<p>' . __( 'Pages:', 'my-theme' ),
	'after'			=> '</p>',
	'link_before'		=> '',
	'link_after'		=> '',
	'next_or_number'	=> 'number',
	'seperator'		=> ' ',
	'nextpagelink'		=> __( 'Next Page', 'my-theme' ),
	'previouspagelink'	=> __( 'Previous Page', 'my-theme' ),
	'pagelink'		=> '%',
	'echo'			=> 1

);

wp_link_pages( $my_defaults );

?>
