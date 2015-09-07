<?php

require_once (__DIR__.'/db_abstract_class.php');
class Pregunta extends db_abstract_class {
    
    private $idPregunta;
    private $periodo;
    private $pregunta;
   
    private $usuario;
   
    
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

    function getIdPregunta() {
        return $this->idPregunta;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getPregunta() {
        return $this->pregunta;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setIdPregunta($idPregunta) {
        $this->idPregunta = $idPregunta;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function setPregunta($pregunta) {
        $this->pregunta = $pregunta;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
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

    protected function eliminar() {
        
    }

    public function insertar() {
             $query = "INSERT INTO Usuarios VALUES('NULL',?,?)";
       $params = array(
       $this->username,
       $this->password
      
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
    
    public static function preguntasPeriodo($idUsuario,$periodo){
        $pregunta = new Pregunta();
      $preguntas=  $pregunta->getRows("SELECT * FROM Preguntas where usuario=? and periodo=?", array($idUsuario,$periodo));
      return $preguntas;
        
        
    }

}