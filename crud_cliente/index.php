<?php 

spl_autoload_register(
	function($class){
		include_once "$class.php";
	}
);


use App\App;

session_start();

try{
	$app = new App();
	$app->run();
} catch(\Exception $e){
	
}

?>