<?php
class  MVCEstancia {
    protected $db;
    protected $conn;
    protected $params;
    private $sql;
    private $id;
    private $nombreEstancia;
 
    public function setNombreEstancia( $nombreEstancia){
        $this->nombreEstancia = $nombreEstancia;

    }

    public function getNombreEstancia( ){
       return $this->nombreEstancia;

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
        $this->sql="INSERT INTO TblEstancia(VchNombreEstancia) VALUES(?)"; 
        $this->params =  array( $this->nombreEstancia );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblEstancia
                    SET VchNombreEstancia = ?
                    WHERE Int_IdEstancia_Inst = ?"; 
        $this->params =  array( $this->nombreEstancia, $this->id);
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
        $this->sql="DELETE FROM TblEstancia
                    WHERE Int_IdEstancia_Inst = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdEstancia_Inst,
                           VchNombreEstancia
                    FROM TblEstancia";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $colecciones = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $colecciones[] = array(
               'id' =>  $row['Int_IdEstancia_Inst'],
               'nombreEstancia'  =>  $row['VchNombreEstancia']
            );
        }
         $encabezado=array("estancia"=>$colecciones);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblEstancia";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}