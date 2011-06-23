<?php

class MyController extends DooController {
    
    function testDb(){
        //This returns an array of user objects
//        Doo::db()->find('Users');
        
        //Or this syntax
//        $this->db()->find('Users');

        //You can create a User object
        Doo::loadModel('Users');
        $user = new Users;
        $user->username = 'terryx';

        //The result is A user object
       $username = array('select'=>'username, password', 'limit'=>1);
     $d= $this->db()->find( $user, $username );
//        $d = $this->db()->fetchAll('SELECT username FROM users WHERE username ="$username"');
     $data =$d;
       print_r($data);
   
    }

}
?>
