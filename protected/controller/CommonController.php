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
  
  public function xss($str, $striptags=true){
        if($striptags){
            $str = strip_tags($str);
        }

        if(!isset(Doo::conf()->xssFilter)){
            Doo::loadClass('htmlpurifier/library/HTMLPurifier.auto');
            $purifyconfig = HTMLPurifier_Config::createDefault();
            $purifyconfig->set('Core.Encoding', 'UTF-8');
            $purifier = new HTMLPurifier($purifyconfig);
            Doo::conf()->xssFilter = $purifier;
            $str = htmlentities($str, ENT_COMPAT, 'UTF-8');
            return str_replace('&amp;', '&', $purifier->purify($str));
        }

        $str = htmlentities($str, ENT_COMPAT, 'UTF-8');
        return str_replace('&amp;', '&', Doo::conf()->xssFilter->purify($str));
    }
}

?>
