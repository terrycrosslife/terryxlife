<?php $this->renderc('template/header'); ?>

<div id="navbar">
    <a href="#" class="active">Home</a>
    <a href="#">Contact</a>
    <a href="#">About</a>
    <a href="#">Resources</a>
    <a href="logout">Logout</a>
</div>
<div class="clear"></div>
</div>

<div id="wrapper">

<?php $this->renderc('template/'.$data); ?>
     <?php

echo 'success login';



?>
<?php $this->renderc('template/footer'); ?>