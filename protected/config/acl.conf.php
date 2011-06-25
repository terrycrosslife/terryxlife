<?php

$acl['super_admin']['allow'] = array('SuperAdminController'=> '*');

$acl['inactive']['failRoute'] = array('ErrorController'=>array('banUser'));
?>
