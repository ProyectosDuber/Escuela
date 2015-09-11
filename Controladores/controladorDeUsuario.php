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
        }else if($action == "eliminar"){
                    usuarios_controller::eliminar();
        }
	}
	public static function eliminar(){
		
            try {
				session_start();
				$datos = array();
                                
				$datos['idUsuario']=$_GET['idUsuario'];
				$usuario = new Usuario($datos);
				$usuario->eliminar();
				$_SESSION['respuesta']= "correcto";

 header("Location: ../Vistas/pages/Docente/ListarEstudiantes.php?respuesta=creado");
			} catch (Exception $e) {
				$_SESSION['respuesta']="error";
				 header("Location: ../Vistas/pages/Docente/ListarEstudiantes.php?respuesta=error");
			}
	}
	static public function crear (){
          try {
          	$datos = array();
          	$datos['username']=$_POST['documento'];
          	$datos['password']=$_POST['documento'];
          	$datos['tipo']="Estudiante";
          	$datos['nombres']=$_POST['nombres'];
          	$datos['apellidos']=$_POST['apellidos'];
          	$datos['documento']=$_POST['documento'];
          	$datos['sexo']=$_POST['sexo'];
          	$usuario = new Usuario($datos);
          	$comprobacion = $usuario->buscarForDocumento($_POST["documento"]) ;
          	if( $comprobacion ==null || $comprobacion==false ){
          		
				$usuario->insertar();
          	
          		echo "creado";
          		
          	}else{
				echo "duplicado";
          	}	


          	



          } catch (Exception $e) {
          	
          	echo "error";
          	
          }

	}
	public static function busqueda(){

		try {
			$usuario = new Usuario();

			$Estudiantes = $usuario->buscarEstudiates($_GET['busqueda'],$_GET['tipo']);
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

			$datos = array();
			$datos['idUsuario']=$_GET['idUsuario'];
			$datos['nombres']=$_POST['nombres'];
			$datos['apellidos']=$_POST['apellidos'];
			$datos['documento']= $_POST['documento'];
			$datos['sexo'] = $_POST['sexo'];

			$usuario = new Usuario($datos);
			
			$usuario->editar();
			$_SESSION['respuesta']= "correcto";

 header("Location: ../Vistas/pages/Docente/ListarEstudiantes.php?respuesta=correcto");
			
		} catch (Exception $e) {
			$_SESSION['respuesta']= "error";

 header("Location: ../Vistas/pages/Docente/ListarEstudiantes.php?respuesta=error");
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