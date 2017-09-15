<?php
//runs each of the functions at the appropriate times
add_action('init', 'banner_register');
add_action('admin_init', 'admin_init');
add_action('save_post', 'save_details');
add_action('after_setup_theme', 'setup', 11);
add_action('widgets_init', 'remove_sidebars', 11);

//function to be run after theme setup
function setup() {
	add_post_formats();
	remove_twentyeleven_options();
	add_navigation();
}

//remvoes the extra post formats from twentyeleven
function add_post_formats() {
	add_theme_support( 'post-formats', array() );
}

//removes the extra sidebars from twentyeleven
function remove_sidebars() {
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
	unregister_sidebar( 'sidebar-4' );
	unregister_sidebar( 'sidebar-5' );
}

//removes the extra options from twentyelven
function remove_twentyeleven_options() {
	remove_custom_background();
	remove_custom_image_header();
}

//adds the mobile and footer navigation options to the admin
function add_navigation() {
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'twentyeleven' ) );
	register_nav_menu( 'footer', __( 'Footer Menu', 'twentyeleven' ) );
}

// sets up the banner custom post type
function banner_register() {
	$labels = array(
		'name' => _x('Banners', 'post type general name'),
		'singular_name' => _x('Banner', 'post type singular name'),
		'add_new' => _x('Add New', 'banner'),
		'add_new_item' => __('Add New Banner'),
		'edit_item' => __('Edit Banner'),
		'new_item' => __('New Banner'),
		'view_item' => __('View Banner'),
		'search_items' => __('Search Banners'),
		'not_found' =>  __('Nothing Found'),
		'not_found_in_trash' => __('Nothing Found in Trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail')
	); 
	register_post_type( 'banner' , $args );
}

//adds data fields to the banner custom post type
function admin_init(){
	add_meta_box("description_meta", "Description", "build_description_meta", "banner", "normal", "low");
	add_meta_box("link_meta", "Banner Link", "build_link_meta", "banner", "side", "low");
}

//builds the form for the banners description meta
function build_description_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$description = $custom["description"][0];
	?>
	<div class="wp-editor-container">
		<textarea class="wp-editor-area" style="height: 50px;" rows="20" cols="40" name="description"><?php echo $description; ?></textarea>
	</div>
	<?php
}

//build the form for the banners link meta
function build_link_meta(){
	global $post;
	$custom = get_post_custom($post->ID);
	$link = $custom["link"][0];
	?>
	<label>Insert the path of the page you want the banner to link to (ex. /contact-us/).<br /><br />Leave this blank to create a new page using the content to the left.</label>
	<input style="width: 95.5%;" name="link" value="<?php echo $link; ?>" />
	<?php
}

//saves values for banner custom post
function save_details(){
  global $post;
 
  update_post_meta($post->ID, "description", $_POST["description"]);
  update_post_meta($post->ID, "link", $_POST["link"]);
}
?>