<?php

class FinanceController extends DooController {

  public function beforeRun() {
    session_start();

    if (isset($_SESSION['user'])) {
      if ($_SESSION['user']['role'] !== ('super_admin') && ('normal')) {
        return Doo::conf()->APP_URL;
      }
    } else {

      return Doo::conf()->APP_URL;
    }
  }

  public function index() {
    if ($_SESSION['user']['role'] === 'super_admin') {
      $data = 'super_sidebar';

      $this->renderc('user/finance', $data);
    }

    if ($_SESSION['user']['role'] === 'normal') {
      $data = 'user_sidebar';

      $this->renderc('user/finance', $data);
    }
  }

}

?>
