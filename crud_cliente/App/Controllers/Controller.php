<?php 

namespace App\Controllers;

use App\Lib\Util;
class Controller{
	protected $app;
	protected $title;
	protected $primary;

	public function __construct($app){
		$this->app = $app;
	}

	public function render($view, $item=null){
		$title = $this->title;
		$primary = $this->primary;
		echo "<!DOCTYPE html><html lang=\"pt-br\">";
		echo "<!-- header -->";
		require_once PATH.'/App/Views/layouts/header.php';
		echo "<!-- body -->";
		if(!$view){
			require_once PATH.'/App/Views/layouts/body.php';
		} else {
			require_once PATH.'/App/Views/'.$view.".php";
			//echo $view;
		}
		echo "</html>";
	}
}

 ?>