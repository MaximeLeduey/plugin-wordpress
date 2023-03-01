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
  wp_enqueue_style('styles_css', plugins_url('css/style.css', __FILE__), array());
  wp_enqueue_style('stylesJqu_css', plugins_url('css/jquery.nestable.css', __FILE__), array());
}

function myplguin_admin_page()
{
?>
  <div class="wrap">
    <h2>Bienvenue dans mon plugin</h2>
  </div>
  <div class="row">
    <div class="column">
      <form id="add-item">
        <ul>
          <?php all_pages() ?>
        </ul>
        <input type="checkbox" id="select-all" name="all">
        <label for="select-all">Selected all</label>

        <button type="submit">Ajouter au menu</button>
      </form>
    </div>
    <div class="column dd" id="nestable">
      <?php
      page_menu();
      ?>
    </div>
  </div>
<?php
  wp_enqueue_script('script_js', plugins_url('js/script.js', __FILE__), array());
  wp_enqueue_script('scriptjq_js', plugins_url('js/jquery-3.4.1.min.js', __FILE__), array("jquery"));
  wp_enqueue_script('scriptjq2_js', plugins_url('js/jquery.nestable.js', __FILE__), array("jquery"));
}

function all_pages()
{
  $pages = get_pages();
  foreach ($pages as $page) {
    $li = '<li>
      <input type="checkbox" class="page" id="' . $page->ID . '" name="' . $page->post_title . '">
      <label for="' . $page->ID . '">';
    $li .= $page->post_title;
    $li .= '</label></li>';
    echo $li;
  }
}

function page_menu()
{
  $pages = get_pages();
?>
  <ol class="dd-list">
    </li>
  </ol>
<?php
}

function menuItem($id, $label)
{
?>
  <li class="dd-item dd3-item" data-id="<?= $id ?>" data-label="<?= $label ?>">
    <div class="dd-handle dd3-handle">
      Drag
    </div>
    <div class="dd3-content">
      <span><?= $label ?></span>
      <div class="item-edit">Edit</div>
    </div>
    <div class="item-settings d-none">
      <p>
        <label for="">Titre de la navigation<br>
          <input type="text" name="navigation_label" value="<?= $label ?>">
        </label>
      </p>
      <p>
        <a class="item-delete" href="javascript:;">Retirer</a> | <a class="item-close" href="javascript:;">Annuler</a>
      </p>
    </div>
  <?php
}


add_action('admin_menu', 'my_admin_menu');
