<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Cliente";
Templates\loadTemplate("admin_header.php");

include "obtenerDescripcionCliente.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <a href="<?= Redirection\format_url('clientes') ?>" class="btn btn-primary">Regresar</a>
        </div>
        <div class="col-12 text-center">
            <div class="card shadow mt-3">
                <div class="card-header ">
                    <h5 class="m-0 font-weight-bold text-primary">Información del cliente</h5>
                </div>
                <div class="card-body">

                    <h4 class="small font-weight-bold">Cédula <span class="float-right"></span></h4>
                    <div class="m-1">
                    <?php echo $cedula ?>
                    </div>

                    <h4 class="small font-weight-bold">Nombres <span class="float-right"></span></h4>
                    <div class="m-1">
                    <?php echo $nombres ?>
                    </div>

                    <h4 class="small font-weight-bold">Apellidos <span class="float-right"></span></h4>
                    <div >
                    <?php echo $apellidos ?>
                    </div>

                    <h4 class="small font-weight-bold">Teléfono <span class="float-right"></span></h4>
                    <div >
                    <?php echo $telefono ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php Templates\loadTemplate("admin_footer.php"); ?>
