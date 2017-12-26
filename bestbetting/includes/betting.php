<?php

/**
 * Betting Menu Page
 */
# Custom betting post type
add_action('init', 'create_betting_post_type');

function create_betting_post_type() {
    register_post_type('betting', array(
        'labels' => array(
            'name' => __('Bettings'),
            'singular_name' => __('Bettings'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Betting'),
            'new_item' => __('New Betting'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Betting'),
            'view' => __('View Betting'),
            'view_item' => __('View Betting'),
            'search_items' => __('Search Betting'),
            'not_found' => __('No Betting found'),
            'not_found_in_trash' => __('No Betting found in trash'),
        ),
        'public' => true,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => false,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title', 'editor', 'author', 'thumbnail',
        //'custom-fields', 'excerpt', 'comments', 
        ),
        'rewrite' => array('slug' => 'betting', 'with_front' => false),
        'can_export' => true,
        'description' => __('Betting description here.')
    ));
}

# Custom betting taxonomies
//add_action('init', 'create_betting_taxonomies');
//
//function create_betting_taxonomies() {
//    register_taxonomy('betting_category', 'betting', array(
//        'hierarchical' => true,
//        'labels' => array(
//            'name' => __('Betting Categories'),
//            'singular_name' => __('Betting Categories'),
//            'add_new' => __('Add New'),
//            'add_new_item' => __('Add New Category'),
//            'new_item' => __('New Category'),
//            'search_items' => __('Search Categories'),
//        ),
//    ));
//}

function bet_parent() {
    $arr = array();
    $bets = new WP_Query(
            array(
        'post_type' => 'bets',
        'posts_per_page' => -1
    ));
    while ($bets->have_posts()) : $bets->the_post();
        $arr[get_the_ID()] = get_the_title();
    endwhile;
    wp_reset_query();
    return $arr;
}
# betting meta box
$betting_meta_box = array(
    'id' => 'betting-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'betting',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Nhóm bet',
            'desc' => '',
            'id' => 'bet_group',
            'type' => 'select',
            'std' => '',
            'options' => bet_parent(),
        ),
        array(
            'name' => 'Ảnh - Logo nhà Bet',
            'desc' => 'Có thể dán URL ảnh vào đây hoặc bấm nút Upload để chọn ảnh từ thư viện.',
            'id' => 'bet_logo',
            'type' => 'text',
            'std' => '',
            'btn' => true,
        ),
        array(
            'name' => 'Link Clainm now',
            'desc' => '',
            'id' => 'bet_link',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Kiểu Bet',
            'desc' => 'VD: Sportsbook, Casino, hoặc Game...',
            'id' => 'bet_type',
            'type' => 'text',
            'std' => '',
        ),
        ));

// Add betting meta box
if (is_admin()) {
    add_action('admin_menu', 'betting_add_box');
    add_action('save_post', 'betting_add_box');
    add_action('save_post', 'betting_save_data');
}

function betting_add_box() {
    global $betting_meta_box;
    add_meta_box($betting_meta_box['id'], $betting_meta_box['title'], 'betting_show_box', $betting_meta_box['page'], $betting_meta_box['context'], $betting_meta_box['priority']);
}

// Callback function to show fields in betting meta box
function betting_show_box() {
    // Use nonce for verification
    global $betting_meta_box, $post;

    custom_output_meta_box($betting_meta_box, $post);
}

// Save data from betting meta box
function betting_save_data($post_id) {
    global $betting_meta_box;
    custom_save_meta_box($betting_meta_box, $post_id);
}
