<?php

use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("POST", "clientes");

    $session_cookie = Session\get_session_cookie();

    $id = $_POST["cliente_id"];
    $cedula = $_POST["cedula"];
    $nombres = $_POST["nombres"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];

    $data = array(
        'cedula' => $cedula,
        'nombres' => $nombres,
        'apellidos' => $apellidos,
        'telefono' => $telefono
    );

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_cliente}', $id, APIurls\URLS::CLIENTES['UPDATE']);

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            'success'
        );
        Redirection\redirect("clientes");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible actualizar los registros",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect("clientes");
}
