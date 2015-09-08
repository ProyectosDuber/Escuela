<?php
require_once '../Modelos/Respuesta.php';
require_once '../Modelos/Pregunta.php';
if(!empty($_GET['action'])){
    preguntas_controller::main($_GET['action']);
}

class preguntas_controller{
	
	static function main($action){
		if ($action == "crear"){
			preguntas_controller::crear();
		}else if ($action == "editar"){
                    preguntas_controller::editar();
		}else if ($action == "delete"){
			preguntas_controller::delete();
		}else if($action == "buscar"){
                    preguntas_controller::buscar();
                }else if($action == "camviarEstado"){
                    preguntas_controller::camviarEstado();
                }
	}
	
	static public function crear (){
            echo 'bien';
//		try {
//			$arrayUser = array();
//			$arrayUser['cedula'] = $_POST['cedula'];
//			$arrayUser['nombres'] = $_POST['nombres'];
//			$arrayUser['apellidos'] = $_POST['apellidos'];
//                        $arrayUser['sexo'] = $_POST['sexo'];
//			$arrayUser['fechaDeNacimiento'] = $_POST['fechaDeNacimiento'];
//                        $arrayUser['telefono'] = $_POST['telefono'];
//                        $arrayUser['email'] = $_POST['email'];
//                        $arrayUser['direccion'] = $_POST['direccion'];
//			
//			$usuario = new usuarios ($arrayUser);
//			$usuario->insertar();
//			header("Location: ../frmNewUser.php?respuesta=correcto");
//		} catch (Exception $e) {
//			header("Location: ../frmNewUser.php?respuesta=error");
//		}
	}


	public static  function delete(){
		try {
			$respuesta = new Pregunta(array('idPregunta'=>$_GET['idPregunta']));
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
			
			
		} catch (Exception $e) {
			
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