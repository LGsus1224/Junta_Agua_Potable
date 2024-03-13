<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $nombre = $_POST["nombre"];
    $id_cliente = (int)$_POST["id_cliente"];
    $id_servicio = (int)$_POST["id_servicio"];
    $lectura_actual = (int)$_POST["lectura_actual"];

    Redirection\checkRequestMethod("POST", "planillas/servicio?id=$id_servicio&id_cliente=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::PLANILLAS['NEW'];

    // Datos a enviar en la solicitud cURL
    $data = array(
        'lectura_actual' => $lectura_actual,
        'id_servicio' => $id_servicio
    );

    $response = Curls\curlPost($url, $data, $session_cookie);

    if ($response[0] === 201) {
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
