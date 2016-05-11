<?php

//======================================================================
// Github Webhook
//======================================================================

/*
* This is a simple deployment webhook.
* Just copy this file into your server
* Use this file url(http://yoursite/github_webhook_deploy.php) as a webhook url into your github repo webhook settings.
*/

$LOCAL_ROOT = 'YOUR_FOLDER_PATH';//Replace this with server path
$json = file_get_contents('php://input');
$obj = json_decode($json);
if($obj->repository->full_name && $obj->repository->clone_url){


$FOLDER_PATH = $LOCAL_ROOT . $obj->repository->full_name;
$GIT_CLONE_URL = $obj->repository->clone_url;
$OWNER = $obj->repository->owner->name;
$OWNER_PATH = $LOCAL_ROOT . $OWNER;

echo "Owner folder path:- ";
echo $OWNER_PATH;
echo "\r\n";
echo "\r\n";

echo "Deploy script owner:- ";
echo get_current_user();
echo "\r\n";
echo "Deploy script executed as:- ";
echo shell_exec('whoami');
echo "\r\n";
echo "\r\n";

echo "Deployment path:- ";
echo $OWNER_PATH;
echo "\r\n";
echo "Git clone url :- ";
echo $GIT_CLONE_URL;
echo "\r\n";

echo "\r\n";
//Check if the directory already exists.
if(!is_dir($OWNER_PATH)){

	echo "owner dir not found...";
	echo "\r\n";
	echo "Creating owner dir...";
	echo "\r\n";

    //Directory does not exist, so lets create it.
    //mkdir($OWNER_PATH, 755, true);
    echo "mkdir {$OWNER_PATH}";
  	$output= shell_exec("mkdir -p {$OWNER_PATH}");
  	echo $output;
	echo "\r\n";

  	echo "Cloning repo...";
	// Clone fresh repo from github using desired local repo name and checkout the desired branch
	echo shell_exec("cd {$OWNER_PATH} && git clone {$GIT_CLONE_URL}");

}else{

	//Can be used incase you want to pull new changes
	// echo "Pull remote repo...";
	// echo "\r\n";
	// echo "inside {$FOLDER_PATH}";
	// echo "\r\n";
	// echo shell_exec("cd {$FOLDER_PATH} && git pull -f");

	//Use this incase you want to reclone the whole repo each time.
	echo "Owner directory found";
	echo shell_exec("rm -rf {$OWNER_PATH}");
	echo "Cloning repo...";
	echo shell_exec("cd {$OWNER_PATH} && git clone {$GIT_CLONE_URL}");

}
}else{
	echo "Invalid request..";
}

?>
