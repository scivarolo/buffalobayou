<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/


/*********************
SCRIPTS
*********************/
function custom_scripts() {

  if( !is_admin() ) {

    if( is_front_page() ) {

  	  wp_register_script( 'owl-carousel', get_stylesheet_directory_uri() . '/library/js/owl.carousel.min.js', false, false, true );
    	wp_enqueue_script( 'owl-carousel' );

    	wp_register_script( 'owl-init', get_stylesheet_directory_uri() . '/library/js/owl.init.js', false, false, true );
    	wp_enqueue_script( 'owl-init' );

    }

    if( is_page('Visit') ) {

      wp_register_script( 'bbp-google-map', 'https://maps.googleapis.com/maps/api/js?libraries=visualization&key=AIzaSyBLQ_N7vauEL92CGlE6H5MeO_HzJd0c4n4', false, false, true );
    	wp_enqueue_script( 'bbp-google-map' );

      wp_register_script( 'infobubble', get_stylesheet_directory_uri() . '/library/js/map/infobubble.js', false, false, true );
    	wp_enqueue_script( 'infobubble' );

      wp_register_script( 'map-main', get_stylesheet_directory_uri() . '/library/js/map/main.js', false, false, true );
    	wp_enqueue_script( 'map-main' );

    }

  	wp_register_script( 'simple-weather', get_stylesheet_directory_uri() . '/library/js/jquery.simpleWeather.min.js', false, false, true );
  	wp_enqueue_script( 'simple-weather' );

  	wp_register_script( 'jquery-nav', get_stylesheet_directory_uri() . '/library/js/jquery.nav.js', false, false, true );
  	wp_enqueue_script( 'jquery-nav' );
	}
}

