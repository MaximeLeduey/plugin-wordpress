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
  add_menu_page('My Top Level Menu Example', 'Menu Helper', 'manage_options', 'myplugin/myplugin-admin-page.php', 'myplguin_admin_page', 'dashicons-welcome-widgets-menus', 6);
}

function myplguin_admin_page()
{
?>
  <div class="wrap">
    <h2>Bienvenue dans mon plugin</h2>
  </div>
<?php
}

// Now we set that function up to execute when the admin_notices action is called.
if (is_admin()) { // admin actions
  add_action('admin_menu', 'my_admin_menu');
} else {
  // non-admin enqueues, actions, and filters
}

// // Now we set that function up to execute when the admin_notices action is called.
// add_action( 'admin_notices', 'bienvenue' );