<?php 
function menu(){
echo '<div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">



                           
							
                            <li>
                                <a href="ListarEstudiantes.php"><i class="fa fa-table fa-fw"></i> Estudiantes</a>
                            </li>
                             <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Mensajes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="enviarMensaje.php">Enviar</a>
                                    </li>
                                     <li>
                                        <a href="listarMensajes.php">Listar</a>
                                    </li>
                                    

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Archivos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="subirArchivo.php">Subir </a>
                                    </li>
                                    

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                           
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Tematicas<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="#">Periodo 1 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                       
                                            <li>
                                                <a href="gestionarTemas.php?periodo=1">Gestionar</a>
                                            </li>

                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 2 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                         
                                            <li>
                                                <a href="gestionarTemas.php?periodo=2">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 3 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                          
                                            <li>
                                                <a href="gestionarTemas.php?periodo=3">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 4 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                          
                                            <li>
                                                <a href="gestionarTemas.php?periodo=4">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Evaluaciones<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="#">Periodo 1 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="gestionarEvaluacion.php?periodo=1">Gestionar</a>
                                            </li>

                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 2 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="gestionarEvaluacion.php?periodo=2">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 3 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="gestionarEvaluacion.php?periodo=3">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                    <li>
                                        <a href="#">Periodo 4 <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="gestionarEvaluacion.php?periodo=4">Gestionar</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->

                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>';
}
?>