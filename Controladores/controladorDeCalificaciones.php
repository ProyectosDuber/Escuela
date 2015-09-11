<?php
require_once '../Modelos/Respuesta.php';
require_once '../Modelos/Pregunta.php';
require_once '../Modelos/Calificacion.php';

if(!empty($_GET['action'])){
    preguntas_controller::main($_GET['action']);
}

class preguntas_controller{
	
	static function main($action){
		if ($action == "crear"){
			preguntas_controller::crear();
		}else if ($action == "actualizar"){
                    preguntas_controller::editar();
		}else if ($action == "delete"){
			preguntas_controller::delete();
		}else if($action == "buscar"){
                    preguntas_controller::buscar();
                }else if($action == "camviarEstado"){
                    preguntas_controller::camviarEstado();
                }
	}

	public static function comprobar(){

      try {
        session_start();
        $calificacion = Calificacion::comrobarCalificacion($_SESSION['periodo'],$_SESSION['idUsuario']);
        if($calificacion ==null || $calificacion==false){
          return false;
        }else{
          return true;
        }






      } catch (Exception $e) {
        
      }
  }
	static public function crear (){
     try {
     session_start();
     $buenas=0;
     $preguntas=0;
     	foreach($_POST as $idRespuesta){
            $respuesta = Respuesta::buscarForId($idRespuesta);

            if($respuesta['estado']=="correcta"){
              $buenas ++;          
            }
            $preguntas++;

      }

      $total = round(((100*$buenas)/$preguntas),0);
    

      $datos['periodo']= $_SESSION['periodo'];
      $datos['estudiante']=$_SESSION['idUsuario'];
      $datos['calificacion']= $total;
      $calificacion = new Calificacion($datos);

      $calificacion->insertar();

header("Location: ../Vistas/pages/Estudiante/gestionarEvaluacion.php?respuesta=calificado&periodo=".$_GET['periodo']);

/*
      $datos = array();
     	$datos['descripcion']=$_POST['descripcion'];
     	$datos['periodo']=$_GET['periodo'];
     	$datos['usuario']=$_SESSION['idUsuario'];

     	$Pregunta = new Pregunta($datos);
     	

     	
     	
     	$Pregunta->insertar();
     
*/
     } catch (Exception $e) {
   	header("Location: ../Vistas/pages/Estudiante/gestionarEvaluacion.php?respuesta=error&periodo=".$_GET['periodo']);
     }
	}


	public static  function delete(){
		try {
			$Pregunta = new Pregunta(array('idPregunta'=>$_GET['idPregunta']));
			$Pregunta->eliminarRespuestasAsosiadas();
    		$Pregunta->eliminar();
    		header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=eliminado&periodo=".$_GET['periodo']);
			
		} catch (Exception $e) {
		header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=error&periodo=".$_GET['periodo']);
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