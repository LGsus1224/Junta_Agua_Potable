<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $id_de_cliente = $_POST["id_de_cliente"];
    $id = (int)$_POST["id_servicio"];
    $n_conexion = (int)$_POST["n_conexion"];
    $n_medidor = (int)$_POST["n_medidor"];
    $direccion = $_POST["direccion"];
    $nombre = $_POST['nombre'];

    Redirection\checkRequestMethod("POST", "servicios/cliente?id=$id_de_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_servicio}', $id, APIurls\URLS::SERVICIOS['UPDATE']);

    // Datos a enviar en formato JSON
    $data = array(
        'n_conexion' => $n_conexion,
        'n_medidor' => $n_medidor,
        'direccion' => $direccion
    );

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect("servicios/cliente?id=$id_de_cliente&nombre=$nombre");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible actualizar el servicio",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("servicios/cliente?id=$id_de_cliente&nombre=$nombre");
}
