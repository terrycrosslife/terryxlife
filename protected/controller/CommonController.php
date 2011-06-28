<?php

class CommonController extends DooController {

  protected static function assignMenu() {
    if (isset($_SESSION['user']) && $_SESSION['user']['status'] === 'active') {
      switch ($_SESSION['user']['role']) {
        case 'normal':
          $menu = 'template/normal_menu';
          break;
        case 'admin':
          $menu = 'template/admin_menu';
          break;
        case 'super_admin':
          $menu = 'template/super_menu';
          break;
      }
    } else {
      $menu = 'template/login-menu';
    }
    return $menu;
  }

}

?>
