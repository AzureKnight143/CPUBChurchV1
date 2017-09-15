<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="description" content="College Park Church offers two services on Sunday morning at 8:30am (Traditional Service) and 11:00am (Contemporary Service). College Park's desire is that each individual at College Park will be Loving God and those around them, Growing in their walk with Christ, and Serving God's kingdom work. College Park Church is located in Huntington, Indiana." />
<meta name="keywords" content="College park church, College park church Huntington, College park church Huntington IN, College Park Church Huntington Indiana, Cp church, College park UB, College Park Church UB, College park united brethren, College Park Church United brethren, Churches in Huntington Indiana, Churches in Huntington IN, Huntington Indiana united brethren, cpub, cpubchurch" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/images/favicon.jpg"" />
<?php wp_enqueue_script('jquery'); ?>

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#access-mobile select").change(function() {
				window.location = $(this).find("option:selected").val();
			});
		});
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed">
		<header id="branding">
			<div id="header" class="wrapper">
				<div id="logo">
					<a href="/"><img src="<?php echo dirname( get_bloginfo('stylesheet_url')); ?>/images/logo.png" alt="College Park Church" /></a>
				</div>
				<div id="header-links">
					<a href="/loving/" class="blue">loving</a>
					<a href="/category/growing/" class="yellow">growing</a>
					<a href="/category/serving/" class="green">serving</a>
				</div>
				<nav id="access" role="navigation">
					<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</nav>
				<nav id="access-mobile" role="navigation">
				<?php
				class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
					function start_lvl(&$output, $depth){
						$indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
					}

					function end_lvl(&$output, $depth){
						$indent = str_repeat("\t", $depth); // don't output children closing tag
					}

					function start_el(&$output, $item, $depth, $args){
						// add spacing to the title based on the depth
						$item->title = str_repeat("&nbsp;", $depth * 4).$item->title;

						parent::start_el($output, $item, $depth, $args);

						// no point redefining this method too, we just replace the li tag...
						$output = str_replace('<li', '<option value=\''.$item->url.'\'', $output);
					}

					function end_el(&$output, $item, $depth){
						$output .= "</option>\n"; // replace closing </li> with the option tag
					}
				}
				wp_nav_menu(array(
					'theme_location' => 'secondary', // your theme location here
					'walker'         => new Walker_Nav_Menu_Dropdown(),
					'items_wrap'     => '<select>%3$s</select>',
				)); ?>
				</nav>
				<div class="clear-both"></div>
			</div>
		</header>
	<div class="wrapper">
		<div id="main">