<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" type="text/css" href="CERIcar/layout/style.css">
       
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
	  <div id="navBar">
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
        	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            	<span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="CERIcar.php?action=index">CERIcar</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
        	<ul class="nav navbar-nav navbar-right">
            	<li><a href="#" id="btnRechercher"><span class="glyphicon glyphicon-search"></span> Rechercher</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-plus"></span> Ajouter</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> S'inscrire</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Se connecter</a></li>
            </ul>
        </div>
    </div>
</nav>
	</div>
<div class="container" style="margin-top:50px">
	
    <div id="page">
	<h2>Super c'est ton appli ! </h2>
    <?php if($context->getSessionAttribute('user_id')): ?>
	<?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
     <?php endif; ?>
    </div>
    <div id="bandeau">
        <?php
        if($context->error)
          echo 'Erreur : ' . $context->error;
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
      	<?php //include($template_view); ?>
      	<?php
			  foreach($template_view as $view)
				  include($view);
      	?>
      </div>
 </div>

<script type="text/javascript">

var xhr;

$('#btnRechercher').click(makeRequest);

function processServerResponse(){
    if(xhr.readyState==4 && xhr.status==200){
        var data=xhr.responseText;
        alert(data);
        //losque la page a fini de chargé entièrement (toutes les vues)
        //~ $( document ).ready(function() {
            //~ //recuperer uniquement le nouveau contenu
            //~ var newContent=$($.parseHTML(data)).find('#rechercherVoyages').html();
            //~ //supprime contenu div actuelle
            //~ $('#printVoyagesByDepartArriveeSuccess').children().remove();
            //~ //ajouter les nouvelles lignes à la table actuelle
            //~ $('#printVoyagesByDepartArriveeSuccess').html(newContent);
        //~ });
    }
}

  function makeRequest(){
    if(window.ActiveXObject){
        try{
            xhr=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            xhr=new ActiveXObject("MSXML2.XMLHTTP");
        }
    }
    else if(window.XMLHttpRequest){
        xhr=new XMLHttpRequest();
    }
    xhr.onreadystatechange=processServerResponse;
    xhr.open("GET","CERIcar.php?action=rechercherVoyages",true);
    xhr.send(null);
    return false;
}
</script>
</body>

</html>
