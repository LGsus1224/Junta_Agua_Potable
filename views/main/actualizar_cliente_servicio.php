<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $nombre = $_GET['nombre'];
    $id_principal = $_GET['id_principal'];
    $id_servicio = $_GET['id_servicio'];
    $id_cliente = (int)$_GET['id_cliente'];

    Redirection\checkRequestMethod("GET", "servicios/cliente?id=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_servicio}', $id_servicio, APIurls\URLS::SERVICIOS['UPDATE_CLIENTE']);

    // Datos a enviar en formato JSON
    $data = array(
        'id_cliente' => $id_cliente,
    );

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible actualizar el cliente del servicio",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
}
