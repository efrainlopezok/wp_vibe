<?php
/**
 * Miscellaneous
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Image Function
function bfg_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return bfg_get_first_image();
}

// Get the First Image Attachment Function
function bfg_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = "";
	if ( isset( $matches[1][0] ) )
		$first_img = $matches[1][0];
	return $first_img;
}

// Custom Meta
add_action( 'genesis_meta', 'bfg_do_meta' );
function bfg_do_meta() {
	// Jumbotron
	if ( is_front_page() && is_active_sidebar( 'home-featured' ) ) add_action( 'genesis_after_header', 'bfg_do_home_featured' );

	// Body Class
	add_filter( 'body_class', 'bfg_body_class' );
}

// Jumbotron
function bfg_do_home_featured() {
	genesis_markup( array(
		'open' => '<div %s>',
		'context' => 'home-featured'
	) );

	genesis_structural_wrap( 'home-featured' );

	genesis_widget_area( 'home-featured', array(
		'before' => '',
		'after' => ''
	) );

	genesis_structural_wrap( 'home-featured', 'close' );

	genesis_markup( array(
		'close' => '</div>',
		'context' => 'home-featured'
	) );
}

// Body Class
function bfg_body_class( $args ) {
	if ( is_page_template( 'page_blog.php' ) )
		$args[] = 'blog';

	return $args;
}

//* Customize the entire footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	$logo_footer = get_field('logo_footer','option');
	$copyright = get_field('copyright','option');
	if($logo_footer):
	?>
	<div class="footer-logo">
		<img src="<?php echo $logo_footer;?>" />
	</div>
	<?php endif;?>
	<div class="footer-menu">
		<?php wp_nav_menu( array(
    			'menu'   => 'Footer Menu') );?>
	</div>
	<?php if($copyright): ?>
	<div class="copy">
		<?php echo do_shortcode($copyright); ?>
	</div>
	<?php
	endif;
}

add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyA7-sQ0v6I_tohW4d2-iIv5OLkLH4VpVyA');
}

add_action('acf/init', 'my_acf_init');

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Gallery', 'Gallery', 'vibe' ),
		'singular_name'         => _x( 'Gallery', 'Gallery', 'vibe' ),
		'menu_name'             => __( 'Galleries', 'vibe' ),
		'name_admin_bar'        => __( 'Gallery', 'vibe' ),
		'archives'              => __( 'Item Archives', 'vibe' ),
		'attributes'            => __( 'Item Attributes', 'vibe' ),
		'parent_item_colon'     => __( 'Parent Item:', 'vibe' ),
		'all_items'             => __( 'All Items', 'vibe' ),
		'add_new_item'          => __( 'Add New Item', 'vibe' ),
		'add_new'               => __( 'Add New', 'vibe' ),
		'new_item'              => __( 'New Item', 'vibe' ),
		'edit_item'             => __( 'Edit Item', 'vibe' ),
		'update_item'           => __( 'Update Item', 'vibe' ),
		'view_item'             => __( 'View Item', 'vibe' ),
		'view_items'            => __( 'View Items', 'vibe' ),
		'search_items'          => __( 'Search Item', 'vibe' ),
		'not_found'             => __( 'Not found', 'vibe' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'vibe' ),
		'featured_image'        => __( 'Featured Image', 'vibe' ),
		'set_featured_image'    => __( 'Set featured image', 'vibe' ),
		'remove_featured_image' => __( 'Remove featured image', 'vibe' ),
		'use_featured_image'    => __( 'Use as featured image', 'vibe' ),
		'insert_into_item'      => __( 'Insert into item', 'vibe' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'vibe' ),
		'items_list'            => __( 'Items list', 'vibe' ),
		'items_list_navigation' => __( 'Items list navigation', 'vibe' ),
		'filter_items_list'     => __( 'Filter items list', 'vibe' ),
	);
	$args = array(
		'label'                 => __( 'Gallery', 'vibe' ),
		'description'           => __( 'Gallery Description', 'vibe' ),
		'labels'                => $labels,
		'supports'           => array( 'title','editor'),
		'taxonomies'            =>'',
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'page',
		'rewrite' 				=> false
	);
	register_post_type( 'post_type', $args );

}
add_action( 'init', 'custom_post_type', 0 );