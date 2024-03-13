<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Clientes";
Templates\loadTemplate("admin_header.php");

include "obtenerClientes.php";
?>

<div class="container-fluid px-4">
    <div class="mt-4"></div>

    <div class="row">
        <!-- Contenedor de tablas -->
        <div class="col-12">
            <div class="card shadow">
                    <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between shadow-sm">
                    <h6 class="m-0 font-weight-bold text-primary">Clientes </h6>

                </div>

                <div class="table-responsive crud-table shadow-sm">
                    <table id="tabla_clientes">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Teléfono</th>
                                <th class="exclude">Información</th>
                                <th class="exclude">Actualizar</th>
                                <th class="exclude">Servicios</th>
                                <th class="exclude">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php

                        foreach ($info_clientes as $dato) {
                            echo '<tr>';
                            echo'<td>' .$dato['cedula'] .'</td>';
                            echo'<td>' .$dato['nombres'] .'</td>';
                            echo'<td>' .$dato['apellidos'] .'</td>';
                            echo'<td>' .$dato['telefono'] .'</td>';

                            echo '<td>';
                            echo '<a href="' . Redirection\format_url('cliente') . '?id=' . $dato['id'] . '">';
                            echo '<button title="Informacion del cliente" type="button" class="btn btn-primary m-1">';
                            echo '<i class="fas fa-info-circle"></i>';
                            echo '</button>';
                            echo '</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<button title="Actualizar cliente" type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#actualizar" data-id="' . $dato['id'] . '" data-cedula="' . $dato['cedula'] . '" data-nombres="' . $dato['nombres'] . '" data-apellidos="' . $dato['apellidos'] . '" data-telefono="' . $dato['telefono'] . '" onclick="datos(this)">';
                            echo '<i class="fas fa-sync"></i>';
                            echo '</button>';
                            echo '</td>';
                            echo '<td>';
                            echo '<a href="'.Redirection\format_url('servicios/cliente').'?id=' . $dato['id'] . '&nombre=' . $dato['nombres'] . '">';
                            echo '<button title="Servicios del cliente" type="button" class="btn btn-success m-1">';
                            echo '<i class="fas fa-clipboard-list"></i>';
                            echo '</button>';
                            echo '</a>';
                            echo '</td>';
                            echo '<td>';
                            echo '<button title="Eliminar Cliente" type="button" class="btn btn-danger m-1 open-confirm-modal" data-toggle="modal" data-target="#confirmModal" data-id="' . $dato['id'] . '">';
                            echo '<i class="fas fa-trash"></i>';
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


<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Cliente</h5>
                <button type="button" onclick="modal_hide()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="<?= Redirection\format_url('cliente/new') ?>">

                    <div class="form-floating mb-3">
                        <div >
                            <label >Cédula</label>
                            <input class="form-control" name="cedula" type="text"/>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                        <label >Nombres</label>
                        <input class="form-control"  type="text" name="nombres" />
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div>
                        <label >Apellidos</label>
                        <input class="form-control"  type="text" name="apellidos" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                        <label >Teléfono</label>
                        <input class="form-control"  type="text" name="telefono" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="modal_hide()" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= Redirection\format_url('cliente/update') ?>" id="FormularioA">
                    <input type="hidden" name="cliente_id" value="">
                    <div class="form-floating mb-3">
                        <div >
                            <label >Cédula</label>
                            <input class="form-control"  name="cedula"  type="text"/>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                        <label >Nombres</label>
                        <input class="form-control"  name="nombres" type="text" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                        <label >Apellidos</label>
                        <input class="form-control"  type="text" name="apellidos" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                        <label >Teléfono</label>
                        <input class="form-control"  type="text" name="telefono" />
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

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="<?= Redirection\format_url('cliente/delete') ?>" id="confirmDelete" class="btn btn-primary">Sí</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".open-confirm-modal").click(function() {
            var id = $(this).data("id");
            $("#confirmDelete").attr("href", "<?= Redirection\format_url('cliente/delete') ?>?id=" + id);
        });
    });
    function modal_hide() {
        $('#registrar').modal('hide');
    }

    function datos(button) {
        // Obtener una referencia al formulario
        var formulario = document.getElementById('FormularioA');

        // Obtener los datos del cliente desde los atributos personalizados del botón
        var id = button.getAttribute('data-id');
        var cedula = button.getAttribute('data-cedula');
        var nombres = button.getAttribute('data-nombres');
        var apellidos = button.getAttribute('data-apellidos');
        var telefono = button.getAttribute('data-telefono');

        // Llena los campos del formulario modal con los datos del cliente
        formulario.cliente_id.value = id;
        formulario.cedula.value = cedula;
        formulario.nombres.value = nombres;
        formulario.apellidos.value = apellidos;
        formulario.telefono.value = telefono;
    }
</script>

<?php Templates\loadTemplate("admin_footer.php"); ?>
