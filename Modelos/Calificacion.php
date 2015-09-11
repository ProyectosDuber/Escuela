<?php

require_once (__DIR__.'/db_abstract_class.php');
class Calificacion extends db_abstract_class {
    
    private $idCalificacion;
    private $periodo;
    private $estudiante;
    private $calificacion;
   
    
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

    function getDescripcion() {
        return $this->descripcion;
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

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

        

            
    
    public  function editar() {
         $query = "UPDATE Preguntas SET descripcion=? where idPregunta=?";
       $params = array(
       $this->descripcion,  
       $this->idPregunta    
       );
        
        $this::updateRow($query, $params);
            $this->Disconnect();
    }

    public function eliminar() {
        
        $this->deleteRow("DELETE FROM Preguntas where idPregunta=?",array($this->idPregunta));
        return true;
    }

    public function insertar() {
             $query = "INSERT INTO CalificacionES VALUES('NULL',?,?,?)";
       $params = array(
       $this->periodo,
       $this->estudiante,
       $this->calificacion
      
       );
        
        parent::insertRow($query, $params);
        $this->Disconnect();
    }

    public static function buscar($query,$parametros = array()) {
        $tema = new Tema();
        $array = $usuario->getRow($query, $parametros);
  
        return $array;
        
    }
    public  function eliminarRespuestasAsosiadas(){
         $this->deleteRow("DELETE FROM Respuestas where pregunta=?",array($this->idPregunta));
        
    }
    public static function buscarForId($id) {
        $usuario = new Usuario();
        
       $array = $usuario->getRow("SELECT * FROM Temas where idTema=?", array($id));
        
        return $array ;
        
    }
     public static function comrobarCalificacion($periodo,$estudiante) {
        $Calificacion = new Calificacion();
        
       $array = $Calificacion->getRow("SELECT * FROM Calificaciones where estudiante=? and periodo=?", array($estudiante,$periodo));
        
        return $array ;
        
      }
       public static function listar($estudiante) {
        $Calificacion = new Calificacion();
        
       $array = $Calificacion->getRows("SELECT * FROM Calificaciones where estudiante=? ", array($estudiante));
        
        return $array ;
        
      }

    public static function getAll() {
        
    }
    
    public static function preguntasPeriodo($idUsuario,$periodo){
        $pregunta = new Pregunta();
      $preguntas=  $pregunta->getRows("SELECT * FROM Preguntas where usuario=? and periodo=?", array($idUsuario,$periodo));
      return $preguntas;
        
        
    }
   

    public static function preguntasPeriodoEstudiante($periodo){
        $pregunta = new Pregunta();
      $preguntas=  $pregunta->getRows("SELECT * FROM Preguntas where periodo=?", array($periodo));
      return $preguntas;
        
        
    }

}
