<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("GET", "clientes");

    $session_cookie = Session\get_session_cookie();

    $id = $_GET['id'];

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_cliente}', $id, APIurls\URLS::CLIENTES['GET']);

    $response = Curls\curlGet($url, $session_cookie);

    if ($response[0] === 200) {
        $cliente = $response[1]['success'];
        // Ahora accedes a los datos del cliente
        $cedula = $cliente['cedula'];
        $nombres = $cliente['nombres'];
        $apellidos = $cliente['apellidos'];
        $telefono = $cliente['telefono'];
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
    Redirection\redirect('clientes');
}