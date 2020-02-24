<?php 

namespace App\Controllers;

use App\Repositories\ClienteRepository;
use App\Models\Cliente;
use App\Lib\Util;

class ClienteController extends Controller{

	private $Value;

	public function index($p = null){
		$this->title = "Cliente - List";
		$db = new ClienteRepository;
		$lista = $db->select();
		$listconvertida = array();
		foreach ($lista as $value) {
			array_push($listconvertida, new Cliente($value));
		}
		$this->render("cliente/index",$listconvertida);
	}

	public function create($p = null){
		if(count($_POST)==0){
			$this->title = "Cliente - Create";
			$this->render("cliente/create",new Cliente());
		} else {
			$db = new ClienteRepository;
			$cliente = new Cliente($_POST);
			if($db->create($cliente)){
				$util = new Util();
				$util->redirect( $util->getBase()."cliente/index");
				//echo $util->getBase()."cliente/index";
			}
		}
	}

	public function delete($p = null){
		$db = new ClienteRepository;
		$cliente = new Cliente();
		$cliente->cpfcliente = $p[0];
		if($db->delete($cliente)){
			$util = new Util();
			$util->redirect( $util->getBase()."cliente/index");
			//echo $util->getBase()."cliente/index";
		}
	}

	public function update($p = null){
		if(count($_POST)==0){
			$this->title = "Cliente - Update";
			$this->primary = "cpfcliente";
			$db = new ClienteRepository;
			$lista = $db->select(["cpfcliente"=>$p[0]])[0];
			$this->render("cliente/update",new Cliente($lista));
		} else {
			$db = new ClienteRepository;
			if($db->update($_POST)){
				$util = new Util();
				$util->redirect( $util->getBase()."cliente/index");
			}
		}
	}
}


 ?>