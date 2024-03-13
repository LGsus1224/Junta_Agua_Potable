<?php
use Utils\Templates;
use Utils\Redirection;


$title = "Planilla";
Templates\loadTemplate("admin_header.php");

include "obtenerPlanilla.php";


 if ($servicio && isset($servicio['servicio'])) {
     $datos_servicio= $servicio['servicio'];

     // Ahora puedes acceder a los datos de estadisticas
     $id_servicio = $datos_servicio['id'];
     $n_conexion = $datos_servicio['n_conexion'];
     $n_medidor = $datos_servicio['n_medidor'];
     $id_cliente = $datos_servicio['id_cliente'];
     $direccion = $datos_servicio['direccion'];
     $lectura_anterior = $datos_servicio['lectura_anterior'];
 }


 if (isset($servicio['cliente'])) {
     $datos_cliente = $servicio['cliente'];

     // Accede a las propiedades del cliente solo si existen
     $cedula = $datos_cliente['cedula'];
     $nombres = $datos_cliente['nombres'] ;
     $apellidos = $datos_cliente['apellidos'] ;
     $telefono = $datos_cliente['telefono'] ;
     // Continúa de esta manera para otras propiedades del cliente
 }
 if (isset($servicio['fecha_emision'])) {

     $fechaEmision = $servicio['fecha_emision'];
     $consumo_base = $servicio['consumo_base'];
     $exedente = $servicio['exedente'];
     $valor_consumo_base = $servicio['valor_consumo_base'];
     $valor_exedente = $servicio['valor_exedente'];
     $lectura_anterior = $servicio['lectura_anterior'];
     $lectura_actual = $servicio['lectura_actual'];
     $consumo_total = $servicio['consumo_total'];
     $valor_consumo_total = $servicio['valor_consumo_total'];
 }


$fecha_array = explode("/", $fechaEmision);

if (count($fecha_array) === 3) {
    $mes_numero = $fecha_array[1];
    $nombres_meses = [
        1 => " Enero",
        2 => " Febrero",
        3 => " Marzo",
        4 => " Abril",
        5 => " Mayo",
        6 => " Junio",
        7 => " Julio",
        8 => " Agosto",
        9 => " Septiembre",
        10 => " Octubre",
        11 => " Noviembre",
        12 => " Diciembre"
    ];
    $nombre_mes = $nombres_meses[intval($mes_numero)];
}
?>


<div class="row d-flex">
    <div class="col-auto pl-5 pt-4 m-1">
        <a href="<?= Redirection\format_url("planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombres") ?>" class="btn btn-primary">Regresar</a>
    </div>

    <div class="col-auto pl-5 pt-4 m-1">
        <button type="button" class="btn btn-danger" onclick="imprimirPlanilla()">PDF</button>
    </div>
</div>

<div class="col-12" id="planilla_imprimir" >
    <!-- Project Card Example -->
    <div class="card shadow m-3" >
        <div class="card-header row m-0 ">
            <div class="text-left col-6">
            <h6 class="m-0 font-weight-bold text-info">Ministerio del Ambiente</h6>
            <h6 class="m-0 font-weight-bold text-info">Agua y Transición Ecológica</h6>
            </div>
            <div class="text-center col-6">
            <h6 class="m-0 font-weight-bold text-info">Junta Administrativa de Agua Potable "La Chongona"</h6>
            <h6 class="m-0 font-weight-bold text-info">FACTURA DE COBRO POR SERVICIOS</h6>
            </div>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h4 class="small font-weight-bold m-3">Nombre del Usuario : <?php echo $nombres; ?> </h4>
                <div class="m-1"></div>
                <h4 class="small font-weight-bold m-3">Consumo del Mes de : <?php echo $nombre_mes; ?> </h4>
                <div class="m-1"></div>
                <h4 class="small font-weight-bold m-3">Fecha de Emisión :  <?php echo $fechaEmision; ?> </h4>
                <div class="m-1"></div>
            </div>
            <div class="col-6">
                <h4 class="small font-weight-bold m-3">Conexión Nª : <?php echo $n_conexion; ?></h4>
                <div class="m-1"></div>
                <h4 class="small font-weight-bold m-3">Numero de Medidor : <?php echo $n_medidor; ?></h4>
                <div class="m-1"></div>
                <h4 class="small font-weight-bold m-3">Dirección :  <?php echo $direccion; ?></h4>
                <div class="m-1"></div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="text-left col-4 ">
                <h4 class="small font-weight-bold m-3">Lectura actual: <?php echo $lectura_actual; ?></h4>
            </div>
            <div class="text-center col-4 ">
                <h4 class="small font-weight-bold m-3">Lectura_anterior: <?php echo $lectura_anterior; ?></h4>
            </div>
            <div class="text-rigth col-4 ">
                <h4 class="small font-weight-bold text-right m-3">Consumo M³: <?php echo $consumo_total; ?> </h4>
            </div>
            <div class="text-rigth col-4 ">
                <h4 class="small font-weight-bold text-right m-3">Tarifa: <?php echo $consumo_base; ?> M X <?= number_format($valor_consumo_base, 2) ?></h4>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-4 mb-5">
        <table class="table">
            <thead class="font-weight-bold text-info">
                <tr>
                    <th class="border-bottom border-info">Conceptos</th>
                    <th class="border-bottom border-info">Cantidad</th>
                    <th class="border-bottom border-info">Valores</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CONSUMO</td>
                    <td><?= $consumo_total ?> M</td>
                    <td>$ <?= number_format($valor_consumo_base, 2) ?></td>
                </tr>
                <tr>
                    <td>EXCEDENTE</td>
                    <td><?= $consumo_total - $consumo_base ?> M X <?= $valor_exedente ?></td>
                    <td>$ <?= number_format(($consumo_total - $consumo_base)*$valor_exedente, 2) ?></td>
                </tr>
                <tr class="font-weight-bold">
                    <td>TOTAL</td>
                    <td><?= $consumo_total ?> M</td>
                    <td>$ <?= number_format($valor_consumo_total, 2) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="form-group w-50">
                <input class="form-control" type="text" id="recaudador">
                <label class="d-flex justify-content-center align-items-center font-weight-bold" for="recaudador">Recaudador</label>
            </div>
        </div>
    </div>
</div>

<div class="print-content">
    <div class="d-flex">
        <p><b>Impreso el: </b></p>
        <p id="fecha-emision-planilla"></p>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div>
            <div class="signer-space"></div>
            <div class="text-center">
                <p><b>Firma. Presidente de Junta de Agua</b></p>
            </div>
        </div>
    </div>
</div>

<script>
    function imprimirPlanilla() {
        var d = new Date();
        var strDate = (d.getFullYear() + "/" + (d.getMonth()+1) + "/" + d.getDate() +
            " a las " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2));
        $('#fecha-emision-planilla').text(strDate);
        printJS({
            printable:"planilla_imprimir",
            type:"html",
            css:["css/sb-admin-2.css","css2/stilos.css"],
        })
    }
</script>


<?php Templates\loadTemplate("admin_footer.php"); ?>