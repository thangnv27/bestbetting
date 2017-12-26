<?php
/*
  Template Name: Blog
 */
get_header('blog');
?>
<div id="content" class="narrowcolumn">

    <?php
    $args = array(
        'posts_per_page' => -1,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post_type' => 'post',
        'post_status' => 'publish'
    );
    $lastposts = get_posts($args);
    foreach ($lastposts as $post) :
        setup_postdata( $post ); ?>
        <?php
        if ($postindex > 0) {
            print "<center><img src='";
            bloginfo('stylesheet_directory');
            print "/images/blueskyseparator.png' width='174' height='40'></center>";
        } $postindex++
        ?>

        <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

            <div class="entry">
                <?php the_content('Read the rest of this entry &raquo;'); ?>
            </div>

            <p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
        </div>

    <?php endforeach;
    wp_reset_postdata();
    ?>

    <div class="navigation">
        <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
        <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
</div>

<?php get_sidebar('blog'); ?>
<?php get_footer('blog'); ?>

