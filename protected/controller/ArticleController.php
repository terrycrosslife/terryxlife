<?php

class ArticleController extends CommonController {

  public function beforeRun($resource, $action) {

    session_start();

//    if (isset($_SESSION['user'])) {
//      if ($_SESSION['user']['role'] !== 'super_admin') {
//        $this->renderc('http://terryxlife.com/');
//      }
//    } else {
//
//      return Doo::conf()->APP_URL;
//    }

    $role = (isset($_SESSION['user']['role'])) ? $_SESSION['user']['role'] : 'visitor';

    if ($role != 'visitor') {
      if ($_SESSION['user']['status'] != 'active') {
        $role = 'inactive';
      }
    }

    $rs = $this->acl()->process($role, $resource, $action);
    return $rs;
  }

  public function manageArticlePage() {
    $menu = self::assignMenu();
    $this->renderc('article/manage_article', $menu);
  }

  public function createArticle() {
//    $data = 'ok324234234234234';
    print_r($_POST['article_name']);
    exit;

    $this->toJSON($_POST['article_name']);
//    print_r($data); exit;
  }

}

?>
