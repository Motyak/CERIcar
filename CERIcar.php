<?php
//nom de l'application
$nameApp = "CERIcar";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
	$action =  $_REQUEST['action'];

require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

foreach(glob($nameApp.'/model/*.class.php') as $model)
	include_once $model ;

session_start();

$context = context::getInstance();
$context->init($nameApp);

$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}
//inclusion du layout qui va lui meme inclure le template view
elseif($view!=context::NONE)
{
	if(key_exists("json", $_REQUEST) && $_REQUEST['json']=='1'){
		if(is_array($context->res))
			echo json_encode($context->res);
	}
	else{
		$template_view=array($nameApp."/view/".$action.$view.".php");
		$subViews=glob($nameApp."/view/".$action."*-*.php");
		foreach($subViews as $sv)
			$template_view[]=$sv;
		include($nameApp."/layout/".$context->getLayout().".php");
	}
}

?>
