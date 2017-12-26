<?php get_header(); ?>
<div class="main">
    <h1><?php bloginfo('sitename') ?></h1>
    <div class="content">
        <div class="left">
            <?php get_sidebar(); ?>
        </div>
        <div class="right">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $loop = new WP_Query(
                    array(
                'post_type' => 'bets',
                'post_per_page' => -1,
//                'orderby' => 'title',
                'order' => 'ASC',
                'paged' => $paged
                    )
            );
            while ($loop->have_posts()) : $loop->the_post();
            ?>
            <div class="row">
                <div class="betinfo">
                    <h3><?php the_title(); ?></h3>
                    <div class="betdes">
                        <?php echo get_post_meta(get_the_ID(), 'bet_des' , true) ?>
                    </div>
                </div>
                <div class="betlogo">
                    <a class="more-bet" href="<?php the_permalink(); ?>">MORE INFO</a>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_post_meta(get_the_ID(), 'bet_logo' , true) ?>" />
                    </a>
                    <div class="vote-home">
                    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
                    </div>
                </div>
                <div class="betbtn">
                    <a href="<?php echo get_post_meta(get_the_ID(), 'bet_link' , true) ?>"></a>
                    <!--<a href="http://goo.gl/QFwoYu"></a>-->
                </div>
            </div>
            <?php endwhile; ?>

        </div>
    </div>
</div>
<?php get_footer(); ?>