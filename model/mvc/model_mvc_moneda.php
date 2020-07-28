<?php
class MVCMoneda {
    protected $db;
    protected $conn;
    private $id;
    private $nombreMoneda;
    private $valorMoneda;
    protected $params;
    private $sql;

    public function setData( $nombreMoneda, $valorMoneda){
        $this->nombreMoneda = $nombreMoneda;
        $this->valorMoneda = $valorMoneda;
    }

    public function setId( $id ){
        $this->id = $id;
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
        $this->sql="INSERT INTO TblMoneda (VchNombre_Moneda,Fl_Valor_Moneda) VALUES(?,?)"; 
        $this->params =  array( $this->nombreMoneda ,  $this->valorMoneda );
        $insert = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $this->closeConnection();
        return $insert;
    }

    public function updatetData(){
        $this->sql="UPDATE TblMoneda 
                    SET VchNombre_Moneda = ?,
                        Fl_Valor_Moneda = ? 
                    WHERE Int_Id_Moneda = ?"; 

        $this->params =  array( $this->nombreMoneda ,  $this->valorMoneda, $this->id);

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
        $this->sql="DELETE FROM TblMoneda
        WHERE Int_Id_Moneda = ? "; 
        $this->params =  array($this->id);
        $delete = sqlsrv_query( $this->conn, $this->sql, $this->params);

       $this->closeConnection();

        return $delete;
    }
    

    public function getData(){
      
       $this->sql="SELECT Int_Id_Moneda
                    ,VchNombre_Moneda
                    ,Fl_Valor_Moneda
                    FROM TblMoneda";  
        $select = sqlsrv_query( $this->conn, $this->sql);
        $moneda = array();
         
        while( $row=sqlsrv_fetch_array($select) ){
            $moneda[] = array(
               'id' =>  $row['Int_Id_Moneda'],
               'nombreMoneda'  =>  $row['VchNombre_Moneda'],
               'valor' =>  $row['Fl_Valor_Moneda']
            );
        }
         $encabezado=array("moneda"=>$moneda);
         $json_string = json_encode($encabezado,JSON_UNESCAPED_UNICODE);

       $this->closeConnection();

        return $json_string;
    }

    public function countRegister(){
        $this->sql = "SELECT count(*) FROM TblMoneda";
        $count = sqlsrv_query( $this->conn, $this->sql);
        $total = sqlsrv_fetch_array($count);
       $this->closeConnection();
        return $total[0];
    }

   
}