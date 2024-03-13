<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $id_servicio = $_POST['id_servicio'];
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];

    Redirection\checkRequestMethod("POST", "servicios/cliente?id=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_servicio}', $id_servicio, APIurls\URLS::NOTIFICACIONES['NEW']);

    $response = Curls\curlPost($url, null, $session_cookie);

    if ($response[0] === 201) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible crear la notificación del servicio",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
}
