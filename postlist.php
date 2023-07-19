<?php if (get_post_type() == 'post'):
?>
<div class="singlepost <?php if (has_post_thumbnail()) echo 'hasthumbnail' ?>">
	<?php if (has_post_thumbnail()): ?>
	<div class="postthumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('thumbnail'); ?>
		</a>
	</div>
	<?php endif; ?>
	<div class="postcontent">
		<h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
		<p>
			<?php echo get_the_excerpt();
			if (str_word_count(get_the_content()) > 50): ?>
				<a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
			<?php endif; ?>
		</p>
	</div>
</div>
<?php elseif (get_post_type() == 'activity'): ?>
	<hr>
	<div class="calendarday">
		<div class="datecontainer"><a href="<?php the_permalink(); ?>">
			<?php
			$eventDate = new DateTime((get_field('activity-date')));
			echo $eventDate->format('M'); ?><br />
			<?php echo $eventDate->format('d'); ?>
		</a></div>
		<p class="eventdescription">
			<h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
			<p class="archivedescholder">
				<?php echo get_the_excerpt();
				if (str_word_count(get_the_content()) > 50): ?><br />
					<a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
				<?php endif; ?>
			</p>
		</p>
	</div>
<?php endif; ?>