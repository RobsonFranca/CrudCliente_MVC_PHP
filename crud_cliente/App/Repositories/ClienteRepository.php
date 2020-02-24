<?php 

namespace App\Repositories;

use App\Lib\DB;

class ClienteRepository{
	private $db;

	public function __construct(){
		$this->db = new DB();
	}

	public function select($where = null){
		$this->db->connect("cliente");
		$result = $this->db->select("*",$where);
		return $result;
	}

	public function create($cliente){
		$this->db->connect("cliente");
		$result = $this->db->insert($cliente);
		return $result;
	}

	public function delete($cliente){
		$this->db->connect("cliente");
		$result = $this->db->delete($cliente,['cpfcliente'=>$cliente->cpfcliente]);
		return $result;
	}

	public function update($set){
		$this->db->connect("cliente");
		$result = $this->db->update($set, ["cpfcliente"=>$set['cpfcliente']]);
		return $result;
	}
}

 ?>