<?php
require_once '../Modelos/Respuesta.php';
require_once '../Modelos/Pregunta.php';
require_once '../Modelos/Tema.php';
require_once '../Modelos/Archivo.php';
if(!empty($_GET['action'])){
    archivos_controller::main($_GET['action']);
}

class archivos_controller{
	
	static function main($action){
		if ($action == "crear"){
			archivos_controller::crear();
		}else if ($action == "actualizar"){
                    archivos_controller::editar();
		}else if ($action == "delete"){
			archivos_controller::delete();
		}else if($action == "buscar"){
                    archivos_controller::buscar();
    }else if($action == "camviarEstado"){
                    archivos_controller::camviarEstado();
    }

	}
	
	static public function crear (){
     try {
     session_start();
   /*  	

  

    */

   
     

    $name=  $_FILES['archivo']['name'];
    $extencion= end(explode(".", $name));
      

      $datos = array();
      $datos['nombre']=$name;
      $datos['tema']=$_GET['tema'];
      $datos['extencion']=$extencion;

    $maxValue = Archivo::getMaxValue();
  
    $valor = 0;

    if($maxValue['idArchivo']==null || $maxValue==false){
      $valor = 1;
    }else{
      $valor=$maxValue['idArchivo']+1;
    }
    
  

    $ruta = "../Archivos/".$valor.".".$extencion;     

    if(!file_exists($ruta)){
      $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);

      if($resultado){
        $archivo = new Archivo($datos);

       $archivo->insertar();
      
        echo "exito";

      header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=creado&periodo=".$_GET['periodo']);

      }else{
        echo "fail";
         header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=fail&periodo=".$_GET['periodo']);
      }

    }else{
       header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=yaesxiste&periodo=".$_GET['periodo']);
      echo "fuera";
    }


     	//$Tema = new Tema($datos);
     	

     	
     	
     	//$Tema->insertar();
    // header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=creado&periodo=".$_GET['periodo']);

     } catch (Exception $e) {
       header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=error&periodo=".$_GET['periodo']);
      echo "exepcion";
   	//header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=error&periodo=".$_GET['periodo']);
     }
	}


	public static  function delete(){
	/*	try {
			$Tema = new Tema(array('idTema'=>$_GET['idTema']));  
			
    		$Tema->eliminar();
    		header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=eliminado&periodo=".$_GET['periodo']);
			
		} catch (Exception $e) {
		header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=error&periodo=".$_GET['periodo']);
		}
    */
    	

   if( unlink('../Archivos/'.$_GET['idArchivo'].'.'.$_GET['extencion'])){
    $archivo = new Archivo(array('idArchivo'=>$_GET['idArchivo']));
    $archivo->eliminar();
 header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=Eliminado&periodo=".$_GET['periodo']);
    echo "eliminado";
   }else{
     header("Location: ../Vistas/pages/Docente/gestionarTemas.php?respuesta=Error&periodo=".$_GET['periodo']);
    echo "Fallo";
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