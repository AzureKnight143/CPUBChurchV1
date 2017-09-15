<?php get_header(); ?>
<link type="text/css" rel="stylesheet" href="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/scripts/flexslider.css">
<script src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/scripts/jquery.flexslider-min.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {		
		$('.banners').flexslider({
			animation: "slide",
			slideshowSpeed: 9000,
			animationDuration: 800,
			directionNav: false,
			pauseOnHover: true,
			slideshow: true
		});
	});
</script>

<div class="banners">
	<ul class="slides">
	<?php
	$args = array( 
		'post_type' => 'banner', 
		'orderby' => 'post_date',
		'order' => 'DESC',
		'post_status' => 'publish'  
	);
	
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		if (has_post_thumbnail()) {
		?>
			<li class="slide questrial">
				<?php if (get_post_meta($post->ID, 'link', true) == "") { ?>
					<a href="<?php the_permalink(); ?>">
				<?php } else { ?>
					<a href="<?php echo get_post_meta($post->ID, 'link', true); ?>">
				<?php } ?>
					<?php the_post_thumbnail('full'); ?>
					<div class="banner-text">
						<h1><?php the_title(); ?></h1>
						<span class="description"><?php echo get_post_meta($post->ID, 'description', true); ?></span>
					</div>
				</a>
			</li>
		<?php
		}
	endwhile;
	?>
	</ul>
</div>

<?php $bookmarks = get_bookmarks(
	array(
		'category' => 11,
		'orderby' => 'rating',
		'limit' => 4,
		'categorize' => false
	)
); ?>

<ul class="teasers home-links questrial">
	<?php $count = 1; ?>
	<?php foreach ( $bookmarks as $bm ) { ?>
			<li class="teaser<?php echo $count; ?>">
			<a href="<?php echo $bm->link_url; ?>">
				<img src="<?php echo $bm->link_image; ?>" alt="<?php echo $bm->link_name; ?>" />
				<div class="teaser-title"><?php echo $bm->link_name; ?></div>
			</a>
		</li>
		<?php $count++; ?>
	<?php } ?>
</ul>

<?php get_footer(); ?>