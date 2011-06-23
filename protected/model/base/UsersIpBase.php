<?php
Doo::loadCore('db/DooModel');

class UsersIpBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var text
     */
    public $ip_address;

    /**
     * @var tinyint Max length is 4.
     */
    public $login_attempt;

    /**
     * @var enum 'active','inactive').
     */
    public $status;

    /**
     * @var datetime
     */
    public $last_login_date;

    /**
     * @var varchar Max length is 50.
     */
    public $login_as;

    public $_table = 'users_ip';
    public $_primarykey = 'id';
    public $_fields = array('id','ip_address','login_attempt','status','last_login_date','login_as');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'ip_address' => array(
                        array( 'notnull' ),
                ),

                'login_attempt' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'status' => array(
                        array( 'notnull' ),
                ),

                'last_login_date' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'login_as' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                )
            );
    }

}