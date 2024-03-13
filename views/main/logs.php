<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Registros";
Templates\loadTemplate("admin_header.php");

include "obtenerLogs.php";
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Logs</h1>
    <div>
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Logs</h6>
                        <div class="dropdown no-arrow">
                        </div>
                    </div>
                    <!-- Card Body -->
                    <div class="table-responsive shadow-sm">
                        <table id="tabla_logs" class="crud-table">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Categoría</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($response as $dato) {
                                    $detalle = 'Ninguno';
                                    if (isset($dato['detalle'])) {
                                        $dato['detalle'];
                                    }
                                    echo '<tr>';
                                    echo '<td>' . $dato['usuario'] . '</td>';
                                    echo '<td>' . $dato['categoria'] . '</td>';
                                    echo '<td>' . $dato['fecha'] . '</td>';
                                    echo '<td>' . $dato['hora'] . '</td>';
                                    echo '<td>' . $detalle . '</td>';
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

<div id="eliminar_logs" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmar Eliminación</h4>
                <button type="button" onclick="modal_hide()" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="modal_hide()"
                    data-dismiss="modal">Cancelar</button>
                <a href="<?= Redirection\format_url('logs/delete/old') ?>" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<script>
    function modal_hide() {
        $('#eliminar_logs').modal('hide');
    }
</script>

<?php Templates\loadTemplate("admin_footer.php"); ?>