<?php 

namespace App\Models;

class Cliente{

	public $cpfcliente;
	public $nomecliente;
	public $emailcliente;
	public $telefonecliente;

	function __construct($array=null){
		// parent::__construct();
		// $this->display->set_name("cpfcliente","CPF");
		// $this->set_primary_key("");
		if($array != null){
			$this->cpfcliente = $array['cpfcliente'];
			$this->nomecliente = $array['nomecliente'];
			$this->emailcliente = $array['emailcliente'];
			$this->telefonecliente = $array['telefonecliente'];
		}
	}
}

 ?>