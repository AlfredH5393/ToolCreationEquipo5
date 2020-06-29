<?php
class SingletonConexion{
    private $connection;
    private $connectInfo;
    private static $_instance;
    private $server = 'localhost';
    private $database = "dbToolCreation";
    private $uid = "usuario1";
    private $pwd = "admin1";
    private $charset = "UTF-8";

    /*
	Get an instance of the Database
	@return Instance
    */
    // Metodo que no permite que se intancie mas de una  vez
    public static function getInstance(){
        if(!self::$_instance) { 
			self::$_instance = new self();
		}
		return self::$_instance;
    }

    //contructor
    private function __construct(){
        $this->connectInfo = array("Database"=>$this->database,"UID"=>$this->uid, "PWD"=>$this->pwd,"CharacterSet"=>$this->charset);
        $this->connection = sqlsrv_connect($this->server,$this->connectInfo);
    }

    private function __clone() { }

    //Obterner conexion
    public function getConnection(){
        return $this->connection;
    }

    public function closeConnection( $conn ) {
        sqlsrv_close( $conn );
     }
}


