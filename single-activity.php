<?php get_header();

while (have_posts()): the_post();
	get_template_part('likebox'); ?>
	<h2 class="posttitle newmargin"><?php the_title();?></h2>
	<div class="calendarday">
		<div class="datecontainer">
			<?php
			$eventDate = new DateTime((get_field('activity-date')));
			echo $eventDate->format('M'); ?><br />
			<?php echo $eventDate->format('d'); ?>
		</div>
		<p class="eventdescription singleevent">
			<?php echo get_the_content(); ?>
		</p>
	</div>
	<h3>This event took place on <?php echo $eventDate->format('F j, Y'); ?> at approximately <?php echo $eventDate->format('g:i a'); ?>.</h3>
<?php endwhile;

if (comments_open() or get_comments_number()): ?>
	<hr>
	<?php comments_template();
endif;

get_footer(); ?>