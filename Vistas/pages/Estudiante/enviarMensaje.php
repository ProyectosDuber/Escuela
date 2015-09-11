<?php session_start(); ?>
<?php include_once '../../../Modelos/Tema.php'; ?>
<?php include_once '../../../Modelos/Pregunta.php'; ?>
<?php include_once '../../../Modelos/Respuesta.php'; ?>
<?php include_once '../../../Modelos/Usuario.php'; ?>

<?php include_once 'menuDocente.php'; ?>
<html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Bootstrap Admin Theme</title>

        <script src="../../js/jquery.js"></script>
        <script src="../../js/jquery-ui/jquery-ui.js"></script>

        <!-- Configuracion de text areas -->
       



        <LINK REL="stylesheet" TYPE="text/css" HREF="../../js/jquery-ui/jquery-ui.css">

        <!-- Bootstrap Core CSS -->
        <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            /* IE has layout issues when sorting (see #5413) */
            .group { zoom: 0.90 }

            /*  #accordion{
                  width: 50%;
              }*/

        </style>
        <script src="../../js/acordion.js"></script>  
        <script src="../../js/botones.js"></script>

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a id="logOut" href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->
 <!-- inicio menu -->
              
                <?php menu();  ?>
                <!-- Fin menu -->
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!-- inicio de preguntas -->


                                    <!--  
                                        <div class="group">
                                            <h3>Section 1</h3>
                                            <div>
                                                <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>
                                            </div>
                                        </div>
                                    -->

<!--        <td style="width: 50%"></td> -->

                                  <div class="panel-group" id="accordion">                
                                 
                                
                                </div>

                                 <h1>Nuevo mensaje</h1>
                                    <form role="form" method="POST" action="../../../Controladores/controladorDeMensajes.php?action=crear" >
                                       
                                    <div class="form-group input-group">
                                            <input id="busqueda" type="text" class="form-control" placeholder="Porfavor ingrese el nombre del estudiante para buscarlo">
                                            <span class="input-group-btn">
                                                <button id="buscar" class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                         <div class="form-group">
                                            <label>Destino</label>
                                            <select id="estudiantes" name="reseptor"  class="form-control">
                                 <?php 

                                        $estudiantes = Usuario::getTodos($_SESSION['tipo']);        
                                            foreach ($estudiantes as $estudiante) {
                                                echo "<option value='".$estudiante['idUsuario']."'>";
                                                    echo $estudiante['documento']." ".$estudiante['nombres']." ".$estudiante['apellidos'];
                                                echo "</option>";

                                        }

                                                 ?>
                                            </select>
                                        </div>
                                            

                                    <br>  
                                    <textarea name="contenido" id="contenido" style="width: 100%;"></textarea>  <br>    
                                    <button class="btn btn-default" type="submit">Enviar</button>

                                    </form>

                                    <br>
<?php/*
echo '<form  method="POST" action="../../../Controladores/controladorDeTemas.php?action=crear&periodo=' . $_GET['periodo'] . '">';
*/
?>

                                    
                                    </form>        



                            

                                <!-- Final de preguntas -->  


                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->


        <script src="../../js/logOut.js"></script>
        <!-- jQuery -->


        <!-- Bootstrap Core JavaScript -->
        <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../dist/js/sb-admin-2.js"></script>
        <script >
             $(".eliminar").click(function () {

                 var respuesta = confirm("Desea eliminar el registro");
                 if (respuesta) {

                     window.location.href = $(this).attr("href");
                 } else {

                 }
                 return false;

             });

        </script>
        <script >
            $(".actualizar").click(function () {

                var respuesta = prompt("Porfavor ingrese la actualizacion");
                if (respuesta == null) {


                    // window.location.href = $(this).attr("href");
                } else if (respuesta == "") {

                } else {
                    //console.log( $(this).attr("href")+"&texto="+respuesta);
                    window.location.href = $(this).attr("href") + "&texto=" + respuesta;
                }
                return false;

            });

        </script>


        <script>

            $("#buscar").click(function () {
                // console.log($(this).attr("name"));
                //console.log($(this).attr("value"));
                var tipod = "<?php echo $_SESSION['tipo'] ?>";

                var datosFormulario = {busqueda: $("#busqueda").val(),tipo: tipod };
                

                $.getJSON("../../../Controladores/controladorDeUsuario.php?action=busqueda", datosFormulario, prosesarDatos);


            });
            $("#busqueda").keyup(function () {
                // console.log($(this).attr("name"));
                //console.log($(this).attr("value"));
                   
               var tipod = "<?php echo $_SESSION['tipo'] ?>";

                var datosFormulario = {busqueda: $("#busqueda").val(),tipo: tipod };
                

                $.getJSON("../../../Controladores/controladorDeUsuario.php?action=busqueda", datosFormulario, prosesarDatos);

            });





            function prosesarDatos(datos) {
                var options ="";
                var numero = -1;
                   $(datos).each(function (index,item){
                    numero =index;
                           options +="<option value='"+item.idUsuario+"' >"+item.documento+" "+item.nombres+" "+item.apellidos+"</option>"; 
                   });
               if (numero > -1) {
                $("#estudiantes").html(options);
               }else{
                     //$("#estudiantes").html("<option value='noHayEstudiantes'>no hay estudiantes</option>");
               } 

                  
            }

        </script>
         <script type="text/javascript" src="../../js/estiloTextAreas.js"></script> <script type="text/javascript">

            //<![CDATA[
            bkLib.onDomLoaded(function () {
                nicEditors.allTextAreas()
            });
            //]]>

        </script>

    </body>

</html>
<?php 

if(isset($_SESSION['respuesta'])){
    if($_SESSION['respuesta']=="creado"){
        echo "<script> alert('Mensaje enviado con satisfaccion !!') </script>";
    }else{
  echo "<script> alert('Error al enviar el mensaje porfavor intentelo mas tarde !!') </script>";
    }
$_SESSION['respuesta'] = null;

}

?>