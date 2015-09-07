<?php

require_once (__DIR__.'/db_abstract_class.php');
class clUsuario extends db_abstract_class {
    
    private $idUsuario;
    private $username;
    private $password;
    private $tipo;
    private $nombres;
    private $apellidos;
    private $documento;
    
    function __construct($datos = array()) {
        parent::__construct();
        
            if(count($datos) >1){
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
        $usuario = new clUsuario();
        $array = $usuario->getRow($query, $parametros);
        var_dump($array);
        
    }
    public static function buscarForId($id) {
   
        
    }

    public static function getAll() {
        
    }
    public static function todo(){
        
    }

}
