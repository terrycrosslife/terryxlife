<?php $this->renderc('template/head-start'); ?>
<title>TerryX Home</title>
<link rel="stylesheet" href="global/css/green_form.css" type="text/css" media="screen" />
<?php $this->renderc('template/head-end'); ?>
<?php $this->renderc('template/nav'); ?>

<div id="container" class="clearall">
  <div id="main-content">
    <div id="progress"></div>
    <?php $this->renderc($data['menu']); ?>
    <div class="content">
				Welcome to my website
    </div>
  </div><!-- end container-->


  <div id="side-content">

    <div class="content">
      This is side content

    </div>
  </div>
</div><!-- end container -->
<?php $this->renderc('template/footer'); ?>
<script type="text/javascript">

  function beforeCall(){
    $('#progress').show();
    return true;
  }

  function ajaxCallback(status, form, json){
    $('#progress').hide();

    if(status === true && json.is_logged_in === true) {
      window.location = json.role;
    }

    else{ jAlert('Connection error. Please refresh the page.');
      $('#progress').hide();
    }
  }
  $(function(){
    setLoader();
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
