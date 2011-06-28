<?php

$acl['super_admin']['allow'] = array('SuperAdminController' => '*',
    'ArticleController' => '*');

$acl['inactive']['failRoute'] = array('ErrorController' => array('banUser'));
?>
