
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicar Sesión</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../js/jquery.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">&nbsp;</h3>
                    </div>
                    <div class="panel-body">
                        <form id="login"action="../../Controladores/controladorDeUsuario.php?action=Iniciar_sesion" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input  class="form-control" placeholder="Usuario" name="username" id="username" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" id="password" type="password"  required>
                                </div>
                                <div class="checkbox">
                                    <label id="respuesta" style="color: red"></label>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <button  class="btn btn-lg btn-success btn-block" type="submit">Iniciar Sesión</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <script>
     $("#respuesta").hide();
     
     $("#login").submit(function (){
         var datos = $(this).serialize();
         $.post("../../Controladores/controladorDeUsuario.php?action=Iniciar_sesion",datos,prosesar).error(pError);
         return false;
     });
    function prosesar(datos){
        if(datos==false){
            $("#respuesta").replaceWith(" <label id='respuesta' style='color: red'>Usuario o contraseña incorrectos</label>");
        }else if(datos =="Docente"){
             $("#respuesta").hide();
             
             $(location).attr('href',"./Docente/");
        }else if(datos =="Estudiante"){
             $("#respuesta").hide();
             
             $(location).attr('href',"./Estudiante/");
        }
        
    }
    
    function pError(){
        $("#respuesta").replaceWith(" <label id='respuesta' style='color: red'>Upps !! error inesperado intentalo de nuevo</label>");
    }
    
    </script>
   
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
   
</body>

</html>
