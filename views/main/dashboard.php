<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Tablero";
Templates\loadTemplate("admin_header.php");

include "obtenerEstadisticas.php";
include "stats_cobros_planillas.php";
?>

<div class="container-fluid px-4">
    <div class="mt-4"></div>
    <ol class="breadcrumb mb-4 shadow-sm">
        <li class="breadcrumb-item active">Estadísticas</li>
    </ol>
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card shadow-sm  border-left-primary py-2">
                <div class="card-body">
                    <div class="row no-gutters  align-items-center">
                        <div class="col ">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Clientes</div>
                            <div class="h5 font-weight-bold text-gray-800"> <?php echo $clientesN;
                                ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow-sm  h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Servicios</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <?php echo $serviciosN; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-12 mb-4" >
            <div class="card border-left-warning shadow-sm  h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Planillas Pendientes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $notificaciones; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bell fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-5">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <ol class="breadcrumb mb-4 shadow-sm">
                <li class="breadcrumb-item active">Resumen cobros de planillas <b>(semanal)</b></li>
            </ol>
            <div id="cobros-semana-chart-container" style="width: 100%; min-height: 40vh;"><canvas id="cob-pla-semana-ctx"></canvas></div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <ol class="breadcrumb mb-4 shadow-sm">
                <li class="breadcrumb-item active">Resumen cobros de planillas <b>(mensual)</b></li>
            </ol>
            <div id="cobros-mensual-chart-container" style="width: 100%; min-height: 40vh;"><canvas id="cob-pla-mes-ctx"></canvas></div>
        </div>
    </div>

<script>
    // Array de datos para charts
    var cob_pla_sem = JSON.parse("<?php echo json_encode($stats_cobros_planillas['semana']);?>");

    var cob_pla_mes = JSON.parse("<?php echo json_encode($stats_cobros_planillas['mes']);?>");
</script>
<script src="<?= Redirection\format_url('js/charts.js') ?>"></script>

<?php Templates\loadTemplate('admin_footer.php') ?>
