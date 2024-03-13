<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Servicios y Planillas";
Templates\loadTemplate("admin_header.php");

include "obtenerServicios.php";
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Servicios y Generar Planillas</h1>

    <div>
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between shadow-sm">
                        <h6 class="m-0 font-weight-bold text-primary">Servicios</h6>
                        <div class="dropdown no-arrow">
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="table-responsive shadow-sm">
                        <table id="tabla_generarP" class="crud-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cedula</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>N Conexion</th>
                                    <th>N Medidor</th>
                                    <th class="exclude">Estado</th>
                                    <th >Lectura Anterior</th>
                                    <th>Planilla Actual Emitida</th>
                                    <th>Financiamiento Conexion</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                        foreach ($response as $registro) {
                            // Accede a los valores dentro de cada registro
                            $id = $registro['id'];
                            $n_conexion = $registro['n_conexion'];
                            $n_medidor = $registro['n_medidor'];
                            $direccion = $registro['direccion'];
                            $estado = $registro['estado'];
                            $lectura_anterior = $registro['lectura_anterior'];
                            $planilla_actual_emitida = $registro['planilla_actual_emitida'];
                            // Información del cliente dentro de cada registro
                            $cliente = $registro['cliente'];
                            $id_de_cliente = $cliente['id'];
                            $cedula = $cliente['cedula'];
                            $nombres = $cliente['nombres'];
                            $apellidos = $cliente['apellidos'];
                            $telefono = $cliente['telefono'];
                            $financiamiento_conexion = $registro['financiamiento_conexion'];
                            echo '<tr>';
                            echo '<td>' . $id_de_cliente . '</td>';
                            echo '<td>' . $cedula . '</td>';
                            echo '<td>' . $nombres . '</td>';
                            echo '<td>' . $apellidos . '</td>';
                            echo '<td>' . $n_conexion . '</td>';
                            echo '<td>' . $n_medidor . '</td>';
                            echo '<td>';
                            if ($estado) {
                                echo '<span class="badge bg-success"><i class="fas fa-check fa-lg"></i></span>';
                            } else {
                                echo '<span class="badge bg-danger"><i class=" fas fa-times fa-lg"></i></span>';
                            }
                            echo '</td>';

                            if ($planilla_actual_emitida) {
                                echo '    <td>' . $lectura_anterior . '</td>';
                            } else {
                                echo '    <td>';
                                echo '        <form  method="POST" action="'. Redirection\format_url('planilla/new') .'">';
                                echo '            <input type="hidden" name="id_servicio" value="' . $id . '">';
                                echo '            <input class="form-control-sm w-50" type="number" name="lectura_actual" value="' . $lectura_anterior . '">';
                                echo '            <input class="form-control-sm w-50" type="hidden" name="id_cliente" value="' . $id_de_cliente . '">';
                                echo '            <input class="form-control-sm w-50" type="hidden" name="nombre" value="' . $nombres . '">';
                                echo '            <button class=" exclude-element btn btn-success pb-0  h-25" type="submit">Guardar</button>';
                                echo '        </form>';
                                echo '    </td>';
                            }

                            echo '<td>' . ($planilla_actual_emitida ? "Sí" : "No") . '</td>';
                            echo '<td>' . ($financiamiento_conexion ? "Sí" : "No") . '</td>';
                            echo '</tr>';
                        }
                        ?>
                            </tbody>
                        </table>
                        <style>
                           @media print{
                            .exclude-element{
                                display:none;
                            }
                           }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php Templates\loadTemplate("admin_footer.php"); ?>