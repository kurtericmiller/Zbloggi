<?php
class View_Helper_GetMenu extends Zend_View_Helper_Abstract
{
  public function getMenu($menu)
  {
    $mm = new Local_Domain_Mappers_MenuMapper();
    $options['where'] = 'menu = "' . $menu . '"';
    $options['sort'] = 'ordering asc';
    $mc = $mm->findAll($options);
    echo '<div class="nav ' . $menu . 'menu">';
    foreach ($mc as $m) {
      echo '<a href="' . $m->get('link') . '">' . $m->get('title') . '</a>';
    }
    echo "</div>";
  }
}
