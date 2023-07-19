<?php
get_header();

while (have_posts()): the_post(); ?>
	<nav id="childmenu"><ul>
		<?php $parentID = wp_get_post_parent_id(get_the_ID());
		
		$childrenOf = ($parentID) ? $parentID : get_the_ID();
		
		wp_list_pages(array(
			'title_li' => NULL,
			'child_of' => $childrenOf
		)); ?>
	</ul></nav>
	<h2><?php the_title();?></h2>
	<p><?php the_content(); ?></p>
<?php endwhile;

get_footer();
?>