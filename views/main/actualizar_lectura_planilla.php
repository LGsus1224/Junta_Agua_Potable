<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $id_servicio = $_POST['id_servicio'];
    $id_planilla = $_POST['id_planilla'];
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $nueva_lectura = (int)$_POST["nueva_lectura"];

    Redirection\checkRequestMethod("POST", "planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_planilla}', $id_planilla, APIurls\URLS::PLANILLAS['UPDATE_LECTURA']);

    // Datos que deseas enviar en la solicitud PUT (en este ejemplo, un array asociativo)
    $data = array(
        'nueva_lectura' => $nueva_lectura,
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
