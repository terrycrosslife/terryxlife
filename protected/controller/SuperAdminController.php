<?php

class SuperAdminController extends DooController {

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

  if($role != 'visitor'){
			if($_SESSION['user']['status'] != 'active'){
              $role = 'inactive';
            }
		}
     $rs = $this->acl()->process($role, $resource, $action);
      return $rs;
  }

  public function index() {

    Doo::loadModel('Tag');
    $t = new Tag();

    $data['tag'] = $t->find();

    $data['menu'] = 'template/super_menu';
 
    $this->renderc('super_admin/index', $data);
  }

  public function createUserPage() {

    $this->renderc('super_admin/manage_user');
  }

  public function manageUserPage() {

    $this->renderc('super_admin/manage_user');
  }

  public function createUser() {
    Doo::loadCore('helper/DooValidator');
    $filter_user_id = trim(intval($_POST['user_id']));

    //manage user procedure
    if (!empty($filter_user_id) && $filter_user_id > 0) {

      $rules = array(
          'user_type' => array('required', 'must not empty'),
          'firstname' => array('required', 'must not empty'),
          'lastname' => array('required', 'must not empty'),
          'email' => array('email')
      );
      $v = new DooValidator();
      $v->checkMode = DooValidator::CHECK_SKIP;
      $err = $v->validate($_POST, $rules);
      if ($err) {
        $err_msg = array('failed');
        $this->toJSON($err_msg, true);
        return 400;
      } else {
        $user = array(
            'id' => $filter_user_id,
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'type' => $_POST['user_type'],
            'status' => 'active'
        );
        Doo::loadModel('Users');
        $u = new Users($user);
        $u->update();
        $this->toJSON(array('User is updated', 'Update Success'), true);
        return 200;

      }
    }

    //create new user instead if id is empty
    else {
      $filter_username = trim(htmlentities($_POST['username']));
      $filter_password = trim(htmlentities($_POST['password']));
      $filter_pconfirm = trim(htmlentities($_POST['password_confirm']));
      //must not empty and not less than 21 characters
      if (empty($filter_username) && strlen($filter_username) > 21) {
        return 400;
      }

      //password and password confirm must equal
      if ($filter_password != $filter_pconfirm) {
        return 400;
      }

      //check if username exist in database
      $rs = $this->db()->find('Users', array('select' => 'username'));
      foreach ($rs as $r) {
        if ($r->username == $filter_username) {
          return 400;
        }
      }

      //define other field rules to be stored in database
      $rules = array(
          'user_type' => array('required', 'must not empty'),
          'password' => array(
              array('minlength', 6),
              array('maxlength', 15)
          ),
          'firstname' => array('required', 'must not empty'),
          'lastname' => array('required', 'must not empty'),
          'email' => array('email')
      );

      $v = new DooValidator();
      $v->checkMode = DooValidator::CHECK_SKIP;

      $err = $v->validate($_POST, $rules);
      if ($err) {
        $err_msg = array('failed');
        $this->toJSON($err_msg, true);
        return 400;
      } else {
        $user = array(
            'username' => $filter_username,
            'password' => hash('sha256', $filter_password),
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'type' => $_POST['user_type'],
            'status' => 'active'
        );

        Doo::loadModel('Users');

        $u = new Users($user);
        $last_insert_id = $u->insert();

        //send email confirmation

        Doo::loadClass('PHPMailer/class.phpmailer');
        Doo::loadClass('PHPMailer/class.smtp');

        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->Host = "nsv27.dnshostmaster.net";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = "terryxli";
        $mail->Password = "kVZvb182x9";

        $mail->FromName = 'Customer Support';
        $mail->From = 'terryxlife@gmail.com';
        $mail->AddAddress($_POST['email'], $_POST['firstname'] . "" . $_POST['lastname']);
        $mail->Subject = 'Login credential';

        $url = Doo::conf()->APP_URL;
        $mail->Body = <<<EMAILBODY
Welcome to Terry X Club. Your account has been created successfully.

Login Information
-------------------------------------------------------
Dear {$u->firstname} {$u->lastname},

Username: {$u->username}
Password: {$_POST['password']}

To login please go to {$url}


Regards,
-------------------
Customer Support
terryxlife.com;

EMAILBODY;

        $mail->send();
        $this->toJSON(array('User is created successfully', 'Create success'), true);
        return 201;
      }
    }
  }

  public function getUserList() {
    $rs = $this->db()->find('Users', array('select' => 'id, username', 'asc' => 'username'));
    $this->toJSON($rs, true, true);
  }

  public function getOneUser() {
    if (!$this->params['id'] || intval($this->params['id']) < 1) {
      return 404;
    } else {

      $rs = $this->db()->find('Users', array(
                  'limit' => 1,
                  'where' => 'id = ?',
                  'param' => array($this->params['id'])
              ));

      if ($rs) {
        $data = array(
            $rs->id,
            $rs->username,
            $rs->firstname,
            $rs->lastname,
            $rs->email,
            $rs->status,
            $rs->type);
        $this->toJSON($data, true);
      } else {

        return 400;
      }
    }
  }

}

?>
