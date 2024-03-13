<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $id_servicio = $_GET['id'];
    $id_cliente = $_GET['id_cliente'];
    $nombre = $_GET['nombre'];

    Redirection\checkRequestMethod("GET", "servicios/cliente?id=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_servicio}', $id_servicio, APIurls\URLS::PLANILLAS['GET_ALL_SERVICIO']);

    $response = Curls\curlGet($url, $session_cookie);

    if ($response[0] === 200) {
        $response = $response[1]['success'];
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible obtener los registros",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
}
