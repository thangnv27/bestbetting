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
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style_blog.css" />
        <?php wp_head() ?>
    </head>
    <body>
        <div id="page">


            <div id="header">
                <div id="headerimg">
                    <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
                    <div class="description"><?php bloginfo('description'); ?></div>
                </div>
            </div>
            <hr />
