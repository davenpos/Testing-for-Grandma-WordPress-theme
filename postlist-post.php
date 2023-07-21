<div class="singlepost <?php if (has_post_thumbnail()) echo 'hasthumbnail' ?>">
	<?php if (has_post_thumbnail()): ?>
	<div class="postthumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail('thumbnail'); ?>
		</a>
	</div>
	<?php endif; ?>
	<div class="postcontent">
		<?php get_template_part('likebox'); ?>
		<a class="commentnum" href="<?php echo get_the_permalink() . '#comments'; ?>">
			<span class="postinfo">
				<i class="fa fa-comment" aria-hidden="true"></i>
				<span class="likecount"><?php echo get_comments_number(); ?></span>
			</span>
		</a>
		<h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
		<p>
			<?php echo get_the_excerpt();
			if (str_word_count(get_the_content()) > 50): ?>
				<a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
			<?php endif; ?>
		</p>
	</div>
</div>