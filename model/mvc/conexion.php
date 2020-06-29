<?php
class Conexion{
    private $connection;
    private $connectInfo;
    private $server = 'localhost';
    private $database = "dbToolCreation";
    private $uid = "usuario1";
    private $pwd = "admin1";
    private $charset = "UTF-8";


    //contructor  que crear la conexion
    public  function __construct(){
        $this->connectInfo = array("Database"=>$this->database,"UID"=>$this->uid, "PWD"=>$this->pwd,"CharacterSet"=>$this->charset);
        $this->connection = sqlsrv_connect($this->server,$this->connectInfo);
        
    }

    //metodo que  cierra la conexion
    public function closeConnection( $conn ) {
        sqlsrv_close( $conn );
     }

    //Obterner conexion
    public function getConnection(){
        return $this->connection;
    }
}
