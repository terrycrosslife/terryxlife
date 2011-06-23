<?php

class ValidateController extends DooController {

	public function checkUsername() {

		$validateValue = $_GET['fieldValue'];
		$validateId = $_GET['fieldId'];

		$rs = $this->db()->find('Users', array(
					'select' => 'username',
					'where' => 'username = ?',
					'param' => array($validateValue)
				));

		$arrayToJs = array();
		$arrayToJs[0] = $validateId;

		if (!$rs) {
			$arrayToJs[1] = true;   // RETURN TRUE
			$this->toJSON($arrayToJs, true);
		} else {
			$arrayToJs[1] = false;   // RETURN FALSE
			$this->toJSON($arrayToJs, true);
		}
	}

	public function checkEmail() {

		$rs = $this->db()->getOne('Users', array('select' => 'email'));

		if ($rs->email === $_GET['email']) {

			$msg = array('Email address is already registered');
			$this->toJSON($msg[0], true);
		} else {
			$msg = array('&nbsp');
			$this->toJSON($msg[0], true);
		}
	}

}

?>
