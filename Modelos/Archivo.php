<?php

require_once (__DIR__.'/db_abstract_class.php');
class Archivo extends db_abstract_class {
    
    private $idArchivo;
    private $nombre;
    private $tema;
    private $extencion;   
    
    function __construct($datos = array()) {
        parent::__construct();
        
            if(count($datos) >0){
                foreach ( $datos as $columna =>$dato ){
                    $this->$columna = $dato;
                }
                
            }else{
                
            }
        
    }
    
   
  

    function getIdArchivo() {
        return $this->idArchivo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTema() {
        return $this->tema;
    }

    function setIdArchivo($idArchivo) {
        $this->idArchivo = $idArchivo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTema($tema) {
        $this->tema = $tema;
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
             $query = "INSERT INTO Mensajes (emisor, reseptor, estado, contenido) VALUES (?, ?, ?, ?)";
       $params = array(
       $this->emisor,
       $this->reseptor,
       
       $this->estado,
       $this->contenido
      
       );
        
        parent::insertRow($query, $params);
        $this->Disconnect();
    }
    public static function getArchivosDeTema($idTema){
     
        $archivo = new Archivo(array('tema' =>$idTema));

        return  $archivo->getRows("SELECT * FROM Archivos where tema=?",array($archivo->getTema()));

    }

    public static function getMensajesResividos($idUsuario){

            $mensaje = new Mensaje();

          return $mensaje->getRows("SELECT * FROM Mensajes
                                    inner join Usuarios
                                    on Mensajes.emisor = Usuarios.idUsuario

                                    where reseptor =? and Mensajes.estado=? order by fecha desc",
                                    array($idUsuario,"Activo"));
    }
    public static function getMensajesEnviados($idUsuario){

              $mensaje = new Mensaje();

          return $mensaje->getRows("SELECT * FROM Mensajes
                                    inner join Usuarios
                                    on Mensajes.reseptor = Usuarios.idUsuario

                                    where emisor =? and Mensajes.estado=? order by fecha desc",
                                    array($idUsuario,"Activo"));
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
