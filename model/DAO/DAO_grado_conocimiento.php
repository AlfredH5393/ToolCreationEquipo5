<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_grado_conocimiento.php');
class DAOGradoConocimiento{
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

    public function insertData($grado){
        $this->sql="INSERT INTO TblGradoConocimiento(Vch_Nombre_Grado_Inst) VALUES(?)"; 
        $this->params =  array( $grado->getNombreGradoConocimiento() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $insert;
    }

    public function updatetData($grado){
        $this->sql="UPDATE TblGradoConocimiento
                    SET Vch_Nombre_Grado_Inst = ?
                    WHERE Int_IdGradoInstructor = ?"; 
        $this->params =  array( $grado->getNombreGradoConocimiento(), $grado->getId());
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
    
    public function deleteData($grado){
        $this->sql="DELETE FROM TblGradoConocimiento
                    WHERE Int_IdGradoInstructor = ? "; 

        $this->params =  array($grado->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdGradoInstructor,
                           Vch_Nombre_Grado_Inst
                    FROM TblGradoConocimiento";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdGradoInstructor'],
               'nombreGrado'  =>  $row['Vch_Nombre_Grado_Inst']
            );
        }
         $encabezado=array("gradoConocimiento"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblGradoConocimiento";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}