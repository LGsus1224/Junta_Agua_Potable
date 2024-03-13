<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Planillas";
Templates\loadTemplate("admin_header.php");

include "obtenerPlanillas.php";
?>


<!-- Begin Page Content -->
<div class="container-fluid mt-3">
    <!-- Content Row -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between shadow-sm">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Planillas
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="table-responsive shadow-sm">
                <table id="tabla_planilla" class="crud-table">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Id Servicio</th>
                                <th>Fecha Emisión</th>
                                <th>Consumo Base</th>
                                <th>Excedente</th>
                                <th>Valor Consumo Base</th>
                                <th>Valor Excedente</th>
                                <th>Lectura Anterior</th>
                                <th>Lectura Actual</th>
                                <th>Consumo Total</th>
                                <th>Valor Consumo Total</th>
                                <th class="exclude">Pago</th>
                                <th class="exclude">Eliminar</th>
                                <th class="exclude">Actualizar</th>
                                <th class="exclude">Generar Planilla</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        foreach ($response as $dato) {
                            echo '<tr>';
                            echo'<td>' .$dato['id'] .'</td>';
                            echo'<td>' .$dato['id_servicio'] .'</td>';
                            echo'<td>' .$dato['fecha_emision'] .'</td>';
                            echo'<td>' .$dato['consumo_base'] .'</td>';
                            echo'<td>' .$dato['exedente'] .'</td>';
                            echo'<td>' .$dato['valor_consumo_base'] .'</td>';
                            echo'<td>' .$dato['valor_exedente'] .'</td>';
                            echo'<td>' .$dato['lectura_anterior'] .'</td>';
                            echo'<td>' .$dato['lectura_actual'] .'</td>';
                            echo'<td>' .$dato['consumo_total'] .'</td>';
                            echo'<td>' .$dato['valor_consumo_total'] .'</td>';
                            echo '<td>';
                            echo '<a href="'. Redirection\format_url('planilla/update/pago') .'?id_planilla=' . $dato['id'] . '&id_cliente=' . $_GET['id_cliente'] . '&nombre=' . $_GET['nombre'] .
                            '&pagado=' . ($dato['pagado'] ? '0' : '1') .
                            '&id_servicio=' . $dato['id_servicio'] . '" class="btn btn-' . ($dato['pagado'] ? 'success' : 'danger') . ' m-1" title="' . ($dato['pagado'] ? 'Pagado' : 'No Pagado') . '">';
                            echo '<i class="fa ' . ($dato['pagado'] ? 'fa-check-circle' : 'fa-times-circle') . '"></i>'; // Cambiamos el contenido por el icono
                            echo '</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<button title="Eliminar Planilla" type="button" class="btn btn-danger m-1 open-confirm-modal" data-toggle="modal" data-target="#confirmModal" data-id-planilla="' . $dato['id'] . '" data-id-servicio="' . $dato['id_servicio'] . '" data-id-cliente="' . $_GET['id_cliente'] . '" data-nombre="' . $_GET['nombre'] . '">';
                            echo '<i class="fas fa-trash"></i>';
                            echo '</button>';
                            echo '</td>';
                            echo '<td>';
                            echo '<button title="Actualizar Lectura" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#actualizarP" data-id_servicio="' . $dato['id_servicio'] . '" data-id_planilla="' . $dato['id'] . '" data-lectura_actual="' . $dato['lectura_actual'] . '" onclick="datos(this)">';
                            echo '<i class="fas fa-sync"></i>';
                            echo '</button>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="'. Redirection\format_url('planilla') .'?id=' . $dato['id'] . '&id_servicio=' . $_GET['id'] . '&id_cliente=' . $_GET['id_cliente'] . '&nombre=' . $_GET['nombre'] . '" class="d-none d-sm-inline-block btn btn-block btn-primary " title="Generar Planilla">';
                            echo '<i class="fas fa-lg fa-download "></i> ';
                            echo '</a>';
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


<!-- Modal de registrar planillas -->

<div class="modal fade" id="registrarP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nueva Planilla</h5>
                <button type="button" class="close" onclick="modal_hide()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="<?= Redirection\format_url('planilla/new') ?>" id="FormularioC">
                    <input type="hidden" name="id_servicio" value="<?= $_GET['id']; ?>">
                    <input type="hidden" name="id_cliente" value="<?= $_GET['id_cliente']; ?>">
                    <input type="hidden" name="nombre" value="<?= $_GET['nombre']; ?>">

                    <div class="form-floating mb-3">
                        <div>
                        <label >Ingrese la Lectura Actual </label>
                        <input class="form-control"  type="number" name="lectura_actual" id="lectura_actual"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="modal_hide()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</div>
<div class="modal fade" id="actualizarP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= Redirection\format_url('planilla/update/lectura') ?>" id="FormularioActualizar">
                <input type="hidden" name="id_planilla" id="id_planilla">
                <input type="hidden" name="id_servicio" value="<?= $_GET['id']; ?>">
                <input type="hidden" name="id_cliente" value="<?= $_GET['id_cliente']; ?>">
                <input type="hidden" name="nombre" value="<?= $_GET['nombre']; ?>">

                    <div class="form-floating mb-3">
                        <div >
                            <label >Ingrese Nueva Lectura</label>
                            <input class="form-control" name="nueva_lectura" id="lectura_actual_modal" type="number"/>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" >Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Eliminar Planilla -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta planilla?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminacion">Confirmar</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        $('.open-confirm-modal').click(function () {
            var idPlanilla = $(this).data('id-planilla');
            var idServicio = $(this).data('id-servicio');
            var idCliente = $(this).data('id-cliente');
            var Nombre = $(this).data('nombre');

            // Asignar una función al botón "Confirmar" del modal
            $('#confirmarEliminacion').off('click').on('click', function () {
                // Construir la URL de redirección con los parámetros necesarios
                var redirectUrl = '<?= Redirection\format_url('planilla/delete') ?>?id_servicio=' + idServicio +
                    '&id_planilla=' + idPlanilla + '&id_cliente=' + idCliente + '&nombre=' + Nombre;

                // Redirigir al usuario a la página deseada
                window.location.href = redirectUrl;
            });
        });
    });

    function modal_hide() {
        $('#registrarP').modal('hide');
    }

    function datos(button) {
        // Obtener los datos del cliente desde los atributos personalizados del botón
        var id_planilla = button.getAttribute('data-id_planilla');
        var nueva_lectura = button.getAttribute('data-lectura_actual');
        var id_servicio = button.getAttribute('data-id_servicio');

        // Llena el campo oculto con el ID de la planilla en el formulario de actualización
        document.getElementById('id_planilla').value = id_planilla;

        // Modifica el valor del campo de entrada en el formulario modal
        document.getElementById('lectura_actual_modal').value = nueva_lectura;

        document.getElementById('id_servicio').value = id_servicio;
    }
</script>

<?php Templates\loadTemplate("admin_footer.php"); ?>