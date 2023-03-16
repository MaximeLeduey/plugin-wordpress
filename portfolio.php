<?php
/*
Plugin Name: Portfolio
Plugin URI: http://gestionplugin.test/
Description: Créer ton portfolio facilement et rapidement avec ce plugin
Author: Bienfait Alexandre
Version: 1.0.0
Author URI: http://mon-siteweb.com/
*/

function my_admin_menu()
{
  add_menu_page('Portfolio', 'Portfolio', 'edit_pages', 'portfolio.php', 'admin_page_content', 'dashicons-id-alt');
  wp_enqueue_style('styles_css', plugins_url('css/style.css', __FILE__), array());
}

function admin_page_content()
{
?>
  <div class="wrap">
    <h2>Bienvenue sur la page configuration de votre portfolio !</h2>
  </div>
<?php
  wp_enqueue_script('script_js', plugins_url('js/script.js', __FILE__), array());
}


add_action('admin_menu', 'my_admin_menu');