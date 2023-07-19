<?php get_header(); ?>

<h2><?php echo get_the_title(36);?></h2>
<p>
	<?php
	$blogPost = get_post(36);
	echo $blogPost->post_content;
	?>
</p>

<div class="postscontainer">
<?php while (have_posts()): the_post();
	get_template_part('postlist');
endwhile;

if ($wp_query->found_posts > 10): ?>
	<div class="pagination"><?php echo paginate_links(); ?></div>
<?php endif;

get_footer(); ?>