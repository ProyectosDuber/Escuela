<?php
require_once '../Modelos/Respuesta.php';
require_once '../Modelos/Pregunta.php';
require_once '../Modelos/Tema.php';
if(!empty($_GET['action'])){
    temas_controller::main($_GET['action']);
}

class temas_controller{
	
	static function main($action){
		if ($action == "crear"){
			temas_controller::crear();
		}else if ($action == "actualizar"){
                    temas_controller::editar();
		}else if ($action == "delete"){
			temas_controller::delete();
		}else if($action == "buscar"){
                    temas_controller::buscar();
    }else if($action == "camviarEstado"){
                    temas_controller::camviarEstado();
    }
	}
	
	static public function crear (){
     try {
     session_start();
     	$datos = array();
      $datos['titulo']=$_POST['titulo'];
     	$datos['contenido']=$_POST['contenido'];
     	$datos['periodo']=$_GET['periodo'];
     	$datos['usuario']=$_SESSION['idUsuario'];
    

     	$Tema = new Tema($datos);
     	

     	
     	
     	$Tema->insertar();
     header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=creado&periodo=".$_GET['periodo']);

     } catch (Exception $e) {
   	header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=error&periodo=".$_GET['periodo']);
     }
	}


	public static  function delete(){
		try {
			$Tema = new Tema(array('idTema'=>$_GET['idTema']));  
			
    		$Tema->eliminar();
    		header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=eliminado&periodo=".$_GET['periodo']);
			
		} catch (Exception $e) {
		header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=error&periodo=".$_GET['periodo']);
		}
    		
    } 
	static public function camviarEstado (){
		try {
                    
                    Respuesta::camviarEstado($_POST['idPregunta'], $_POST['idRespuesta']);
                    echo true;
		} catch (Exception $e) {
                    echo false;
		}
	}
	
	static public function editar (){
		try {
			$Pregunta = new Pregunta(array(
				'descripcion'=>$_GET['texto'],
				'idPregunta'=>$_GET['idPregunta']
				));
			
			$Pregunta->editar();
			header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=actualizado&periodo=".$_GET['periodo']);
		} catch (Exception $e) {
			header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=error&periodo=".$_GET['periodo']);
		}
	}
	
	static public function buscarID ($id){
		try { 
			return usuarios::buscarForId($id);
		} catch (Exception $e) {
			header("Location: ../buscar.php?respuesta=error");
		}
	}
	
	public static function buscarAll (){
		try {
			return usuarios::getAll();
		} catch (Exception $e) {
			header("Location: ../buscar.php?respuesta=error");
		}
	}

	public static function buscar (){
		try {
                   $arrayDeUsuario =array();
                   $arrayDeUsuario[] = $_POST['username'];
                   $arrayDeUsuario[] = $_POST['password'];
                   
                   $query = "SELECT * FROM Usuarios where username =? and password=?";
                   
                   $usario = clUsuario::buscar($query, $arrayDeUsuario);
                   
                  if($usario!=NULL){
                      session_start();
                      
                      $_SESSION['username'] =$_POST['username'];
                      $_SESSION['password'] = $_POST['password'];
                    $_SESSION['idUsuario'] = $usario->getIdUsuario();

                        header("Location: ../Vista/favoritos.php");
                  }  else {
                      echo 'error';
                    header("Location: ../Vista/login.php?respuesta=invalido");
                  } 
                
                  
               
                    
		} catch (Exception $e) {
                    
			  header("Location: ../Vista/login.php?respuesta=error");
		}
	}
        public static function IniciarSesion(){
            
            try {
                
             $respuesta = Usuario::buscar("SELECT * FROM Usuarios where username=? and password=? and estado=?",array($_POST['username'],$_POST['password'],"Activo") );
             
                
             if($respuesta!=false){
                 session_start();
                 
                 foreach ($respuesta as $column=>$valor){
                     
                     $_SESSION[$column]=$valor;
                 }
                 
                 
               if($respuesta['tipo']=="Docente"){
                   echo "Docente";
               }  else {
                   echo "Estudiante";
               }  
             
               
             }else{
                 echo false;
             }
            } catch (Exception $ex) {
                echo FALSE;
            }
            
        }
	
}
?>