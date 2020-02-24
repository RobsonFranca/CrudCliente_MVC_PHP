<?php 

namespace App\Lib;

class Util{
	private $url; 
	private $baseUrl; 

	//public renameProperty($name, $rename){
	//	array_push($rename, {"name":$name, "rename":$name});
	//}

	public function getProperty($class){
		$retorno = array();
		$property = get_object_vars($class);
		foreach ($property as $key => $value) {
			$name = strtolower($key);
			array_push($retorno, [
				"name"=>strtoupper(str_replace($this->get_name_class($class), "", $key)),
				"property"=>$key,
				"value"=>$value
			]);
		}
		return $retorno;
	}

	public function get_name_class($class){
		if(is_array($class)){
			$class = $class[0];
		}
		$aux = explode("\\",get_class($class));
		$name = $aux[count($aux)-1];
		return strtolower($name);
	}

	public function getBase(){
		if($this->baseUrl != null){
			return $this->baseUrl;
		}

		$startUrl = strlen($_SERVER["DOCUMENT_ROOT"]);
		$excludeUrl = substr($_SERVER["SCRIPT_FILENAME"], $startUrl, -9);
		if($excludeUrl[0] == "/"){
			$this->baseUrl = $excludeUrl;
		} else {
			$this->baseUrl = "/".$excludeUrl;
		}

		return $this->baseUrl;
	}

	public function redirect($view){
		header("Location: ".$view);
	}
}

 ?>