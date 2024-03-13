<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $id_servicio = $_GET['id_servicio'];
    $id_planilla = $_GET['id_planilla'];
    $id_cliente = $_GET['id_cliente'];
    $nombre = $_GET['nombre'];
    $pagado = ($_GET["pagado"] == "1") ? true : false;

    Redirection\checkRequestMethod("GET", "planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_planilla}', $id_planilla, APIurls\URLS::PLANILLAS['UPDATE_PAGO']);

    // Datos que deseas enviar en la solicitud PUT (en este ejemplo, un array asociativo)
    $data = array(
        'id_planilla' => $id_planilla, // Reemplaza con el ID de la planilla que deseas actualizar
        'pagado' => $pagado, // El nuevo valor para el campo "pagado"
    );

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
    Redirection\redirect("planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombre");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible registrar el usuario",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombre");
}
