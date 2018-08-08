<?php
include_once '../app/Conexion.inc.php';
include_once '../app/ControlSesion.inc.php';
include_once '../app/config.inc.php';
include_once '../app/Redireccion.inc.php';
include_once '../plantillas/dataTable.inc.php';

Conexion::abrir_conexion();
?>

<div class="card">
    <header>
        <div class="header bg-blue-grey" style="padding: 0px !important; padding-top: 8px">
            <ul class="nav nav-tabs" style="padding-left: 15px; padding-bottom: 15px; font-size: 18px; font-weight: normal; border-bottom: 0px solid #b7b7b7">
                <li class="active"><a data-toggle="tab" href="#administradores" style="color: #fff !important">ADMINISTRADORES</a></li>
                <li><a data-toggle="tab" href="#ayudantes" style="color: #fff !important">COLABORADORES</a></li>
                <li><a data-toggle="tab" href="#publico" style="color: #fff !important">PÚBLICO</a></li>
            </ul>
        </div>
    </header>
    <div class="body">

        <div class="tab-content">

            <!--******************************TAB 1-->
            <div id="administradores" class="tab-pane fade in active">
                <div class="body" style="padding: 0px">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr style="background: white">
                                    <!--<th>Apellido</th>
                                    <th>Nombre</th>-->
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Activo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_admin = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                    LEFT JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                    WHERE u.rol_idrol = 0";

                                $consulta_admin = Conexion::obtener_conexion()->query($sql_admin);

                                while ($file_admin = $consulta_admin->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <tr valign="top">
                                        <!--<td><?php // echo $file_admin['apellido'];     ?></td> 
                                        <td><?php //echo $file_admin['nombre'];     ?></td>-->
                                        <td><?php echo $file_admin['nombre_usuario']; ?></td>
                                        <td><?php echo $file_admin['email']; ?></td>
                                        <td><?php echo $file_admin['telefono']; ?></td>
                                        <?php
                                        if ($file_admin['activo'] == 1) {
                                            ?>
                                            <td style="text-align:center; width: 5px;"><a style="color: #1C9708">
                                                    <i class="material-icons">lock_open</i>
                                                </a>
                                            </td>
                                            <?php
                                        } elseif ($file_admin['activo'] == 0) {
                                            ?>
                                            <td style="text-align:center; width: 5px;"><a style="color: #BB0808">
                                                    <i class="material-icons">lock_outline</i>
                                                </a>
                                            </td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>                                                    
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!--******************************TAB 2-->
            <div id="ayudantes" class="tab-pane fade">
                <div id="administradores" class="tab-pane fade in active">
                    <div class="body" style="padding: 0px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr style="background: white">
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Activo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_ayudante = "SELECT u.nombre, u.apellido, u.email, u.activo, u.telefono, u.nombre_usuario, s.nombre_seccion FROM usuario u
                                                                            LEFT JOIN seccion s ON u.seccion_idseccion=s.idseccion
                                                                            WHERE u.rol_idrol = 1";

                                    $consulta_ayudante = Conexion::obtener_conexion()->query($sql_ayudante);

                                    while ($file_ayudante = $consulta_ayudante->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <tr valign="top">
                                            <!--<td><?php // echo $file_admin['apellido'];     ?></td> 
                                            <td><?php //echo $file_admin['nombre'];     ?></td>-->
                                            <td><?php echo $file_ayudante['nombre_usuario']; ?></td>
                                            <td><?php echo $file_ayudante['email']; ?></td>
                                            <td><?php echo $file_ayudante['telefono']; ?></td>
                                            <?php
                                            if ($file_ayudante['activo'] == 1) {
                                                ?>
                                                <td style="text-align:center; width: 5px;"><a style="color: #1C9708">
                                                        <i class="material-icons">lock_open</i>
                                                    </a>
                                                </td>
                                                <?php
                                            } elseif ($file_ayudante['activo'] == 0) {
                                                ?>
                                                <td style="text-align:center; width: 5px;"><a style="color: #BB0808">
                                                        <i class="material-icons">lock_outline</i>
                                                    </a>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!--******************************TAB 3-->
            <div id="publico" class="tab-pane fade">
                <div id="administradores" class="tab-pane fade in active">
                    <div class="body" style="padding: 0px">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr style="background: white">
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Activo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql_publico = "SELECT email, activo, nombre_usuario FROM usuario
                                                                        WHERE rol_idrol = 2";

                                    $consulta_publico = Conexion::obtener_conexion()->query($sql_publico);

                                    while ($file_publico = $consulta_publico->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <tr valign="top">
                                            <!--<td><?php // echo $file_admin['apellido'];     ?></td> 
                                            <td><?php //echo $file_admin['nombre'];     ?></td>-->
                                            <td><?php echo $file_publico['nombre_usuario']; ?></td>
                                            <td><?php echo $file_publico['email']; ?></td>
                                            <?php
                                            if ($file_publico['activo'] == 1) {
                                                ?>
                                                <td style="text-align:center; width: 5px;"><a style="color: #1C9708">
                                                        <i class="material-icons">lock_open</i>
                                                    </a>
                                                </td>
                                                <?php
                                            } elseif ($file_publico['activo'] == 0) {
                                                ?>
                                                <td style="text-align:center; width: 5px;"><a style="color: #BB0808">
                                                        <i class="material-icons">lock_outline</i>
                                                    </a>
                                                </td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>                                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>