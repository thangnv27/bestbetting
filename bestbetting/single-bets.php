<?php get_header(); ?>
<div class="main">
    <?php while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
        <div class="content single">

            <div class="bet-content">
                <?php the_content(); ?>
            </div>
            <?php
            $loop = new WP_Query(
                    array(
                'post_type' => 'betting',
                'meta_key' => 'bet_group',
                'meta_value' => get_the_ID(),
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'asc'
                    )
            );
            while ($loop->have_posts()) : $loop->the_post();
                ?>
                <div class="row">
                    <div class="betlogo">
                        <p class="bet-type"><?php echo get_post_meta(get_the_ID(), 'bet_type', true) ?></p>
                        <a href="<?php echo get_post_meta(get_the_ID(), 'bet_link', true) ?>">
                        <!--<a href="http://goo.gl/QFwoYu">-->
                            <img src="<?php echo get_post_meta(get_the_ID(), 'bet_logo', true) ?>" />
                        </a>
                    </div>
                    <div class="betinfo">
                        <h3><?php the_title(); ?></h3>
                        <div class="betdes">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <div class="betbtn">
                        <a href="<?php echo get_post_meta(get_the_ID(), 'bet_link', true) ?>"></a>
                        <!--<a href="http://goo.gl/QFwoYu"></a>-->
                    </div>
                </div>
            <?php endwhile; wp_reset_query();?>
            <div class="vote"><span style="font-weight: bold;">REVIEW</span> - Our Rating: <div class="vote<?php echo get_post_meta(get_the_ID(), 'bet_vote', true) ?>s"></div>&nbsp;&nbsp;(<?php echo get_post_meta(get_the_ID(), 'bet_vote', true) ?>/5)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;How do you rate this bookmaker?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Rating: <?php if(function_exists('the_ratings')) { the_ratings(); } ?></div>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>