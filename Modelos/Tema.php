<?php

require_once (__DIR__.'/db_abstract_class.php');
class Tema extends db_abstract_class {
    
    private $idTema;
    private $periodo;
    private $titulo;
    private $contenido;
    private $usuario;
    private $estado;
   
    
    function __construct($datos = array()) {
        parent::__construct();
        
            if(count($datos) >0){
                foreach ( $datos as $columna =>$dato ){
                    $this->$columna = $dato;
                }
                
            }else{
                
            }
        
    }
    
    function __destruct() {
        $this->Disconnect();
        
    }   

    function getIdTema() {
        return $this->idTema;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getEstado() {
        return $this->estado;
    }

   

    function setIdTema($idTema) {
        $this->idTema = $idTema;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

        

            
    
    protected function editar() {
        $query = "UPDATE Usuarios SET username=?,password=? where idUsuario=?";
       $params = array(
       $this->username,
       $this->password,
       $this->idUsuario    
       );
        
        parent::updateRow($query, $params);
            $this->Disconnect();
    }

    public function eliminar() {
        $this->updateRow("UPDATE Temas SET estado=? where idTema=?",array("Eliminado",$this->idTema));  
    }

    public function insertar() {

        $this->estado="Activo";
             $query = "INSERT INTO Temas VALUES('NULL',?,?,?,?,?)";
       $params = array(
       $this->periodo,
       $this->titulo,
       $this->contenido,
       $this->usuario,
       $this->estado
      
       );
        
        parent::insertRow($query, $params);
        $this->Disconnect();
    }

    public static function buscar($query,$parametros = array()) {
        $tema = new Tema();
        $array = $usuario->getRow($query, $parametros);
  
        return $array;
        
    }
    public static function buscarForId($id) {
        $usuario = new Usuario();
        
       $array = $usuario->getRow("SELECT * FROM Temas where idTema=?", array($id));
        
        return $array ;
        
    }

    public static function getAll() {
        
    }
    
    public static function temasDelPeriodo($idUsuario,$periodo){
        $tema = new Tema();
      $temas=  $tema->getRows("SELECT * FROM Temas where usuario=? and periodo=? and estado=? ", array($idUsuario,$periodo,"Activo"));
      return $temas;
        
        
    }

}
