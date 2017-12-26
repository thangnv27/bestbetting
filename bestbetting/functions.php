<?php
######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/bet_group.php';
include 'includes/betting.php';
//include 'includes/custom-user.php';
//include 'includes/shortcodes.php';
//include 'ajax.php';
if (is_admin()) {
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'theme-editor.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("my_theme_setup")) {

    function my_theme_setup() {
        ## Enable Links Manager (WP 3.5 or higher)
        add_filter('pre_option_link_manager_enabled', '__return_true');

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
        /* if (function_exists('add_image_size')) {
          add_image_size('thumbnail176', 176, 176, FALSE);
          } */

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'blogmenu' => 'Menu Blog',
        ));
    }

}

add_action('after_setup_theme', 'my_theme_setup');
/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("my_widgets_init")) {

    function my_widgets_init() {
        // Register Sidebar
        register_sidebar(array(
            'id' => __('sidebar'),
            'name' => __('Sidebar'),
            'before_widget' => '<div id="%1$s" class="box %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div><div class="widget-content">',
        ));
        register_sidebar(array(
            'id' => __('blog'),
            'name' => __('Blog'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

}

add_action('widgets_init', 'my_widgets_init');

/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'redirect_after_logout');

function redirect_after_logout() {
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect(get_option('siteurl'));
}
/* ----------------------------------------------------------------------------------- */
# Register menu location
/* ----------------------------------------------------------------------------------- */

function admin_add_custom_js() {
    ?>
    <script type="text/javascript">/* <![CDATA[ */
        jQuery(function($) {
            var area = new Array();

            $.each(area, function(index, id) {
                //tinyMCE.execCommand('mceAddControl', false, id);
                tinyMCE.init({
                    selector: "textarea#" + id,
                    height: 400
                });
                $("#newmeta-submit").click(function() {
                    tinyMCE.triggerSave();
                });
            });

            $(".submit input[type='submit']").click(function() {
                if (typeof tinyMCE != 'undefined') {
                    tinyMCE.triggerSave();
                }
            });


            var $tr_id = $('#tbl_pdc_att').find("tr").length - 1;
            $('#tr_add_btn').on('click', function(e) {
                ++$tr_id;

                e.preventDefault();
                var $cloned_tr = $('#tr_clone').clone(true);
                $cloned_tr.attr({
                    id: 'pdc_attrs_' + $tr_id
                }).removeAttr('style').find('#pdc_att_ip_name').attr({
                    id: "pdc_att_ip_name_" + $tr_id,
                    name: "pdc_attrs[" + $tr_id + "]"
                });

                $cloned_tr.find('#img_pdc_attrs').attr({
                    id: "img_pdc_att_ip_name_" + $tr_id
                });

                $cloned_tr.find('#btn_upload').attr({
                    onClick: "uploadProductChildIMG('pdc_att_ip_name_" + $tr_id + "')"
                });

                $cloned_tr.attr({
                    id: 'pdc_attrs_' + $tr_id
                }).find('#pdc_att_ip_value').attr({
                    id: "pdc_attr_value_" + $tr_id,
                    name: "pdc_attr_value[" + $tr_id + "]"
                }).css('display', 'block');

                $cloned_tr.insertBefore($('#tr_clone'));
            });

            $('.tr_remove').on('click', function(e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            });

        });
        /* ]]> */
    </script>
    <?php
}

add_action('admin_print_footer_scripts', 'admin_add_custom_js', 99);

function pre_get_image_url($url, $show = true) {
    if (trim($url) == "")
        $url = get_template_directory_uri() . "/images/no_image_available.jpg";
    if ($show)
        echo $url;
    else
        return $url;
}

/*
  add_filter('posts_where', 'title_like_posts_where');

  function title_like_posts_where($where){
  global $wpdb, $wp_query;
  if($wp_query->is_search){
  $where = str_replace("AND ((ppo_postmeta.meta_key =", "OR ((ppo_postmeta.meta_key =", $where);
  }
  return $where;
  }
 */

function get_attachment_id_from_src($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;
}

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
        show_admin_bar(false);
    }
}

#### EXTRA TAXONOMY
// remove the html filtering
remove_filter('pre_term_description', 'wp_filter_kses');
remove_filter('term_description', 'wp_kses_data');

add_filter('edit_tag_form_fields', 'taxonomy_description');

function taxonomy_description($tag) {
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'Taxonomy Description'); ?></label></th>
        <td>
            <?php
            $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description');
            wp_editor(html_entity_decode($tag->description, ENT_QUOTES, 'UTF-8'), 'taxonomy_description', $settings);
            ?>
            <br />
            <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
        </td>
    </tr>
    <?php
}

add_action('admin_head', 'remove_default_tag_description');

function remove_default_tag_description() {
    global $current_screen;
    if ($current_screen->id == 'edit-' . $current_screen->taxonomy) {
        ?>
        <script type="text/javascript">
            jQuery(function($) {
                $('textarea#description').closest('tr.form-field').remove();
            });
        </script>
        <?php
    }
}
