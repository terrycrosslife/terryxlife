<?php

class HomeController extends CommonController {

  public function beforeRun() {
//    Doo::loadController('CommonController');
    session_start();
  }

  public function index() {
    $data = self::assignMenu();
    $this->renderc('home', $data);
  }

  public function login() {
    $data = self::assignMenu();
    $this->renderc('login', $data);
  }

  public function article() {
    $data = self::assignMenu();
    $this->renderc('article', $data);
  }

  public function contact() {
    $data = self::assignMenu();
    $this->renderc('contact', $data);
  }

  public function about() {
    $data = self::assignMenu();
    $this->renderc('about', $data);
  }
  
  public function testck(){
	  Doo::loadPlugin('CKEditor');
	
  }
}

?>
