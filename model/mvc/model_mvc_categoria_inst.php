<?php
require ('conexion.php');
class  MVCCategoriaInstructor  {
    protected $db;
    protected $conn;
    protected $params;
    private $id;
    private $nombreCategoria;
    private $sql;
 
    public function setNombreCategoria( $nombreCategoria){
        $this->nombreCategoria = $nombreCategoria;

    }

    public function getNombreCategoria( ){
       return $this->nombreCategoria;

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
        $this->sql="INSERT INTO TblCategoriaInstructor(Vch_CategoriaInst) VALUES(?)"; 
        $this->params =  array( $this->nombreCategoria );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblCategoriaInstructor
                    SET Vch_CategoriaInst = ?
                    WHERE Int_IdCategoria_Inst = ?"; 
        $this->params =  array( $this->nombreCategoria, $this->id);
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
        $this->sql="DELETE FROM TblCategoriaInstructor
                    WHERE Int_IdCategoria_Inst = ? "; 

        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);
       $this->closeConnection();
        return $delete;
    }
    

    public function getData(){
       $this->sql="SELECT  Int_IdCategoria_Inst,
                        Vch_CategoriaInst
                    FROM TblCategoriaInstructor";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $categoria = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $categoria[] = array(
               'id' =>  $row['Int_IdCategoria_Inst'],
               'nombreCategoria'  =>  $row['Vch_CategoriaInst']
            );
        }
         $encabezado=array("categoria"=>$categoria);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblCategoriaInstructor";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }
}