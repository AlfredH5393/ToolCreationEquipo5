<?php
require ('singleton_conexion.php');
require ('../model/mvc/model_mvc_estadousuario.php');
class  SINGLETONEstadoUsuario extends MVCEstadoUsuario {
    protected $db;
    protected $conn;
    protected $params;
   

    public function __construct(){
        $this->startDB();
    }

    public function startDB(){
        $this->db = SingletonConexion::getInstance();
        $this->conn = $this->db->getConnection(); 
    }
    
    public function closeConnection(){
       $this->db->closeConnection( $this->conn );
    }
}