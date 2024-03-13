<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Conexiones Financiamiento";
Templates\loadTemplate("admin_header.php");

include "obtenerPagosFinanciamiento.php";
include "stats_cobros_conexion.php";
?>


<div class="container-fluid px-4">
    <h1 class="mt-4">Conexión con Financiamiento</h1>

    <!-- Chart -->
    <div class="row mt-5 mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <ol class="breadcrumb mb-4 shadow-sm">
                <li class="breadcrumb-item active">Resumen cobros conexión por financiamiento</li>
            </ol>
            <div style="width: 100%; min-height: 25vh;"><canvas id="cob-con-fin-ctx"></canvas></div>
        </div>
    </div>

    <!-- Table -->
    <div>
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between shadow-sm">
                        <h6 class="m-0 font-weight-bold text-primary">Conexiones de Financiamiento</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="table-responsive shadow-sm">
                        <table id="tabla_conexion_financiamiento" class="crud-table">
                            <thead>
                                <tr>
                                    <th>Id Servicio</th>
                                    <th>N conexión</th>
                                    <th>N medidor</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Fecha emisión</th>
                                    <th>Hora emisión</th>
                                    <th>Entrada </th>
                                    <th>Cuota 1</th>
                                    <th>Cuota 2</th>
                                    <th>Cuota 3</th>
                                    <th>Cuota 4</th>
                                    <th>Cuota 5</th>
                                    <th>Cuota 6</th>
                                    <th>Total a Pagar</th>
                                    <th>Total Pagado</th>
                                    <th>Restante a Pagar</th>
                                    <th>Actualizar</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($pagos as $key => $registro) {
                                    $id = $registro["id"];
                                    $servicio = $registro["servicio"];
                                    $cliente = $registro["cliente"];
                                    $fecha_emision = $registro["fecha_emision"];
                                    $hora_emision = $registro["hora_emision"];
                                    $entrada = $registro["entrada"];
                                    $cuota1 = $registro["cuota1"];
                                    $cuota2 = $registro["cuota2"];
                                    $cuota3 = $registro["cuota3"];
                                    $cuota4 = $registro["cuota4"];
                                    $cuota5 = $registro["cuota5"];
                                    $cuota6 = $registro["cuota6"];
                                    $total_pagar = $registro["total_pagar"];
                                    $total_pagado = $registro["total_pagado"];
                                    $restante_pagar = $registro["restante_pagar"];
                                    // Accede a los datos dentro de "servicio"
                                    $id_servicio = $servicio["id"];
                                    $n_conexion = $servicio["n_conexion"];
                                    $n_medidor = $servicio["n_medidor"];
                                    $direccion = $servicio["direccion"];
                                    $estado = $servicio["estado"];
                                    $lectura_anterior = $servicio["lectura_anterior"];
                                    // Accede a los datos dentro de "cliente"
                                    $id_cliente = $cliente["id"];
                                    $cedula = $cliente["cedula"];
                                    $nombres = $cliente["nombres"];
                                    $apellidos = $cliente["apellidos"];
                                    $telefono = $cliente["telefono"];

                                    if ($restante_pagar > 0){
                                        echo '<tr class="bg-pago-alert">';
                                    } else {
                                        echo '<tr>';
                                    }
                                    echo'<td>' .$id_servicio .'</td>';
                                    echo'<td>' .$n_conexion .'</td>';
                                    echo'<td>' .$n_medidor .'</td>';
                                    echo'<td>' .$nombres .'</td>';
                                    echo'<td>' .$apellidos .'</td>';
                                    echo'<td>' .$fecha_emision .'</td>';
                                    echo'<td>' .$hora_emision .'</td>';
                                    echo'<td>$ ' .$entrada .'</td>';

                                    $formulario_id = 'formulario_' . $id; // Puedes usar el ID del registro como parte del identificador

                                    echo '<form id="' . $formulario_id . '" action="'. Redirection\format_url('pago/financiamiento/update/cuotas') .'" method="post" >';
                                    echo '<td><input class="w-100" type="number" id="cuota1" data-pos="'.$key.',0" name="cuota1" value="' . $cuota1 . '"></td>';
                                    echo '<td><input class="w-100" type="number" id="cuota2" data-pos="'.$key.',1" name="cuota2" value="' . $cuota2 . '"></td>';
                                    echo '<td><input class="w-100" type="number" id="cuota3" data-pos="'.$key.',3" name="cuota3" value="' . $cuota3 . '"></td>';
                                    echo '<td><input class="w-100" type="number" id="cuota4" data-pos="'.$key.',2" name="cuota4" value="' . $cuota4 . '"></td>';
                                    echo '<td><input class="w-100" type="number" id="cuota5" data-pos="'.$key.',4" name="cuota5" value="' . $cuota5 . '"></td>';
                                    echo '<td><input class="w-100" type="number" id="cuota6" data-pos="'.$key.',5" name="cuota6" value="' . $cuota6 . '"></td>';
                                    echo '<input type="hidden" name="id_pago" id="id_pago" value="'. $id .'"><br>';
                                    echo'</form>';
                                    echo'<td>$ ' .$total_pagar .'</td>';
                                    echo'<td>$ ' .$total_pagado .'</td>';
                                    echo'<td>$ ' .$restante_pagar .'</td>';
                                    echo '<td>';
                                    echo '<button title="Actualizar Todas las cuotas" type="button" class="btn btn-warning m-1" onclick="enviarFormulario(\'' . $formulario_id . '\')">';
                                    echo '<i class="fas fa-sync"></i>';
                                    echo '</button>';
                                    echo '</td>';
                                    echo '</tr>';
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

<script>
    var cob_con_fin = JSON.parse("<?= json_encode($stats_cobros_conexion['resumen_conexion_financiamiento']) ?>");

    function enviarFormulario(formulario_id) {
        // Encuentra el formulario por su ID y envíalo
        document.querySelector('#' + formulario_id).submit();
    }

    function set_cuotas_in_table(){
        // Fields
        cuotas_fields = [
            'cuota1'
        ];
        // Values
        cuotas_values = [
            $('input[name="cuota1"]'), $('input[name="cuota2"]'), $('input[name="cuota3"]'),
            $('input[name="cuota4"]'), $('input[name="cuota5"]'), $('input[name="cuota6"]')
        ]
        return cuotas_values;
    }
</script>
<script src="<?= Redirection\format_url('js/charts.js') ?>"></script>

<?php Templates\loadTemplate("admin_footer.php"); ?>