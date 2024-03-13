<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Reconexión de servicios";
Templates\loadTemplate("admin_header.php");

include "obtenerPagosReconexion.php";
include "stats_cobros_conexion.php";
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Pagos por Reconexión</h1>
    <!-- Chart -->
    <div class="row mt-5 mb-5">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <ol class="breadcrumb mb-4 shadow-sm">
                <li class="breadcrumb-item active">Resumen cobros por Reconexión</li>
            </ol>
            <div style="width: 100%; min-height: 25vh;"><canvas id="cob-reconexion-ctx"></canvas></div>
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
                        <h6 class="m-0 font-weight-bold text-primary">Pagos por Reconexión</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="table-responsive shadow-sm">
                        <table id="tabla_conexion" class="crud-table">
                            <thead>
                                <tr>
                                    <th>Id Servicio</th>
                                    <th>N conexión</th>
                                    <th>N medidor</th>
                                    <th>nombres</th>
                                    <th>apellidos</th>
                                    <th>Fecha emisión</th>
                                    <th>Hora emisión</th>
                                    <th>total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach ($pagos as $registro) {
                                    $id = $registro["id"];
                                    $servicio = $registro["servicio"];
                                    $cliente = $registro["cliente"];
                                    $fecha_emision = $registro["fecha_emision"];
                                    $hora_emision = $registro["hora_emision"];
                                    $total = $registro["total"];

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

                                    echo '<tr>';
                                    echo'<td>' .$id_servicio .'</td>';
                                    echo'<td>' .$n_conexion .'</td>';
                                    echo'<td>' .$n_medidor .'</td>';
                                    echo'<td>' .$nombres .'</td>';
                                    echo'<td>' .$apellidos .'</td>';
                                    echo'<td>' .$fecha_emision .'</td>';
                                    echo'<td>' .$hora_emision .'</td>';
                                    echo'<td>' .$total .'</td>';
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
    var cob_reconexion =JSON.parse("<?= json_encode($stats_cobros_conexion['resumen_reconexion']) ?>");
</script>
<script src="<?= Redirection\format_url('js/charts.js') ?>"></script>

<?php Templates\loadTemplate("admin_footer.php");?>