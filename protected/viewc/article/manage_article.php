<?php $this->renderc('template/head-start'); ?>
<link rel="stylesheet" href="global/css/green_form.css" type="text/css" media="screen" />
<link rel="stylesheet" href="global/css/jquery.cleditor.css" type="text/css" media="screen" />
<?php $this->renderc('template/head-end'); ?>
<?php $this->renderc('template/nav'); ?>
<div id="container">
  <div id="main-content">
    <div id="progress"></div>
    <?php $this->renderc($data); ?>
    <div class="content">
      <form id="manage-article-form" class="green-form" action="super_admin/create_user">

		  <label for="title" class="flat">Title</label>
		  <input type="text" id="title" name="title" class="title" />
		  <label for="content">Content</label>
		  <textarea id="content"></textarea>
<input type="submit" name="submit" value="Post" />
      </form>

    </div>

  </div>


    <div id="side-content">
		<div id="search-container">
			<form id="search-form">
				<input type="text" id="search" name="search" placeholder="Search" onkeyup="searchUser();" />
				<button type="submit" id="search-button" name="search-button"></button>
			</form>
			<div id="new" onclick="selectNew();">Write new</div>
		</div>
		<div id="search_result"> </div>
	</div>

  <?php $this->renderc('template/footer'); ?>
<script type="text/javascript" src="global/js/jquery.cleditor.min.js"></script>
 <script type="text/javascript">

    $(function(){
      
       $("#content").cleditor({
          width:        630,
          height:       300
        });
//      jQuery("#manage-user-form").validationEngine({
//        ajaxFormValidation: true,
//        onAjaxFormComplete: ajaxValidationCallback,
//        onBeforeAjaxFormValidation: beforeCall
//      });
      $('#loader').remove();


    }); //end document ready


  </script>
</body>
</html>
