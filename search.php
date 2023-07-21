<?php get_header();

if (have_posts()): ?>
	<h2>Search results for "<?php the_search_query(); ?>":</h2>
	<div class="postscontainer">
		<?php while (have_posts()): the_post();
			get_template_part('postlist', get_post_type());
		endwhile; ?>
	</div>
<?php else: ?>
	<h2>No results found for "<?php the_search_query(); ?>"</h2>
<?php endif;

if ($wp_query->found_posts > 10): ?>
	<div class="pagination"><?php echo paginate_links(); ?></div>
<?php endif;

get_footer(); ?>