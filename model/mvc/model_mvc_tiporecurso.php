<?php
require ('conexion.php');
class  MVCTipoRecurso  {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $id;
    private $nombreTipoRec;
   
 
    public function setNombreTipoRec( $nombreTipoRec){
        $this->nombreTipoRec = $nombreTipoRec;

    }

    public function getNombreTipoRec( ){
       return $this->nombreTipoRec;

    }

    public function setId( $id ){
        $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }
    
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

    public function insertData(){
        $this->sql="INSERT INTO TblTipo_Recurso(Vch_NombreTipo_Rec) VALUES(?)"; 
        $this->params =  array( $this->nombreTipoRec );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblTipo_Recurso
                    SET Vch_NombreTipo_Rec = ?
                    WHERE Int_IdTipo_Rec = ?"; 
        $this->params =  array( $this->nombreTipoRec, $this->id);
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
    
    public function deleteData(){
        $this->sql="DELETE FROM TblTipo_Recurso
                    WHERE Int_IdTipo_Rec = ? "; 

        $this->params =  array($this->id);
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