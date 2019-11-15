<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" type="text/css" href="CERIcar/layout/style.css">
       <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
      <script type="text/javascript">
      $(document).ready(function(){

          $("#bandeau").animate({
            marginBottom: "0px",
          },500);

          $("#fermer").click(function(){      
              $('#bandeau').animate({ 
                marginBottom: "-50px"
              },500);
          });

      });
      </script>
    <title>
     Ton appli !
    </title>
   
  </head>

  <body>
    <h2>Super c'est ton appli ! </h2>
    <?php if($context->getSessionAttribute('user_id')): ?>
	<?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
     <?php endif; ?>

    <div id="page">
      <div id="bandeau">
        <?php
        if($context->error)
          echo 'Erreur : ' . $context->error;
        else if($context->action != NULL) 
          echo 'Action demandée : ' . $context->action;
        else
          echo 'Action demandée : ' . $action;
        ?>
        <div id="fermer">&#10006;</div>
      </div>
      <?php if($context->error): ?>
      	<div id="flash_error" class="error">
        	<?php echo " $context->error !!!!!" ?>
      	</div>
      <?php endif; ?>
      <div id="page_maincontent">	
      	<?php include($template_view); ?>
      </div>
    </div>
      


  </body>

</html>
