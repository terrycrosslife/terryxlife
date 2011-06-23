<?php

class LoginController extends DooController {

    public function login() {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = trim(htmlentities($_POST['username']));
            $password = trim(htmlentities($_POST['password']));
            $data = array('is_logged_in' => false, 'message' => 'Combination of username or password is incorrect.');

            if (empty($username) || empty($password)) {

                $this->toJSON($data, true);
                exit;
            }

            Doo::loadModel('Users');

            $u = new Users;
            $u->username = $username;
            $u->password = hash('sha256', $password);

            $rs = $this->db()->getOne($u, array('select' => 'id, username, type, status'));
            if ($rs && $rs->status == 'active') {
                session_start();
               $_SESSION['user'] = array(
               'id'=>$rs->id,
               'username'=>$rs->username,
               'role'=>$rs->type,
               'status'=>$rs->status,
               'is_logged_in'=>true
           );

                $data = array('is_logged_in' => true, 'role'=>$rs->type);
                $this->toJSON($data, true);
            } else {
                $this->toJSON($data, true);
              
            }
        }

    }
    public function logout(){
		session_start();
		unset($_SESSION['user']);
		session_destroy();
		return Doo::conf()->APP_URL;
	}
  public function passwordReset(){
    Doo::loadModel('Users');
    $u = new User;
  }
}

?>
