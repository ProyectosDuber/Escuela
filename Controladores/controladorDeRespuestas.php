<?php
require_once '../Modelos/Respuesta.php';

if(!empty($_GET['action'])){
    respuestas_controller::main($_GET['action']);
}

class respuestas_controller{
	
	static function main($action){
		if ($action == "crear"){
			respuestas_controller::crear();
		}else if ($action == "actualizar"){
                    respuestas_controller::editar();
		}else if ($action == "delete"){
			respuestas_controller::delete();
		}else if($action == "buscar"){
                    respuestas_controller::buscar();
        }else if($action == "camviarEstado"){
                    respuestas_controller::camviarEstado();
                }
	}
	
	static public function crear (){
     try {
     	$datos = array();
     	$datos['respuesta']=$_POST['respuesta'];
     	$datos['pregunta']=$_GET['pregunta'];
     	$datos['estado']="correcta";

     	$respuesta = new Respuesta($datos);
     

     	$correcta = $respuesta->getCorrecta();

     	if($correcta==null || $correcta ==false){
     			
     	}else{
     		$respuesta->setEstado("incorrecta");
     	}

     	$respuesta->insertar();
     header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=creado&periodo=".$_GET['periodo']);

     } catch (Exception $e) {
     	header("Location: ../Vistas/pages/Docente/gestionarEvaluacion.php?respuesta=error&periodo=".$_GET['periodo']);
     }

}
    public static  function delete(){
		try {
			$respuesta = new Respuesta(array('idRespuesta'=>$_GET['idRespuesta']));
    		$respuesta->eliminar();
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
			$respuesta = new Respuesta(array(
				'respuesta'=>$_GET['texto'],
				'idRespuesta'=>$_GET['idRespuesta']
				));
			
			$respuesta->editar();
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