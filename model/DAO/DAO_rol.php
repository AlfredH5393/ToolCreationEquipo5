<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_roles.php');
class DAORoles{
    private $db;
    private $conn;
    private $params;
    private $sql;
 
    public function __construct(){
        $this->startDB();
    }

    public function startDB(){
        $this->db = new Conexion();
        $this->conn = $this->db->getConnection(); 
    }

    public function closeConnection(){
       $this->db->closeConnection( $this->conn );
    }

    public function insertData($rol){
        $this->sql="INSERT INTO TblRoles(vchNombre) VALUES(?)"; 
        $this->params =  array( $rol->getNombreRol());
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $insert;
    }

    public function updatetData($rol){
        $this->sql="UPDATE TblRoles
                    SET vchNombre = ?
                    WHERE IdIntRol = ?"; 
        $this->params =  array( $rol->getNombreRol(), $rol->getId());
        $update = sqlsrv_query( $this->conn, $this->sql, $this->params);

        if($update){
            $encabezado=array("msj"=>"success");
           
        }else{
            $encabezado=array("msj"=>$update);
        }
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
        $this->closeConnection();
        return $json_string;
    }
    
    public function deleteData($rol){
        $this->sql="DELETE FROM TblRoles
                    WHERE IdIntRol = ? "; 

        $this->params =  array($rol->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  IdIntRol,
                        vchNombre
                    FROM TblRoles";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $rol = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $rol[] = array(
               'id' =>  $row['IdIntRol'],
               'nombreRol'  =>  $row['vchNombre']
            );
        }
         $encabezado=array("rol"=>$rol);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

         $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblRoles";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
        $this->closeConnection();
        return $total[0];
    }
}