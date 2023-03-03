<?php

/*
Plugin Name: Menu Helper
Plugin URI: https://menu_helper.com/
Description: Ceci est mon premier plugin
Author: Nous
Version: 1.0
Author URI: http://bonjour.com/
*/

include 'db.php';

function my_admin_menu()
{
    add_theme_page('Menu Helper', 'Menu Helper', 'edit_pages', 'menuHelper.php', 'myplguin_admin_page', 3);
}

function myplguin_admin_page()
{
?>
    <div class="wrap">
        <h2>Bienvenue sur notre plugin</h2>
    </div>
    <div class="row">
        <form id="add-item">
            <ul>
                <?php all_pages() ?>
            </ul>
            <input type="checkbox" id="select-all" name="all">
            <label for="select-all">Selected all</label>
            <button type="submit">Add Item</button>
        </form>

        <hr />

        <div class="dd" id="nestable">
            <?php
            $html_menu = menuTree();
            echo (empty($html_menu)) ? '<ol class="dd-list"></li></ol>' : $html_menu;
            ?>

            <div class="btn">
                <form id="sup">
                    <button class="is-empty sup">Vider le menu</button>
                </form>
                <form id="add-menu" method="post">
                    <input type="hidden" id="nestable-output" name="menu">
                    <button type="submit" class="is-empty sup">Save Menu</button>
                </form>
            </div>
            <div id="result"></div>
        </div>
    </div>

<?php
    wp_enqueue_style('styles_css', plugins_url('css/style.css', __FILE__), array());
    wp_enqueue_style('stylesJqu_css', plugins_url('css/jquery.nestable.css', __FILE__), array());
    wp_enqueue_script('script_js', plugins_url('js/script.js', __FILE__), array());
    wp_enqueue_script('scriptjq_js', plugins_url('js/jquery-3.4.1.min.js', __FILE__), array("jquery"));
    wp_enqueue_script('scriptjq2_js', plugins_url('js/jquery.nestable.js', __FILE__), array("jquery"));
}

function all_pages()
{
    $pages = get_pages();
    foreach ($pages as $page) {
        $li = '<li>
                <input type="checkbox" class="page" id="' . $page->ID . '" name="' . $page->post_title . '" data-url="' . get_permalink($page->ID) . '">' .
            '<label for="' . $page->ID . '">';
        $li .= $page->post_title;
        $li .= '</label></li>';
        echo $li;
    }
}

function renderMenuItem($id, $label, $url)
{
    return '<li class="dd-item dd3-item" data-id="' . $id . '" data-label="' . $label . '" data-url="' . $url . '">' .
        '<div class="dd-handle dd3-handle" > Drag</div>' .
        '<div class="dd3-content"><span>' . $label . '</span>' .
        '<div class="item-edit">Edit</div>' .
        '</div>' .
        '<div class="item-settings d-none">' .
        '<p><label for="">Navigation Label<br><input type="text" name="navigation_label" value="' . $label . '"></label></p>' .
        '<p><label for="">Navigation Url<br><input type="text" name="navigation_url" value="' . $url . '"></label></p>' .
        '<p><a class="item-delete" href="javascript:;">Remove</a> |' .
        '<a class="item-close" href="javascript:;">Close</a></p>' .
        '</div>';
}

function menuTree($parent_id = 0)
{
    global $db;
    $items = '';
    $query = $db->query("SELECT * FROM menu WHERE parent_id = ? ORDER BY id_menu ASC", $parent_id);
    if ($query->numRows() > 0) {
        $items .= '<ol class="dd-list">';
        $result = $query->fetchAll();
        foreach ($result as $row) {
            $items .= renderMenuItem($row['id_menu'], $row['label_menu'], $row['url_menu']);
            $items .= menuTree($row['id_menu']);
            $items .= '</li>';
        }
        $items .= '</ol>';
    }
    return $items;
}

add_action('admin_menu', 'my_admin_menu');
?>