<?php 

namespace App\Lib;

use App\Lib\Util;

class DB{
    private $connection;
    private $nameTable;

	public function __construct(){
		
	}

    public function connect($nameTable){
        $this->nameTable = $nameTable;
        $config = new Config('config.json');
        $db = $config->getConfig()->db;
        $this->getConnection($db);
    }

	private function getConnection($db){
		$this->connection = mysqli_connect($db->host,$db->username,$db->password,$db->name);
        mysqli_set_charset($this->connection, "utf8");
	}

    public function select($listpropiety, $where = null){
        //definindo select;
        $select = "";
        if(is_array($listpropiety)){
            foreach ($listpropiety as $value) {
                $select .= " $value";
            }
        } else {
            $select = $listpropiety;
        }

        // definindo where;
        $_where = "";
        if($where){
            $_where = "WHERE ";
            $primeiro = true;
            foreach ($where as $key => $value) {
                if(!$primeiro) $_where .= " AND ";
                $_where .= "$key = $value";
                if($primeiro) $primeiro = false;
            }
        }

        // definindo nome da tabela
        $nameTable = $this->nameTable;

        $query = "SELECT $select FROM $nameTable $_where";

        return $this->query_get_list($query);
    }

    public function insert($class){
        $values = "";
        $indice = "";
        $list = get_object_vars($class);
        $primeiro = true;
        foreach ($list as $key => $value) {
            if(!$primeiro) {
                $values .= ",";
                $indice .= ",";
            }
            $values .= "'$value'";
            $indice .= "$key";
            if($primeiro) $primeiro= false;
        }

        // definindo nome da tabela
        $nameTable = $this->nameTable;

        $query = "INSERT INTO $nameTable ($indice) VALUES($values)";
        
        return $this->query($query);
    }

    public function delete($class, $where){
        $primary = array_keys($where)[0];
        $value = $where[$primary];

        // definindo nome da tabela
        $nameTable = $this->nameTable;

        $query = "DELETE FROM $nameTable WHERE $primary = '$value'";
        return $this->query($query);
    }

    public function update($set,$where=null){
        $_set = "";
        if($set){
            $primeiro = true;
            foreach ($set as $key => $value) {
                if(!$primeiro) $_set .= " , ";
                $_set .= "$key = '$value'";
                if($primeiro) $primeiro = false;
            }
        }

        $_where = "";
        if($where){
            $primeiro = true;
            foreach ($where as $key => $value) {
                if(!$primeiro) $_where .= " AND ";
                $_where .= "$key = '$value'";
                if($primeiro) $primeiro = false;
            }
        }

        // definindo nome da tabela
        $nameTable = $this->nameTable;

        $query = "UPDATE $nameTable SET $_set WHERE $_where"; 

        return $this->query($query);
    }

	private function query_id($query){
        self::$connection = mysqli_connect(self::$servername, self::$username, self::$password, self::$dbname);
        mysqli_set_charset(self::$connection, "utf8");
        //echo $query;
        $result = '';
        if(self::$connection->query($query)){
            $result = $last_id = self::$connection->insert_id;
        } else {
            echo mysqli_error(self::$connection);
        }
        mysqli_close(self::$connection);
        return $result;
    }

    private function query($query){
        $result = false;
        if($this->connection->query($query)){
            $result = true;
        }
        mysqli_close($this->connection);
        return $result;
    }

    private function query_get_list($query){
        if($result = $this->connection->query($query)){
            
            $n = mysqli_num_rows($result);
            if ($n > 0) {
                $r = array();
                while($row = mysqli_fetch_assoc($result)){
                    array_push($r, (array)$row);
                }
                $result = $r;
            } else {
                $result = array();
            }
            
            mysqli_close($this->connection);
            return $result;
        }
    }

    private function query_get($query, $debug = false){
        self::$connection = mysqli_connect(self::$servername, self::$username, self::$password, self::$dbname);
        mysqli_set_charset(self::$connection, "utf8");
        if($debug) echo $query;
        if($result = self::$connection->query($query)){
            $n = mysqli_num_rows($result);
            if ($n > 0) {
                $result = (array)mysqli_fetch_assoc($result);
            } else {
                $result = null;
            }
            mysqli_close(self::$connection);
            return $result;
        }
    }
}

?>