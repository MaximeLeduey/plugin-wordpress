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
  add_theme_page('Menu Helper', 'Menu Helper', 'manage_options', 'menuHelper.php', 'myplguin_admin_page', 3);

	$my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/script.js' ));
	wp_enqueue_script( 'script_js', plugins_url( 'js/script.js', __FILE__ ), array(), $my_js_ver );
}

function myplguin_admin_page()
{
?>
  <div class="wrap">
    <h2>Bienvenue dans mon plugin</h2>
  </div>
  <ul>
    <?php
    all_pages();
    ?>
  </ul>
<?php
}

function all_pages()
{
  $pages = get_pages();
  foreach ($pages as $page) {
    $li = '<li class="page">
      <input type="checkbox" id="' . $page->ID . '" name="' . $page->ID . '">
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
