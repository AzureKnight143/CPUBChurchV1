<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage College_Park_Church
 * @since College Park Church 1.0
 */
?>
<?php if ($post->post_parent!=0) { ?>
	<nav id="nav-single">
		<?php $parent = $post->post_parent ?>
		<span class="back-link">Back to <a href="<?php $parentLink = get_permalink($parent); echo $parentLink; ?>"><?php echo get_the_title($parent) ?></a></span>
	</nav>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
		
	</header><!-- .page-header -->

	<div class="entry-content">
		<?php 
		if ($post->post_parent==15) { //contact page only
			if (has_post_thumbnail()) {
		?>
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("thumbnail", array('class' => 'featured-image')); ?></a>
		<?php 
			}
			$subtitle = get_post_meta($post->ID, 'Subtitle', $single = true);
			if($subtitle !== '') 
				echo "<h2>".$subtitle."</h2>";
		}
		?>	
		<?php the_content();?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="clear-both"></div>
	
	<?php $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent=".$post->ID." AND post_type='page' AND post_status='publish' ORDER BY menu_order", 'OBJECT'); ?>
		
	<!-- displays children pages if it has any -->
	<ul class="teasers sub-page-list">
	<?php $count = 0; ?>
	<?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
		<?php if ($count % 4 == 0) { ?>
			<li class="first">
		<?php } else { ?>
			<li>
		<?php } ?>
			<a href="<?php echo  get_permalink($pageChild->ID); ?>"><?php echo get_the_post_thumbnail($pageChild->ID, array(145,145)); ?>
				<div class="teaser-title">
				<?php echo $pageChild->post_title; ?>
				<?php $subtitle = get_post_meta($pageChild->ID, 'Subtitle', $single = true);
					if($subtitle !== '') 
						echo "<span class='teaser-subtitle'>".$subtitle."</span>";
				?>
				</div>
			</a>
		</li>
		<?php $count++; ?>
	<?php endforeach; endif;?>
	</ul>
	
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
