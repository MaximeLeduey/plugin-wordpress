<?php
/*
Plugin Name: Menu Helper
Plugin URI: http://gestionplugin.test/
Description: This is a test
Author: Nous
Version: 1.1.0
Author URI: http://mon-siteweb.com/
*/

function my_admin_menu()
{
  add_theme_page('Menu Helper', 'Menu Helper', 'edit_pages', 'menuHelper.php', 'myplguin_admin_page', 3);
  wp_enqueue_style('styles_css', plugins_url('styles.css', __FILE__), array());
}

function myplguin_admin_page()
{
?>
  <div class="wrap">
    <h2>Bienvenue dans mon plugin</h2>
  </div>
  <div class="container">
    <div class="container_pages">
      <ul class="pages">
        <?php
        all_pages();
        ?>
      </ul>
      <input type="checkbox" id="select-all">
      <label for="select-all">Selected all</label>

      <button>Ajouter au menu</button>
    </div>
    <div class="container_menu">
      bonjour
    </div>
  </div>
<?php
  wp_enqueue_script('script_js', plugins_url('script.js', __FILE__), array());
}

function all_pages()
{
  $pages = get_pages();
  foreach ($pages as $page) {
    $li = '<li>
      <input type="checkbox" class="page" id="' . $page->ID . '" name="' . $page->ID . '">
      <label for="' . $page->ID . '">';
    $li .= $page->post_title;
    $li .= '</label></li>';
    echo $li;
  }
}



// Now we set that function up to execute when the admin_notices action is called.
if (is_admin()) { // admin actions
  add_action('admin_menu', 'my_admin_menu');
}
