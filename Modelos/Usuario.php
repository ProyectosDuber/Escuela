<?php

require_once (__DIR__.'/db_abstract_class.php');
class Usuario extends db_abstract_class {
    
    private $idUsuario;
    private $username;
    private $password;
    private $tipo;
    private $nombres;
    private $apellidos;
    private $documento;
    private $sexo;
    
    function __construct($datos = array()) {
        parent::__construct();
        
            if(count($datos) >0){
                foreach ( $datos as $columna =>$dato ){
                    $this->$columna = $dato;
                }
                
            }else{
                $this->username="";
                $this->password="";
            }
        
    }
    
    function __destruct() {
        $this->Disconnect();
        
    }   

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getDocumento() {
        return $this->documento;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setDocumento($documento) {
        $this->documento = $documento;
    }

    function getSexo() {
        return $this->sexo;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    
            
    
    public function editar() {
        $query = "UPDATE Usuarios SET nombres=?,apellidos=?,documento=?,sexo=? where idUsuario=?";
       $params = array(
       $this->nombres,
       $this->apellidos,
       $this->documento,
       $this->sexo,
       $this->idUsuario    
       );
        
        parent::updateRow($query, $params);
            $this->Disconnect();
    }

    public function eliminar() {
        
        $this->updateRow("UPDATE Usuarios SET estado=? where idUsuario=?",array("Eliminado",$this->idUsuario));

    }

    public function insertar() {
             $query = "INSERT INTO Usuarios VALUES('NULL',?,?,?,?,?,?,?,?)";
       $params = array(
       $this->username,
       $this->password,
       $this->tipo,
       $this->nombres,
       $this->apellidos,
       $this->documento,
       $this->sexo,
       "Activo"
      
       );
        
        parent::insertRow($query, $params);
        $this->Disconnect();
    }

    public static function buscar($query,$parametros = array()) {
        $usuario = new Usuario();
        $array = $usuario->getRow($query, $parametros);
  
        return $array;
        
    }
    public static function buscarForId($id) {
        $usuario = new Usuario();
        
       $array = $usuario->getRow("SELECT * FROM Usuarios where idUsuario=?", array($id));
        
        return $array ;
        
    }

    public static function buscarForDocumento($documento) {
        $usuario = new Usuario();
        
       $array = $usuario->getRow("SELECT * FROM Usuarios where documento=? and estado=?", array($documento,"Activo"));
        
        return $array ;
        
    }
    public static function getTodos($tipo){

        if($tipo=="Docente"){
            $tipo="Estudiante";
        }else{
            $tipo="Docente";
        }

        $Estudiante = new Usuario();
        $estudiantes = $Estudiante->getRows("SELECT * FROM Usuarios where tipo=? and estado=?",array($tipo,"Activo"));   
        return $estudiantes; 
    }


     public static function buscarEstudiates($busqueda,$tipo){
        if($tipo=="Docente"){
            $tipo="Estudiante";
        }else{
            $tipo="Docente";
        }

        $Estudiante = new Usuario();
        $estudiantes = $Estudiante->getRows("SELECT * FROM Usuarios where (nombres like ? or documento like ? or apellidos like ?) and (tipo=? and estado=?) ",array("%".$busqueda."%","%".$busqueda."%","%".$busqueda."%",$tipo,'Activo'));   
        return $estudiantes; 
    }
    public static function getAll() {
        
    }
    public static function todo(){
        
    }

}
