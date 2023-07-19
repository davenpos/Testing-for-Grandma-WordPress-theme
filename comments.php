<?php
if (post_password_required()):
	return;
endif;
?>

<div id="comments" class="comments-area">
	<?php if (have_comments()): ?>
		<h3 class="comments-title">
			<?php
			printf(
				_x(
					'Comments on "%2$s" (' . get_comments_number() . ')',
					'comments title',
					'testingforgrandma'
				),
				number_format_i18n(get_comments_number()),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</h3>

		<ul class="comment-list">
			<?php
			wp_list_comments(array(
				'style'       => 'ul',
				'short_ping'  => true,
				'avatar_size' => 45,
			));
			?>
		</ul>
		
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
			<nav class="navigation comment-navigation" role="navigation">

				<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'testingforgrandma' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'testingforgrandma' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'testingforgrandma' ) ); ?></div>
			</nav><!-- .comment-navigation -->
		<?php endif;

		if (!comments_open() && get_comments_number()): ?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'testingforgrandma' ); ?></p>
		<?php endif;
	else: ?>
		<h3 class="comments-title">No comments on this post.</h3>
	<?php endif;

	comment_form(array(
		'title_reply' => 'Leave a comment',
		'title_reply_to' => 'Reply to %s'
	)); ?>

</div>