<?php
use Utils\APIUrls;
use Utils\Curls;
use Utils\Session;
use Utils\Redirection;
use Utils\FlashMessages;

try {
    Redirection\checkRequestMethod("POST","");

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Datos en formato JSON que voy a enviar a la solicitud
    $data = array(
        "username" => $usuario,
        "password" => $clave
    );


    // Establecer la URL de la API externa
    $url = APIUrls\URLS::AUTH['SIGN_IN'];

    $response = Curls\curlPost($url, $data, null);

    if ($response[0] === 200) {
        Session\login($response[2]);
        FlashMessages\create_flash_message(
            $response[1]['success'],
            'success'
        );

        Redirection\redirect("dashboard");
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible iniciar sesión",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e,
        'error'
    );
    Session\logout();
    Redirection\redirect("");
}
