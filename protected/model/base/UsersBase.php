<?php
Doo::loadCore('db/DooModel');

class UsersBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 50.
     */
    public $username;

    /**
     * @var varchar Max length is 100.
     */
    public $password;

    /**
     * @var varchar Max length is 50.
     */
    public $firstname;

    /**
     * @var varchar Max length is 50.
     */
    public $lastname;

    /**
     * @var varchar Max length is 50.
     */
    public $email;

    /**
     * @var enum 'normal','admin','super_admin').
     */
    public $type;

    /**
     * @var enum 'active','inactive').
     */
    public $status;

    public $_table = 'users';
    public $_primarykey = 'id';
    public $_fields = array('id','username','password','firstname','lastname','email','type','status');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'username' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'password' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'firstname' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'lastname' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'email' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'type' => array(
                        array( 'notnull' ),
                ),

                'status' => array(
                        array( 'notnull' ),
                )
            );
    }

}