function custom_styles() {

  if( !is_admin() ) {
    if( is_front_page() ) {
  	wp_register_style( 'owl-carousel-css', get_stylesheet_directory_uri() . '/library/css/owl.carousel.css', false, false );
  	wp_enqueue_style( 'owl-carousel-css' );

  	wp_register_style( 'owl-transitions-css', get_stylesheet_directory_uri() . '/library/css/owl.transitions.css', false, false );
  	wp_enqueue_style( 'owl-transitions-css' );
  }
}
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_styles' );


// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'custom_scripts' );


/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 200, true );
add_image_size( '800-wide', 800 );
add_image_size( 'tooltip-thumb', 320 );
add_image_size( 'home-destination', 412, 250, true);
add_image_size( 'home-slider', 1200, 400, true);

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
        '800-wide' => __('800px wide'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'News Sidebar', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

  register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Blog Sidebar', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!





//EVENTS QUERY FILL IN

function fill_in_extra_events( $query_object ) {

			$how_many = 3 - $query_object->post_count;
			$not_these = wp_list_pluck( $query_object->posts, 'ID' );

			$get_posts_args = array(
				'post_status'=>'publish',
			  'post_type'=>array(Tribe__Events__Main::POSTTYPE),
			  'posts_per_page'=> $how_many,
			  //order by startdate from newest to oldest
			  'meta_key'=>'_EventStartDate',
			  'orderby'=>'_EventStartDate',
			  'order'=>'ASC',
			  //required in 3.x
			  'eventDisplay'=>'custom',
			  //query events by category
			  'posts__not_in' => $not_these
			);

			$posts = get_posts( $get_posts_args );
			$these_posts_please = wp_list_pluck( $posts, 'ID' );
			$these_posts_please = array_merge( $not_these, $these_posts_please );

			$wp_query_args = array(
				'post__in' => $these_posts_please,
				'orderby' => 'rand'
			);

			$get_posts = new WP_Query($wp_query_args);

			return $get_posts;

		}



// Register Nature Blog Post Type
// Register Custom Post Type

function nature_blog_post_type() {

	$labels = array(
		'name'                  => _x( 'Blog Posts', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Blog Post', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Blog', 'text_domain' ),
		'name_admin_bar'        => __( 'Blog', 'text_domain' ),
		'archives'              => __( 'Blog Archives', 'text_domain' ),
		'attributes'            => __( 'Blog Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Post:', 'text_domain' ),
		'all_items'             => __( 'All Blog Posts', 'text_domain' ),
		'add_new_item'          => __( 'Add Blog Post', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Post', 'text_domain' ),
		'edit_item'             => __( 'Edit Post', 'text_domain' ),
		'update_item'           => __( 'Update Post', 'text_domain' ),
		'view_item'             => __( 'View Post', 'text_domain' ),
		'view_items'            => __( 'View Posts', 'text_domain' ),
		'search_items'          => __( 'Search Posts', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Post', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this post', 'text_domain' ),
		'items_list'            => __( 'Posts list', 'text_domain' ),
		'items_list_navigation' => __( 'Posts list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter posts list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Blog Post', 'text_domain' ),
		'description'           => __( 'Blog Posts', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields' ),
		'taxonomies'            => array( 'blog-category', ' blog-tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-aside',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'blog', $args );

}
add_action( 'init', 'nature_blog_post_type', 0 );

// Register Blog Category Taxonomy
// Register Custom Taxonomy

function blog_category() {

	$labels = array(
		'name'                       => _x( 'Blog Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Blog Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Blog Category', 'text_domain' ),
		'all_items'                  => __( 'All Blog Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Blog Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Blog Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Blog Category', 'text_domain' ),
		'add_new_item'               => __( 'Add New Blog Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Blog Category', 'text_domain' ),
		'update_item'                => __( 'Update Blog Category', 'text_domain' ),
		'view_item'                  => __( 'View Blog Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate blog categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove blog categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Blog Categories', 'text_domain' ),
		'search_items'               => __( 'Search Blog Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No blog categories', 'text_domain' ),
		'items_list'                 => __( 'Blog categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Blog Categories list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'blog-category', array( 'blog' ), $args );

}
add_action( 'init', 'blog_category', 0 );



// Register Blog Tags Taxonomy
// Register Custom Taxonomy
function blog_tag() {

	$labels = array(
		'name'                       => _x( 'Blog Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Blog Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Blog Tags', 'text_domain' ),
		'all_items'                  => __( 'All Blog Tags', 'text_domain' ),
		'parent_item'                => __( 'Parent Blog Tag', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Blog Tag:', 'text_domain' ),
		'new_item_name'              => __( 'New Blog Tag', 'text_domain' ),
		'add_new_item'               => __( 'Add New Blog Tag', 'text_domain' ),
		'edit_item'                  => __( 'Edit Blog Tag', 'text_domain' ),
		'update_item'                => __( 'Update Blog Tag', 'text_domain' ),
		'view_item'                  => __( 'View Blog Tag', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Blog Tags with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove blog tags', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Blog Tags', 'text_domain' ),
		'search_items'               => __( 'Search Blog Tags', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Blog Tags', 'text_domain' ),
		'items_list'                 => __( 'Blog Tags list', 'text_domain' ),
		'items_list_navigation'      => __( 'Blog Tags list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'blog-tag', array( 'blog' ), $args );

}
add_action( 'init', 'blog_tag', 0 );


// Register Destinations Custom Post Type
function destinations_custom_post_type() {

	$labels = array(
		'name'                => 'Destinations',
		'singular_name'       => 'Destination',
		'menu_name'           => 'Destinations',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Destinations',
		'view_item'           => 'View Destination',
		'add_new_item'        => 'Add New Destination',
		'add_new'             => 'Add New Destination',
		'edit_item'           => 'Edit Destination',
		'update_item'         => 'Update Destination',
		'search_items'        => 'Search Destinations',
		'not_found'           => 'Destination Not Found',
		'not_found_in_trash'  => 'Destination not found in Trash',
	);
	$rewrite = array(
		'slug'                => 'visit/destination',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'destination',
		'description'         => 'Major Destinations along Buffalo Bayou',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'destination', $args );

}

// Hook into the 'init' action
add_action( 'init', 'destinations_custom_post_type', 0 );




// Register Features Custom Post Type
function features_custom_post_type() {

	$labels = array(
		'name'                => 'Features',
		'singular_name'       => 'Feature',
		'menu_name'           => 'Features',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Features',
		'view_item'           => 'View Feature',
		'add_new_item'        => 'Add New Feature',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Feature',
		'update_item'         => 'Update Feature',
		'search_items'        => 'Search Feature',
		'not_found'           => 'Feature Not Found',
		'not_found_in_trash'  => 'Feature Not Found in Trash',
	);
	$args = array(
		'label'               => 'destination_feature',
		'description'         => 'Features for Buffalo Bayou Destinations',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'destination_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'destination_feature', $args );

}

// Hook into the 'init' action
add_action( 'init', 'features_custom_post_type', 0 );





// Register Art Custom Post Type
function art_custom_post_type() {

	$labels = array(
		'name'                => 'Subfeature (Art)',
		'singular_name'       => 'Subfeature (Art)',
		'menu_name'           => 'Subfeature (Art)',
		'parent_item_colon'   => 'Parent Item:',
		'all_items'           => 'All Subfeatures',
		'view_item'           => 'View Subfeatures',
		'add_new_item'        => 'Add New Subfeature',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Subfeature',
		'update_item'         => 'Update Subfeature',
		'search_items'        => 'Search Subfeature',
		'not_found'           => 'Subfeature not found',
		'not_found_in_trash'  => 'Subfeature not found in Trash',
	);
	$args = array(
		'label'               => 'art',
		'description'         => 'Art along Buffalo Bayou',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'taxonomies'          => array( 'destination_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 20,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	);
	register_post_type( 'art', $args );

}

// Hook into the 'init' action
add_action( 'init', 'art_custom_post_type', 0 );





// Register Destination Tags Custom Taxonomy
function destination_custom_taxonomy() {

	$labels = array(
		'name'                       => 'Destination Tags',
		'singular_name'              => 'Destination Tag',
		'menu_name'                  => 'Destination Tags',
		'all_items'                  => 'All Destinations',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'New Destination Tag',
		'add_new_item'               => 'Add New Destination Tag',
		'edit_item'                  => 'Edit Destination Tag',
		'update_item'                => 'Update Destination Tag',
		'separate_items_with_commas' => 'Separate Tags with commas',
		'search_items'               => 'Search Destination Tags',
		'add_or_remove_items'        => 'Add or remove Tags',
		'choose_from_most_used'      => 'Choose from the most used Destination Tags',
		'not_found'                  => 'Destination Tag Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'destination_tag', array('art', 'destination_feature'), $args );

}

// Hook into the 'init' action
add_action( 'init', 'destination_custom_taxonomy', 0 );


// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );



function get_the_slug( $id=null ) {
	if( empty($id) ):
		global $post;
		if( empty($post) )
			return ''; //No global $post var available.
		$id = $post->ID;
	endif;

	$slug = basename( get_permalink($id) );
	return $slug;
}

function the_slug( $id=null ) {
	echo apply_filters('the_slug', get_the_slug($id) );
}

if ( function_exists('acf_add_options_page') ) {

acf_add_options_page('Footer');
acf_add_options_page('News Options');
acf_add_options_page('Blog Settings');

}

function buttongroup_shortcode($atts, $content = null) {
  return '<div class="text-center">' . do_shortcode($content) . '</div>';
}

add_shortcode('buttongroup', 'buttongroup_shortcode');

function button_shortcode($atts, $content = null) {
  extract( shortcode_atts( array(
    'url' => '#',
    'color' => 'green'
  ), $atts ) );
  return '<a href="' . $url . '" class="button ' . $color . '">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'button_shortcode');

?>
