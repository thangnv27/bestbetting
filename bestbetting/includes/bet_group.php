<?php

/**
 * Bet Group Menu Page
 */
# Custom bets post type
add_action('init', 'create_bets_post_type');

function create_bets_post_type() {
    register_post_type('bets', array(
        'labels' => array(
            'name' => __('Bet Group'),
            'singular_name' => __('Bet Group'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Bet Group'),
            'new_item' => __('New Bet Group'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Bet Group'),
            'view' => __('View Bet Group'),
            'view_item' => __('View Bet Group'),
            'search_items' => __('Search Bet Group'),
            'not_found' => __('No Bet Group found'),
            'not_found_in_trash' => __('No Bet Group found in trash'),
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
        'rewrite' => array('slug' => 'bets', 'with_front' => false),
        'can_export' => true,
        'description' => __('Bet Group description here.')
    ));
}

# bets meta box
$bets_meta_box = array(
    'id' => 'bets-meta-box',
    'title' => 'Thông tin chung',
    'page' => 'bets',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
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
            'name' => 'Review',
            'desc' => 'Số từ 1 đến 5 tương ứng với 5*',
            'id' => 'bet_vote',
            'type' => 'text',
            'std' => '5',
        ),
        array(
            'name' => 'Mô tả ngắn',
            'desc' => 'Hiển thị ở danh sách',
            'id' => 'bet_des',
            'type' => 'textarea',
            'std' => '',
            'editor' => array(
                "wyswig" => true,
                "rows" => 10,
            ),
        ),
        ));

// Add bets meta box
if (is_admin()) {
    add_action('admin_menu', 'bets_add_box');
    add_action('save_post', 'bets_add_box');
    add_action('save_post', 'bets_save_data');
}

function bets_add_box() {
    global $bets_meta_box;
    add_meta_box($bets_meta_box['id'], $bets_meta_box['title'], 'bets_show_box', $bets_meta_box['page'], $bets_meta_box['context'], $bets_meta_box['priority']);
}

// Callback function to show fields in bets meta box
function bets_show_box() {
    // Use nonce for verification
    global $bets_meta_box, $post;

    custom_output_meta_box($bets_meta_box, $post);
}

// Save data from bets meta box
function bets_save_data($post_id) {
    global $bets_meta_box;
    custom_save_meta_box($bets_meta_box, $post_id);
}
