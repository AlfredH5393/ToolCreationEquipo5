<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_nivel.php');
class  DAONivel {
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

    public function insertData($nivel){
        $this->sql="INSERT INTO TblNivel ( Vch_Nombre_Nivel ) VALUES(?)"; 
        $this->params =  array( $nivel->getNombreNivel() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData($nivel){
        $this->sql="UPDATE TblNivel
                    SET Vch_Nombre_Nivel = ?
                    WHERE Int_IdNivel_Curso = ?"; 
        $this->params =  array( $nivel->getNombreNivel(), $nivel->getId());
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
    
    public function deleteData($nivel){
        $this->sql="DELETE FROM TblNivel
                    WHERE Int_IdNivel_Curso = ? "; 
        $this->params =  array($nivel->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdNivel_Curso,
                           Vch_Nombre_Nivel
                    FROM TblNivel";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdNivel_Curso'],
               'nombreNivel'  =>  $row['Vch_Nombre_Nivel']
            );
        }
         $encabezado=array("estadoNivel"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblNivel";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}