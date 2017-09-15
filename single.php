<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage College_Park_Church
 * @since College Park Church 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php $category = get_the_category(); 
					$show = true;
					if($category[0]){
						if($category[0]->term_id != 7) {
							$id = 0;
						} else if ($category[1]) {
							$id = 1;
						} else {
							$show = false;
						}
					}
					if ($show == true) { ?>					
						<nav id="nav-single">
							<span class="back-link"><?php echo 'Back to <a href="'.get_category_link($category[$id]->term_id ).'">'.$category[$id]->cat_name.'</a>';?></span>
							<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
							<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
							<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
						</nav><!-- #nav-single -->
					<?php } ?>

					<?php get_template_part( 'content', 'single' ); ?>

					<?php //comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>