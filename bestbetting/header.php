<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />
        <meta name="author" content="bestbetting.cc" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />

        <!--<meta name="viewport" content="initial-scale=1.0" />-->

        <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/common.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />

        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var no_image_src = themeUrl + "/images/no_image_available.jpg";
            var is_home = <?php echo is_home() ? 'true' : 'false'; ?>;
            var ajaxurl = siteUrl + '/wp-admin/admin-ajax.php';
        </script>
        <?php
        if (is_singular())
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body>
        <div id="container">
            <div class="header">
                <div class="logo">
                    <h2>BestBetting.cc</h2>
                </div>
                <div class="menu">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => '',
                        'container' => '',
                    ));
                    ?>
                </div>
            </div>

