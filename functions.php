<?php
function filesForSite() {
	wp_enqueue_style('main_stylesheet', get_stylesheet_uri());
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

function orderActivityDates($query) {
	if (!is_admin() and is_post_type_archive('activity') and $query->is_main_query()):
		$query->set('meta_key', 'activity-date');
		$query->set('orderby', 'meta_value');
	endif;
}

add_action('pre_get_posts', 'orderActivityDates');

/* Test */
?>