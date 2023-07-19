<?php
get_header(); ?>

<div class="postscontainer">
<?php while (have_posts()): the_post(); ?>
	<div class="singlepost">
		<?php echo get_the_content(); ?>
	</div>
<?php endwhile; ?>
</div>
<div class="row">
	<div class="column">
		<h3>Recent Blog Posts:</h3>
		<?php
		$recentBlogPosts = new WP_Query(array(
			'posts_per_page' => 2
		));
		
		while ($recentBlogPosts->have_posts()): $recentBlogPosts->the_post(); ?>
			<hr>
			<h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<div class="frontpageposts <?php if (has_post_thumbnail()) echo 'hasthumbnail' ?>">
				<?php if (has_post_thumbnail()): ?>
				<div class="frontpagept">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('thumbnail'); ?>
					</a>
				</div>
				<?php endif; ?>
				<p <?php if (has_post_thumbnail()) echo 'class="frontpageblogtext"' ?>>
					<?php echo get_the_excerpt();
					if (str_word_count(get_the_content()) > 50): ?><br />
						<a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
					<?php endif; ?>
				</p>
			</div>
		<?php endwhile;
		wp_reset_postdata(); ?>
	</div>
	<div class="column">
		<h3>Upcoming Events:</h3>
		<?php
		date_default_timezone_set('America/Toronto');
		$today = date('Ymd');
		$upcomingEvents = new WP_Query(array(
			'posts_per_page' => 2,
			'post_type' => 'activity',
			'meta_key' => 'activity-date',
			'orderby' => 'meta_value',
			'meta_type' => 'DATETIME',
			'order' => 'ASC',
			'meta_query' => array(
				array(
					'key' => 'activity-date',
					'compare' => '>=',
					'value' => $today,
					'type' => 'DATETIME'
				)
			)
		));
		
		if ($upcomingEvents->have_posts()):
			while ($upcomingEvents->have_posts()): $upcomingEvents->the_post(); ?>
				<hr>
				<h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
				<div class="calendarday">
					<div class="datecontainer"><a href="<?php the_permalink(); ?>">
						<?php
						$eventDate = new DateTime((get_field('activity-date')));
						echo $eventDate->format('M'); ?><br />
						<?php echo $eventDate->format('d'); ?>
					</a></div>
					<p class="eventdescription">
						<?php echo get_the_excerpt();
						if (str_word_count(get_the_content()) > 50): ?><br />
							<a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
						<?php endif; ?>
					</p>
				</div>
			<?php endwhile;
		else: ?>
			<p>No Upcoming Events</p>
		<?php endif;
		wp_reset_postdata(); ?>
	</div>
</div>
<?php get_footer();
?>