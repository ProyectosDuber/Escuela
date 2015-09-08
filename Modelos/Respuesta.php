<?php

require_once (__DIR__.'/db_abstract_class.php');
class Respuesta extends db_abstract_class {
    
    private $idRespuesta;
    private $periodo;
    private $pregunta;
   
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

    function getIdRespuesta() {
        return $this->idRespuesta;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getPregunta() {
        return $this->pregunta;
    }

    function getEstado() {
        return $this->estado;
    }

    function setIdRespuesta($idRespuesta) {
        $this->idRespuesta = $idRespuesta;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function setPregunta($pregunta) {
        $this->pregunta = $pregunta;
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
    public static function camviarEstado($pregunta,$respuestaACamviar){
        $respuesta = new Respuesta();
        $respuesta->updateRow("Update respuestas  set estado = 'incorrecta' where pregunta=? ", array($pregunta));
        $respuesta2 = new Respuesta();
   
        $respuesta2->updateRow("Update respuestas  set estado = 'correcta' where idRespuesta=? ", array($respuestaACamviar));
    }

    public function eliminar() {
   
    $this->deleteRow("DELETE FROM Respuestas where idRespuesta=?",array($this->idRespuesta));
        

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
    
    public static function respuestasPregunta($pregunta){
        $respuesta = new Respuesta();
      $respuestas=  $respuesta->getRows("SELECT * FROM Respuestas where  pregunta=? ", array($pregunta));
      return $respuestas;
        
        
    }

}
