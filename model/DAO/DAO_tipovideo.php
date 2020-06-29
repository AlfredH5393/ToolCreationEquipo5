<?php
require('../model/mvc/conexion.php');
require('../model/VO/VO_tipovideo.php');

class DAOTipoVideo{
    protected $db;
    protected $conn;
    protected $params;
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

    public function insertData($tipoVideo){
        $this->sql="INSERT INTO TblTipoVideo (Vch_Nombre_Video) VALUES(?)"; 
        $this->params =  array( $tipoVideo->getNombreTipoVideo() );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData($tipoVideo){
        $this->sql="UPDATE TblTipoVideo
                    SET Vch_Nombre_Video = ?
                    WHERE Int_Id_TipoVideo = ?"; 
        $this->params =  array( $tipoVideo->getNombreTipoVideo(), $tipoVideo->getId());
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
    
    public function deleteData($tipoVideo){
        $this->sql="DELETE FROM TblTipoVideo
                    WHERE Int_Id_TipoVideo = ? "; 

        $this->params =  array($tipoVideo->getId());
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT Int_Id_TipoVideo
                        ,Vch_Nombre_Video
                    FROM TblTipoVideo";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_Id_TipoVideo'],
               'nombreTipoVideo'  =>  $row['Vch_Nombre_Video']
            );
        }
         $encabezado=array("tipoVideo"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblTipoVideo";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}