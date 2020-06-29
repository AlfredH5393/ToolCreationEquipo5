<?php
require('conexion.php');
class MVCTipoPromocion{
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $nombreTipoPromocion;
    private $id;
 
    public function __construct(){
        $this->startDB();
    }

    public function setNombreTipoPromocion( $value){  $this->nombreTipoPromocion = $value;  }
    public function getNombreTipoPromocion(){ return $this->nombreTipoPromocion; }
    public function setId( $id ){ $this->id = $id; }
    public function getId(){ return $this->id; }

    public function startDB(){
        $this->db = new Conexion();
        $this->conn = $this->db->getConnection(); 
    }

    public function closeConnection(){
       $this->db->closeConnection( $this->conn );
    }
    public function insertData(){
        $this->sql="INSERT INTO TblTipo_Promocion(Vch_NombreTipo_Pro) VALUES(?)"; 
        $this->params =  array( $this->nombreTipoPromocion);
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblTipo_Promocion
                    SET Vch_NombreTipo_Pro = ?
                    WHERE Int_Id_Tipo_Prom = ?"; 
        $this->params =  array( $this->nombreTipoPromocion, $this->id);
        $update = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        if($update){
            $encabezado=array("msj"=>"success");
           
        }else{
            $encabezado=array("msj"=>$update);
        }
        $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);
       
        return $json_string;
    }
    
    public function deleteData(){
        $this->sql="DELETE FROM TblTipo_Promocion
                    WHERE Int_Id_Tipo_Prom = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_Id_Tipo_Prom,
                           Vch_NombreTipo_Pro
                    FROM TblTipo_Promocion";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $rol = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $rol[] = array(
               'id' =>  $row['Int_Id_Tipo_Prom'],
               'nombreTipoPromo'  =>  $row['Vch_NombreTipo_Pro']
            );
        }
         $encabezado=array("tipo"=>$rol);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

         $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblTipo_Promocion";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
        $this->closeConnection();
        return $total[0];
    }
}