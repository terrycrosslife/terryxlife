<?php

class LoginController extends DooController {

	//set auto login cookie for 1 year
	protected function setRememberMe($cookie_user, $cookie_pass) {
		setcookie('lfshacksuser', $cookie_user, time() + 31536000, '/', $_SERVER['HTTP_HOST'], true);
		setcookie('lfshackspwd', $cookie_pass, time() + 31536000, '/', $_SERVER['HTTP_HOST'], true);
	}

	public function login() {
		if (isset($_POST['username']) && isset($_POST['password'])) {

			$username = trim(htmlentities($_POST['username']));
			$password = trim(htmlentities($_POST['password']));

			if (empty($username) || empty($password)) {

				return 400;
			}

			Doo::loadModel('Users');

			$u = new Users;
			$u->username = $username;
			$u->password = hash('sha256', $password);

			$rs = $this->db()->getOne($u, array('select' => 'id, username, type, status'));
			if ($rs && $rs->status == 'active') {
				session_start();
				$_SESSION['user'] = array(
					'id' => $rs->id,
					'username' => $rs->username,
					'role' => $rs->type,
					'status' => $rs->status,
					'is_logged_in' => true
				);

				$data = array('is_logged_in' => true, 'role' => $rs->type);

				//if remember me is selected
//				if ($_POST['remember']) {
//
//					setRememberMe();
//				}


				$this->toJSON($data, true);
			} elseif ($rs && $rs->status == 'inactive') {
				$this->toJSON("You are not allow to access. Please contact the administrator", true);
				return 400;
			} else {
				$this->toJSON("Invalid combination of username and password !", true);
				return 400;
			}
		}
	}

	public function logout() {
		session_start();
		unset($_SESSION['user']);
		session_destroy();
		return Doo::conf()->APP_URL;
	}

	public function passwordReset() {
		Doo::loadModel('Users');
		$u = new User;
	}

}

?>
