<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $nombre = $_GET['nombre'];
    $id_servicio = $_GET['id_servicio'];
    $id_de_cliente = $_GET['id_de_cliente'];

    Redirection\checkRequestMethod("GET", "servicios/cliente?id=$id_de_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_servicio}', $id_servicio, APIurls\URLS::SERVICIOS['DELETE']);

    $response = Curls\curlDelete($url, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect("servicios/cliente?id=$id_de_cliente&nombre=$nombre");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible eliminar el servicio del cliente",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("servicios/cliente?id=$id_de_cliente&nombre=$nombre");
}
