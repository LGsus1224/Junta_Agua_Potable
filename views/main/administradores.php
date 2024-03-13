<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Administradores";
Templates\loadTemplate("admin_header.php");

include "obtenerAdministradores.php";
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Administradores</h1>
    <div>
        <!-- Content Row -->
        <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between shadow-sm">
                        <h6 class="m-0 font-weight-bold text-primary">Administradores</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="table-responsive shadow-sm">
                        <table id="tabla_administradores" class="crud-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Contraseña de un administrador</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($response as $key => $dato) {
                                    echo '<tr>';
                                    echo '<td>' . $key + 1 . '</td>';
                                    echo '<td>' . $dato['username'] . '</td>';
                                    echo '<td>';
                                    echo '<button title="Nueva contraseña para un administrador" type="button" class="btn btn-warning m-1 open-modal" data-toggle="modal" data-target="#actualizar_contraseña" data-id="' . $dato['id'] . '"onclick="password(this)">';
                                    echo '<i class="fas fa-sync"></i>';
                                    echo '</button>';
                                    echo '</td>';

                                    echo '<td>';
                                    echo '<button title="Eliminar Cliente" type="button" class="delete_administrador btn btn-danger m-1 open-confirm-modal" data-toggle="modal" data-target="#confirmModal_eliminar" data-id="' . $dato['id'] . '">';
                                    echo '<i class="fas fa-trash"></i>';
                                    echo '</button>';
                                    echo '</td>';
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


<div class="modal fade" id="actualizar_contraseña" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar información</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= Redirection\format_url('administrador/restore/password') ?>" id="FormularioE">

                    <input type="hidden" name="id_user" value="">

                    <div class="form-floating mb-3">
                        <div>
                            <label>Ingrese la nueva Contraseña</label>
                            <div class="d-flex">
                                <input class="form-control" id="new_password" name="new_password" type="password" />
                                <button id="toggleButton" class="btn btn-light" type="button"
                                    onclick="togglePassword('new_password',this)"><i
                                        class="fas fa-eye text-primary"></i></button>
                            </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<!-- Registrar Admins -->

<div class="modal fade" id="registrar_administradores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Administrador</h5>
                <button type="button" onclick="modal_hide()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="administrador/new">

                    <div class="form-floating mb-3">
                        <div>
                            <label>Ingrese el nombre del Administrador</label>
                            <input class="form-control" name="username" type="text" />
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <div>
                            <label>Ingrese la contraseña del administrador</label>
                            <div class="d-flex">
                                <input class="form-control" type="password" id="admin_password" name="password" />
                                <button id="toggleButton" class="btn btn-light" type="button"
                                    onclick="togglePassword('admin_password',this)"><i
                                        class="fas fa-eye text-primary"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="modal_hide()"
                            data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Eliminar Administrador -->
<div class="modal fade" id="confirmModal_eliminar" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este usuario administrador?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <a href="<?= Redirection\format_url('administrador/delete') ?>" id="confirmDelete" class="btn btn-primary">Sí</a>
            </div>
        </div>
    </div>
</div>

<script>
    function modal_hide() {
        $('#registrar_administradores').modal('hide');
    }

    function password(button) {
        // Obtener una referencia al formulario
        var formulario = document.getElementById('FormularioE');

        // Obtener los datos del cliente desde los atributos personalizados del botón
        var id_user = button.getAttribute('data-id');

        // Llena los campos del formulario modal con los datos del cliente
        formulario.id_user.value = id_user;
    }

    function togglePassword($passwordInputId, toggleButton) {
        var $toggleButton = $(toggleButton);
        var passwordInput = document.getElementById($passwordInputId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            $toggleButton.children().toggleClass("fas fa-eye-slash text-primary");
        } else {
            passwordInput.type = "password";
            $toggleButton.children().toggleClass("fas fa-eye text-primary");
        }
    }

    $('.delete_administrador').click(function() {
        confirm_delete = $('#confirmDelete');
        confirm_delete.attr('href',"<?= Redirection\format_url('administrador/delete?id=') ?>" + $(this).data('id'));
    });
</script>


<?php Templates\loadTemplate('admin_footer.php') ?>