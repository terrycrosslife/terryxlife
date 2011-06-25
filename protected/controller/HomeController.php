<?php

class HomeController extends DooController {

  public function beforeRun() {
    session_start();
  }

  private function check_role() {
    if (isset($_SESSION['user']) && $_SESSION['user']['status'] === 'active') {
      if ($_SESSION['user']['role'] === 'super_admin') {
       $data['dock'] = 'template/super-dock';
      }
      if ($_SESSION['user']['role'] === 'admin'){
        $data['dock'] = 'template/admin-dock';
      }
      if($_SESSION['user']['role'] === 'normal'){
        $data['dock'] = 'template/normal-dock';
      }
    } else {
       $data['dock'] = 'template/visitor-dock';
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
