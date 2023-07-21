<?php get_header(); ?>

<h2><?php echo get_the_title(20);?></h2>
<p>
	<?php
	$activityPost = get_post(20);
	echo $activityPost->post_content;
	?>
</p>

<?php while (have_posts()): the_post();
	get_template_part('postlist', 'activity');
endwhile;

if ($wp_query->found_posts > 10): ?>
	<div class="pagination"><?php echo paginate_links(); ?></div>
<?php endif;

get_footer(); ?>