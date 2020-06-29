<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_tiporecurso.php');
class  DAOTipoRecurso  {
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

    public function insertData($tipoRec){
        $this->sql="INSERT INTO TblTipo_Recurso(Vch_NombreTipo_Rec) VALUES(?)"; 
        $this->params =  array( $tipoRec->getNombreTipoRec() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData($tipoRec){
        $this->sql="UPDATE TblTipo_Recurso
                    SET Vch_NombreTipo_Rec = ?
                    WHERE Int_IdTipo_Rec = ?"; 
        $this->params =  array( $tipoRec->getNombreTipoRec(), $tipoRec->getId());
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
    
    public function deleteData($tipoRec){
        $this->sql="DELETE FROM TblTipo_Recurso
                    WHERE Int_IdTipo_Rec = ? "; 

        $this->params =  array($tipoRec->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT Int_IdTipo_Rec
                        ,Vch_NombreTipo_Rec
                    FROM TblTipo_Recurso";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdTipo_Rec'],
               'nombreTipoRec'  =>  $row['Vch_NombreTipo_Rec']
            );
        }
         $encabezado=array("tipoRec"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblTipo_Recurso";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}