<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_estadocurso.php');
class  DAOEstadoCurso{
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

    public function insertData($estadoCurso){
        $this->sql="INSERT INTO TblEstado_Curso(Vch_NombreEstado_c) VALUES(?)"; 
        $this->params =  array( $estadoCurso->getNombreEstadoCurso() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData($estadoCurso){
        $this->sql="UPDATE TblEstado_Curso
                    SET Vch_NombreEstado_c = ?
                    WHERE Int_IdEstado_C = ?"; 
        $this->params =  array( $estadoCurso->getNombreEstadoCurso(), $estadoCurso->getId());
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
    
    public function deleteData($estadoCurso){
        $this->sql="DELETE FROM TblEstado_Curso
                    WHERE Int_IdEstado_C = ? "; 

        $this->params =  array($estadoCurso->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdEstado_C,
                           Vch_NombreEstado_c
                    FROM TblEstado_Curso";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdEstado_C'],
               'nombreEstadoCurso'  =>  $row['Vch_NombreEstado_c']
            );
        }
         $encabezado=array("estadoCurso"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblEstado_Curso";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}