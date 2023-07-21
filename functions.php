<?php
function filesForSite() {
	wp_enqueue_style('main_stylesheet', get_stylesheet_uri());
	wp_enqueue_style('font_awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_script('like_script', get_theme_file_uri('/like.js'), array('jquery'), '1.0', true);
	wp_localize_script('like_script', 'siteData', array(
		'root_url' => get_site_url(),
		'nonce' => wp_create_nonce('wp_rest')
	));
}

add_action('wp_enqueue_scripts', 'filesForSite');

function siteFeatures() {
	add_theme_support('title-tag');
	register_nav_menu('topMenu', 'Top Menu');
	register_nav_menu('bottomMenu', 'Bottom Menu');
	add_theme_support('post-thumbnails');
	add_image_size('thumbnail', 180, 110, true);
	add_image_size('banner', 1320, 150, true);
}

add_action('after_setup_theme', 'siteFeatures');

function newSettings($wp_customize) {
	$wp_customize->add_setting('linkColor', array(
		'default' => '#00DDEE',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_section('colorPicker', array(
		'title' => __('Link Color Picker', 'Testing for Grandma'),
		'priority' => 30
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'Link Color Control', array(
		'label' => __('Link Color', 'Testing for Grandma'),
		'section' => 'colorPicker',
		'settings' => 'linkColor'
	)));
}

add_action('customize_register', 'newSettings');

function colorPickerCSS() { ?>
	<style type="text/css">
		h2.posttitle a:link, h2.posttitle a:visited, nav ul li a, p a:link, p a:visited, h3.posttitle a:link, h3.posttitle a:visited, div#comments a, a.readmore, a.page-numbers {
			color: <?php echo get_theme_mod('linkColor'); ?>;
		}
		
		nav#topmenu ul li a, input#submit, input#searchsubmit, div#accountbuttons a {
			background-color: <?php echo get_theme_mod('linkColor'); ?>;
		}
	</style>
<?php }

add_action('wp_head', 'colorPickerCSS');

function getExcerptLength() {
	return 50;
}

add_filter('excerpt_length', 'getExcerptLength');

function autoTurnCommentsOn(){
    global $wpdb;
    $wpdb->query($wpdb->prepare("UPDATE $wpdb->posts SET comment_status = 'open' WHERE post_type = 'activity'")); 
}

autoTurnCommentsOn();

function redirectSubscribers() {
	$ourCurrentUser = wp_get_current_user();
	
	if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber'):
		wp_redirect(site_url('/'));
		exit;
	endif;
}

add_action('admin_init', 'redirectSubscribers');

function removeAdminBar() {
	$ourCurrentUser = wp_get_current_user();
	
	if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber'):
		show_admin_bar(false);
	endif;
}

add_action('wp_loaded', 'removeAdminBar');

function orderQueries($query) {
	if (!is_admin() and is_post_type_archive('activity') and $query->is_main_query()):
		$query->set('meta_key', 'activity-date');
		$query->set('orderby', 'meta_value');
	endif;
}

add_action('pre_get_posts', 'orderQueries');

function likeRoutes() {
	register_rest_route('testForGrandma/v1', 'manageLike', array(
		'methods' => 'POST',
		'callback' => 'createLike'
	));

	register_rest_route('testForGrandma/v1', 'manageLike', array(
		'methods' => 'DELETE',
		'callback' => 'deleteLike'
	));
}

add_action('rest_api_init', 'likeRoutes');

function createLike($data) {
	if (is_user_logged_in()):
		$postID = sanitize_text_field($data['postID']);

		$existsQuery = new WP_Query(array(
			'post_type' => 'like',
			'author' => get_current_user_id(),
			'meta_query' => array(
				array(
					'key' => 'liked_post_id',
					'compare' => '=',
					'value' => $postID
				)
			)
		));

		if ($existsQuery->found_posts == 0 and (get_post_type($postID) == 'post' or get_post_type($postID) == 'activity')):
			return wp_insert_post(array(
				'post_type' => 'like',
				'post_status' => 'publish',
				'meta_input' => array(
					'liked_post_id' => $postID
				)
			));
		else:
			die("Invalid post ID.");
		endif;
	else:
		die("Only logged in users can like posts or activities.");
	endif;
}

function deleteLike($data) {
	$likeID = sanitize_text_field($data['like']);
	if (get_current_user_id() == get_post_field('post_author', $likeID) and get_post_type($likeID) == 'like'):
		wp_delete_post($likeID, true);
		return 'Like deleted';
	else:
		die("You do not have permission to remove likes.");
	endif;
}

//Code to create the activity post type. In my actual WordPress folder on my computer, this code exists in the mu-plugins folder rather than my theme folder.
/*
function activityPostType() {
	register_post_type('activity', array(
		'public' => true,
		'menu_icon' => 'dashicons-calendar',
		'menu_position' => 20,
		'supports' => array('title', 'editor', 'excerpt', 'comments'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'activities'),
		'labels' => array(
			'name' => 'Activities',
			'singular_name' => 'Activity',
			'add_new_item' => 'Add New Activity',
			'new_item' => 'New Activity',
			'view_item' => 'View Activity',
			'view_items' => 'View Activities',
			'search_items' => 'Search Activities',
			'not_found' => 'No activities found',
			'all_items' => 'All Activities',
			'archives' => 'Activity Archives',
			'attributes' => 'Activity Attributes',
			'insert_into_item' => 'Insert into activity',
			'uploaded_to_this_item' => 'Uploaded to this activity',
			'filter_items_list' => 'Filter activities list',
			'filter_by_date' => 'Filter by date',
			'items_list_navigation' => 'Activities list navigation',
			'items_list' => 'Activities list',
			'item_published' => 'Activity published',
			'item_published_privately' => 'Activity privately',
			'item_reverted_to_draft' => 'Activity reverted to draft',
			'item_scheduled' => 'Activity scheduled',
			'item_updated' => 'Activity updated',
			'item_link' => 'Activity link',
			'item_link_description' => 'A link to an activity'
		)
	));
}

add_action('init', 'activityPostType');
*/
?>