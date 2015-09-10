<?php
require_once '../Modelos/Usuario.php';
if(!empty($_GET['action'])){
	usuarios_controller::main($_GET['action']);
}

class usuarios_controller{
	
	static function main($action){
		if ($action == "crear"){
			usuarios_controller::crear();
		}else if ($action == "editar"){
			usuarios_controller::editar();
		}else if ($action == "buscarID"){
			usuarios_controller::buscarID(1);
		}else if($action == "buscar"){
                    usuarios_controller::buscar();
        }else if($action == "Iniciar_sesion"){
                    usuarios_controller::IniciarSesion();
        }else if($action == "busqueda"){
                    usuarios_controller::busqueda();
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
	public static function busqueda(){

		try {
			$usuario = new Usuario();

			$Estudiantes = $usuario->buscarEstudiates($_GET['busqueda']);
			echo json_encode($Estudiantes);

		} catch (Exception $e) {
			return null;
		}
	}
	public static function getTodosLosEstudiantes(){

		try {
			$usuario = new Usuario();

			return $usuario->getTodosLosEstudiantes();

		} catch (Exception $e) {
			return null;
		}
	}

	static public function editar (){
		try {
			
			$arrayUser = array();
			$arrayUser['cedula'] = $_POST['cedula'];
			$arrayUser['nombres'] = $_POST['nombres'];
			$arrayUser['apellidos'] = $_POST['apellidos'];
                        $arrayUser['sexo'] = $_POST['sexo'];
			$arrayUser['fechaDeNacimiento'] = $_POST['fechaDeNacimiento'];
                        $arrayUser['telefono'] = $_POST['telefono'];
                        $arrayUser['email'] = $_POST['email'];
                        $arrayUser['direccion'] = $_POST['direccion'];
			
			$usuario = new Usuario ($arrayUser);
			$usuario->editar();
			header("Location: ../frmNewUser.php?respuesta=correcto");
		} catch (Exception $e) {
			header("Location: ../frmNewUser.php?respuesta=error");
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