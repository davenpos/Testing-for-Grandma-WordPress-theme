<hr>
<div class="calendarday">
    <div class="datecontainer"><a href="<?php the_permalink(); ?>">
        <?php
        $eventDate = new DateTime((get_field('activity-date')));
        echo $eventDate->format('M'); ?><br />
        <?php echo $eventDate->format('d'); ?>
    </a></div>
    <p class="eventdescription">
        <?php get_template_part('likebox'); ?>
        <a class="commentnum" href="<?php echo get_the_permalink() . '#comments'; ?>">
            <span class="postinfo">
                <i class="fa fa-comment" aria-hidden="true"></i>
                <span class="likecount"><?php echo get_comments_number(); ?></span>
            </span>
        </a>
        <h3 class="posttitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
        <p class="archivedescholder">
            <?php echo get_the_excerpt();
            if (str_word_count(get_the_content()) > 50): ?><br />
                <a class="readmore" href="<?php the_permalink(); ?>">Read more</a>
            <?php endif; ?>
        </p>
    </p>
</div>