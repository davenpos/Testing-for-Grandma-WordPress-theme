<?php $likeCount = new WP_Query(array(
    'post_type' => 'like',
    'meta_query' => array(
        array(
            'key' => 'liked_post_id',
            'compare' => '=',
            'value' => get_the_ID()
        )
    )
));

if (is_user_logged_in()):
    $existsQuery = new WP_Query(array(
        'post_type' => 'like',
        'author' => get_current_user_id(),
        'meta_query' => array(
            array(
                'key' => 'liked_post_id',
                'compare' => '=',
                'value' => get_the_ID()
            )
        )
    ));

    $exists = ($existsQuery->have_posts()) ? 'yes' : 'no';
endif; ?>

<span class="postinfo likebox <?php if (!has_post_thumbnail() and get_post_type(get_the_ID()) == 'post') echo 'singlepostnothumbnail' ?>" data-like="<?php if (isset($existsQuery->posts[0]->ID)) echo $existsQuery->posts[0]->ID; ?>" data-post="<?php the_ID(); ?>" data-exists="<?php echo $exists; ?>">
	<i class="fa fa-heart-o" aria-hidden="true"></i>
	<i class="fa fa-heart" aria-hidden="true"></i>
	<span class="likecount"><?php echo $likeCount->found_posts ?></span>
</span>