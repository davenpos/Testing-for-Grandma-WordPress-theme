<?php
get_header();

while (have_posts()): the_post(); ?>
	<div class="banner"><?php the_post_thumbnail('banner'); ?></div>
	<h2><?php the_title();?></h2>
	<p><?php the_content(); ?></p>
<?php endwhile;

if (comments_open() or get_comments_number()): ?>
	<hr>
	<?php comments_template();
endif;

get_footer();
?>