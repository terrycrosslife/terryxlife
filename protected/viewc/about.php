<?php $this->renderc('template/head-start'); ?>
<title>TerryX Home</title>
<link rel="stylesheet" href="global/css/green_form.css" type="text/css" media="screen" />
<?php $this->renderc('template/head-end'); ?>
<?php $this->renderc($data['dock']); ?>
<div id="container">
  <div id="content">
    <div id="progress"></div>
    <div id="hook_error"></div>
    <form id="login-form" class="green-form" action="login">
      <fieldset>
        <h1>X Login</h1>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="validate[required]" />
        <br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="validate[required]" />
        <br>
        <input type="submit" value="Login" /> &nbsp;or <a href="#" class="bold">Join the X life</a>
      </fieldset>
    </form>


				Welcome to my website
  </div>
</div>

<div id="sidebar">

  <div class="content">
    This is side content

  </div>
</div>

<?php $this->renderc('template/footer'); ?>
<script type="text/javascript">

  function beforeCall(){
    $('#progress').show();
    return true;
  }

  function ajaxCallback(status, form, json){
    $('#hook-error').html('');

    if(json && json.is_logged_in === false){
      jAlert(json.message, 'Invalid Login');

    } else if(json.is_logged_in === true) {
      window.location = json.role;
    }

    else{ alert('Connection error. Please refresh the page.')}
  }
  $(function(){
    getNavDock();
    jQuery("#login-form").validationEngine({
      ajaxFormValidation: true,
      onBeforeAjaxFormValidation: beforeCall,
      onAjaxFormComplete: ajaxCallback
    });
    $('#loader').remove();
  });

</script>
</body>
</html>
