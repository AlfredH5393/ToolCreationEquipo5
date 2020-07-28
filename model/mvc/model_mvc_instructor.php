<?php
require('conexion.php');
class MVCProfesor{
    protected $db;
    protected $conn;
    protected $params;
    protected $sql;

    private $idInstructor;
    private $gradoConocimiento;
    private $estancia;
    private $idUsuario;

    //getters y  setter 
    public function getIdInstructor(){
		return $this->idInstructor;
	}

	public function setIdInstructor($idInstructor){
		$this->idInstructor = $idInstructor;
	}

	public function getGradoConocimiento(){
		return $this->gradoConocimiento;
	}

	public function setGradoConocimiento($gradoConocimiento){
		$this->gradoConocimiento = $gradoConocimiento;
	}

	public function getEstancia(){
		return $this->estancia;
	}

	public function setEstancia($estancia){
		$this->estancia = $estancia;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
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
    
    public function verificarSiEsProfesor(){
        $this->sql = "SELECT TblInstructor.Int_IdInstructor FROM TblInstructor WHERE Int_FkUsuario_Inst = ?";
        $this->params = array($this->idUsuario);
        $buscarInstructor = sqlsrv_query( $this->conn, $this->sql, $this->params);
        $result = sqlsrv_fetch_array($buscarInstructor);
        return $result[0];
    }

    public function autentificarProfesor(){
        $this->sql = "SELECT * FROM TblInstructor WHERE Int_FkUsuario_Inst = ?";
        $this->params = array($this->idUsuario);
        $resultado = sqlsrv_query( $this->conn, $this->sql, $this->params);
        if($resultado === false ){
            $res[0] = 0;
            return $res;
        }else{
            $res = sqlsrv_fetch_array($resultado);
            return $res;
        }
    }

    public function registrarProfesor(){
        $this->sql = "INSERT INTO TblInstructor(Int_FkUsuario_Inst) VALUES( ? )";
        $this->params = array($this->idUsuario);
        $registrar = sqlsrv_query( $this->conn, $this->sql, $this->params );
        return $registrar;
    }

    public function update(){
        $this->sql = "UPDATE TblInstructor
                        SET Int_Gdo_Conocimiento_Inst = ?
                        ,Int_Fkestancia_Inst = ?
                    WHERE Int_IdInstructor = ?";
        $this->params = array($this->gradoConocimiento, $this->estancia, $this->idInstructor);
        $actulizar = sqlsrv_query( $this->conn, $this->sql, $this->params );
        return $actulizar;
    }

    public function mostrarDatosDeLogeo(){
        $registro = $this->registrarProfesor();
        if($registro){
            $arrayDataProfesor = $this->autentificarProfesor();
            if($arrayDataProfesor[0] == 0){
                return '0';
            }else{
                $_SESSION['idProfesor']        = $arrayDataProfesor[0];
                $_SESSION['gradoConocimiento'] = $arrayDataProfesor[1];
                $_SESSION['estancia']          = $arrayDataProfesor[2];
                $_SESSION['profesor']          = "YES";
                return 'OK';
            }
        }else{
            return 'ErrorRegistro';
        }   
    }
}