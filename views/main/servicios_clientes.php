<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Servicios del Cliente";
Templates\loadTemplate("admin_header.php");

include "obtenerServiciosCliente.php";
include "obtenerClientes.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid mt-4">
    <!-- Content Row -->
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 align-items-center justify-content-between shadow-sm">
                    <h3 class="mt-4">Servicios del cliente:</h3>
                    <h6 class="m-0 font-weight-bold text-primary ">
                        <p class=" text-dark">
                            <?php echo $nombre; ?>
                        </p>
                    </h6>
                </div>
                <!-- Card Body -->
                <div class="table-responsive shadow-sm">

                    <table id="tabla_servicios" class="crud-table">
                        <thead>
                            <tr>
                                <th>Id_Servicio</th>
                                <th>N_conexion</th>
                                <th>N_medidor</th>
                                <th>ID_Cliente</th>
                                <th>Direccion</th>
                                <th>Lectura Anterior Medidor</th>
                                <th>Conexion con Financiamiento</th>
                                <th class="exclude">Estado de Servicio</th>
                                <th class="exclude">Editar Servicio</th>
                                <th class="exclude">Emitir Notificacion</th>
                                <th class="exclude">Eliminar Servicio</th>
                                <th class="exclude">Cambiar al cliente que le pertenece el servico</th>
                                <th class="exclude">Planillas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($datos_servicios as $dato) {
                                echo '<tr>';
                                echo '<td>' . $dato['id'] . '</td>';
                                echo '<td>' . $dato['n_conexion'] . '</td>';
                                echo '<td>' . $dato['n_medidor'] . '</td>';
                                echo '<td>' . $dato['id_cliente'] . '</td>';
                                echo '<td>' . $dato['direccion'] . '</td>';

                                echo '<td>' . $dato['lectura_anterior'] . '</td>';
                                echo '<td>' . ($dato['financiamiento_conexion'] ? "Sí" : "No") . '</td>';

                                echo '<td>';
                                echo '<a href="'. Redirection\format_url('servicio/update/estado') .'?id_cliente=' . $dato['id_cliente'] . '&id=' . $dato['id'] . '&estado=' . ($dato['estado'] ? '0' : '1') . '&nombre=' . $nombre . '" class="btn btn-' . ($dato['estado'] ? 'success' : 'danger') . ' m-1" title="' . ($dato['estado'] ? 'Activado' : 'Desactivado') . '">';
                                echo '<i class="fa ' . ($dato['estado'] ? 'fa-check-circle' : 'fa-times-circle') . '"></i>';
                                echo '</a>';
                                echo '</td>';

                                echo '<td>';
                                echo '<button title="Editar Servicio" type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#editar" data-id_servicio="' . $dato['id'] . '"  data-id_cliente="' . $id_de_cliente . '"  data-n_conexion="' . $dato['n_conexion'] . '" data-n_medidor="' . $dato['n_medidor'] . '" data-direccion="' . $dato['direccion'] . '" onclick="datos(this)">';
                                echo '<i class="fas fa-edit"></i>';
                                echo '</button>';
                                echo '</td>';

                                echo '<td>';
                                echo '<button title="Emitir Notificación" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#notificacion" data-id_servicio="' . $dato['id'] . '" data-id_cliente="' . $id_de_cliente . '" data-nombre_cliente="' . $nombre . '" onclick="nueva_notificacion(this)">';
                                echo '<i class="fas fa-bell"></i>';
                                echo '</button>';
                                echo '</td>';


                                echo '<td>';
                                echo '<button title="Eliminar Servicio" type="button" class="btn btn-danger m-1 open-confirm-modal" data-toggle="modal" data-target="#confirmModal" data-id-servicio="' . $dato['id'] . '" data-id-cliente="' . $id_de_cliente . '" data-nombre-cliente="' . $nombre . '">';
                                echo '<i class="fas fa-trash"></i>';
                                echo '</button>';
                                echo '</td>';

                                // <!-- Botón para abrir el modal de Cambiar a que cliente le pertenece el servicio -->
                                echo '<td>';
                                echo '<button title="Cambiar el Servicio a un cliente nuevo" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#cambiarClienteModal" onclick="cambiarUser(this)" data-id_servicio="' . $dato['id'] . '">';
                                echo '<i class="fas fa-exchange-alt"></i>';
                                echo '</button>';
                                echo '</td>';

                                echo '<td>';
                                echo '<a href="'. Redirection\format_url('planillas/servicio') .'?id=' . $dato['id'] . '&id_cliente='. $id_de_cliente .'&nombre='. $nombre .'">';
                                echo '<button title="Planillas del cliente " type="button" class="btn btn-danger m-1">';
                                echo '<i class="fas fa-table"></i>';
                                echo '</button>';
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



<div class="modal fade" id="registrar_servicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Servicio</h5>
                <button type="button" class="close" onclick="modal_hide()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= Redirection\format_url('servicio/new') ?>">
                    <input type="hidden" name="id_cliente" value="<?php echo $id_de_cliente; ?>">
                    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                    <div class="form-floating mb-3">
                        <div>
                            <label>N_conexion</label>
                            <input class="form-control" name="n_conexion" type="number" />
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div>
                            <label>N_medidor</label>
                            <input class="form-control" type="number" name="n_medidor" />
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div>
                            <label>Direccion</label>
                            <input class="form-control" type="text" name="direccion" />
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div>
                            <label>Estado</label>
                            <select class="form-select" id="estado" name="estado">
                                <option value="1">Activado</option>
                                <option value="0">Desactivado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div>
                            <label>Lectura_anterior</label>
                            <input class="form-control" type="number" name="lectura_anterior" />
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="contado_conexion"
                            name="contado_conexion_bool" value="true" onclick="disableFinanciamiento()">
                        <label class="form-check-label" for="contado_conexion">Conexion al contado ($250)</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="financiamiento_conexion"
                            name="financiamiento_conexion_bool" value="true" onclick="disableContado()">
                        <label class="form-check-label" for="financiamiento_conexion">Conexion con Financiamiento
                            ($150)</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="modal_hide()" class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar Servicio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= Redirection\format_url('servicio/update') ?>" id="FormularioB">


                    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                    <input type="hidden" name="id_de_cliente" value="<?php echo $id_de_cliente; ?>">
                    <input type="hidden" name="id_servicio" value="">

                    <div class="form-floating mb-3">
                        <div>
                            <label>N_Conexion</label>
                            <input class="form-control" name="n_conexion" type="number" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                            <label>N_Medidor</label>
                            <input class="form-control" name="n_medidor" type="number" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                            <label>Direccion</label>
                            <input class="form-control" type="text" name="direccion" />
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>




<!-- Modal  de Cambiar a que cliente le pertenece el servicio -->

<div class="modal fade" id="cambiarClienteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cambiar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="GET" action="<?= Redirection\format_url('servicio/update/cliente') ?>" id="cambiar_cliente">

                    <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">

                    <input type="hidden" name="id_principal" value="<?php echo $id_de_cliente; ?>">

                    <input type="hidden" name="id_servicio" value="">

                    <div class="form-group mb-3">
                        <label>Ingrese al Cliente para el Cambio de Servicio</label>
                        <select class="form-control" id="id_cliente_select" name="id_cliente" style="width:100%;">
                            <?php
                            foreach ($info_clientes as $cliente) {

                                echo '<option value="' . $cliente['id'] . '">' . $cliente['nombres'] . " : " . $cliente['cedula'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Cambiar de cliente</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Formulario de nueva notificacion -->
<form action="<?= Redirection\format_url('notificacion/new') ?>" method="post" class="d-none" id="nueva_notificacion_form">
    <input type="text" id="id_servicio_notificacion" name="id_servicio" value="">
    <input type="text" id="id_cliente_notificacion" name="id_cliente" value="">
    <input type="text" id="nombre_usuario_notificacion" name="nombre" value="">
</form>

<!-- Nueva notificacion -->
<div class="modal fade" id="notificacion" tabindex="-1" role="dialog" aria-labelledby="nuevaNotificacion"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuevaNotificacion">Emitir Notificación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Va a generar una notificacion para este servicio, ¿está seguro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="send_nueva_notificacion()">Confirmar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el servicio <span id="servicioId"></span> para el cliente <span
                    id="clienteNombre"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmarEliminacion">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function disableFinanciamiento() {
        document.getElementById("financiamiento_conexion").disabled = document.getElementById("contado_conexion").checked;
    }

    function disableContado() {
        document.getElementById("contado_conexion").disabled = document.getElementById("financiamiento_conexion").checked;
    }


    $(document).ready(function () {
        $('.open-confirm-modal').click(function () {
            var idServicio = $(this).data('id-servicio');
            var idCliente = $(this).data('id-cliente');
            var nombreCliente = $(this).data('nombre-cliente');

            // Actualizar el contenido del modal de confirmación con los datos relevantes
            $('#servicioId').text(idServicio);
            $('#clienteNombre').text(nombreCliente);

            // Asignar una función al botón "Confirmar" del modal
            $('#confirmarEliminacion').off('click').on('click', function () {
                // Construir la URL de redirección con los parámetros necesarios
                var redirectUrl = '<?= Redirection\format_url('servicio/delete') ?>?id_servicio=' + idServicio +
                    '&id_de_cliente=' + idCliente +
                    '&nombre=' + nombreCliente;

                // Redirigir al usuario a la página deseada
                window.location.href = redirectUrl;
            });
        });
    });


    function cambiarUser(button) {
        // Obtener una referencia al formulario
        var formulario = document.getElementById('cambiar_cliente');

        // Obtener el ID del servicio desde el atributo personalizado del botón
        var idServicio = button.getAttribute('data-id_servicio');

        // Llena un campo del formulario con el ID del servicio
        formulario.id_servicio.value = idServicio;

    }

    $(document).ready(function () {
        $('#id_cliente_select').select2({
            dropdownParent: $('#cambiarClienteModal')
        });

    });

    function modal_hide() {
        $('#registrar_servicio').modal('hide');
    }

    function datos(button) {
        // Obtener una referencia al formulario
        var formulario = document.getElementById('FormularioB');

        // Obtener los datos del cliente desde los atributos personalizados del botón

        var id_servicio = button.getAttribute('data-id_servicio');
        var id_de_cliente = button.getAttribute('data-id_cliente');
        var n_conexion = button.getAttribute('data-n_conexion');
        var n_medidor = button.getAttribute('data-n_medidor');
        var direccion = button.getAttribute('data-direccion');
        // Llena los campos del formulario con los datos del cliente
        formulario.id_servicio.value = id_servicio;
        formulario.id_de_cliente.value = id_de_cliente;
        formulario.n_conexion.value = n_conexion;
        formulario.n_medidor.value = n_medidor;
        formulario.direccion.value = direccion;
    }

    function nueva_notificacion(btn){
        var id_servicio = btn.getAttribute('data-id_servicio');
        var id_cliente =btn.getAttribute('data-id_cliente');
        var nombre_cliente =btn.getAttribute('data-nombre_cliente');
        $('#id_servicio_notificacion').val(id_servicio);
        $('#id_cliente_notificacion').val(id_cliente);
        $('#nombre_usuario_notificacion').val(nombre_cliente);
    }

    function send_nueva_notificacion(){
        $('#nueva_notificacion_form').submit();
    }

</script>

<?php Templates\loadTemplate("admin_footer.php"); ?>