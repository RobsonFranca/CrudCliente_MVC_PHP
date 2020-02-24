<?php 

namespace App;
/*
 * classe responsavel pelo site
 */
class App{

	// gerenciar controller escolhido
	private $controller;
	private $controllerName;
	private $controllerFile;

	// funcao da classe
	private $action;

	private $params;

	public function __construct(){
		// declarar constantes
		define('APP_HOST',$_SERVER['HTTP_HOST']);
		define('PATH',realpath('./'));

		$this->friendlyUrl();
	}

	public function run(){

		$n = new \App\Models\Cliente();

		//definir nome do controller
		if($this->controller){
			$this->controllerName = preg_replace('/[^a-zA-Z]/i', '', ucwords($this->controller).'Controller');
		} else {
			$this->controllerName = null;
		}

		$this->controllerFile = $this->controllerName.'.php';
		$this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action);

		// caso não tenha controller ou acao, entra no defalt
		if (!$this->controller || !$this->action){
			$this->controller = new \App\Controllers\ClienteController($this);
			$this->controller->index();

			return;
		}

		$noClass = "\\App\\Controllers\\".$this->controllerName;
		if(@class_exists($noClass)){
			@$oController = new $noClass($this);

			if(method_exists($oController, $this->action)){
				$oController->{$this->action}($this->params);
			} else {
				require_once PATH.'/App/Error/PageNotFound.php';
			}
		} else {
			require_once PATH.'/App/Error/PageNotFound.php';
		}
	}

	public function friendlyUrl(){

			//print_r($_GET);
		if(isset($_GET['url'])){
			$path = rtrim($_GET['url'],'/');//Remover ultima barra

			$path = filter_var($path, FILTER_SANITIZE_URL);//Limpar URL

			$path = explode('/', $path);

			$this->controller = $this->checkArray($path,0);
			$this->action = $this->checkArray($path,1);

			// Configura os parametros
			if($this->checkArray($path,2)){
				//REMOVE CONTROLLER E ACTION
				unset($path[0]);
				unset($path[1]);

				//PEGA TODOS VALORES DO ARRAY
				$this->params = array_values($path);
			}
		}
	}

	private function checkArray($array, $key){
		if(isset($array[$key]) && !empty($array[$key])){
			return $array[$key];
		}
		return null;
	} 
}


 ?>