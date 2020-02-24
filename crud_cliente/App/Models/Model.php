<?php 
/* 
 * Teste para criar um modelo mais dinamico
 * Não usei...
 */
namespace App\Models;

class Model{
	private $primary_key;

	private $required;
	protected $display;

	public function __construct(){
		$this->required = new Required();
		$this->display = new Display();
	}

	protected function set_primary_key($name_property){
		//print_r(get_object_vars(new Model()));

		if(isset(get_object_vars($this)[$name_property])){
			$this->primary_key = $name_property;
		}
	}

	public function get_properties(){
		$retorno = get_object_vars($this);
		foreach (array_keys(get_object_vars(new Model())) as $value) {
		 	unset($retorno[$value]);
		}
		return $retorno;
	}

	public function get_properties_display(){
		$retorno = get_object_vars($this);
		foreach (array_keys(get_object_vars(new Model())) as $value) {
		 	unset($retorno[$value]);
		}
		return $retorno;
	}

	protected function display_name($name_property, $name_display){
		if($this->display==null)
			$this->display = new Display();
	}

}

class Display{
	private $names;

	public function set_name($name_property, $name_display){
		if($names == null)
			$this->names = array();

		$this->names[$name_property] = $name_display;
	}

	public function get_names();
}

class Required{
	public $error_message;
}


 ?>