<?php
get_header();

while (have_posts()): the_post(); ?>
	<div class="banner"><?php the_post_thumbnail('banner'); ?></div>
	<?php get_template_part('likebox'); ?>
	<h2 class="newmargin"><?php the_title();?></h2>
	<?php the_content(); ?>
<?php endwhile;

if (comments_open() or get_comments_number()): ?>
	<hr>
	<?php comments_template();
endif;

get_footer();
?>