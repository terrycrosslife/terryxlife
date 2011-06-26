<?php

class HomeController extends DooController {

  public function beforeRun() {
    session_start();
  }

  private function check_role() {
    if (isset($_SESSION['user']) && $_SESSION['user']['status'] === 'active') {
      if ($_SESSION['user']['role'] === 'super_admin') {
       $data['menu'] = 'template/super-menu';
      }
      if ($_SESSION['user']['role'] === 'admin'){
        $data['menu'] = 'template/admin-menu';
      }
      if($_SESSION['user']['role'] === 'normal'){
        $data['menu'] = 'template/normal-menu';
      }
    } else {
       $data['menu'] = 'template/login-menu';
    }

    return $data;
  }

  public function index() {
    $data = self::check_role();
    $this->renderc('home', $data);
  }

  public function login() {
    $data = self::check_role();
    $this->renderc('login', $data);
  }

  public function contact() {
    $data = self::check_role();
    $this->renderc('contact', $data);
  }

  public function about() {
    $data = self::check_role();
    $this->renderc('about', $data);
  }

}

?>
