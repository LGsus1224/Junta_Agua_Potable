<?php
use Utils\APIUrls;
use Utils\Curls;
use Utils\Session;
use Utils\Redirection;
use Utils\FlashMessages;

try {
    Redirection\checkRequestMethod("POST","");

    $session_cookie = Session\get_session_cookie();

    // Establecer la URL de la API externa
    $url = APIUrls\URLS::AUTH['LOGOUT'];

    $response = Curls\curlPost($url, null, $session_cookie);

    if ($response[0] === 200) {
        Session\logout();
        FlashMessages\create_flash_message("Sesión terminada","success");
        Redirection\redirect("");
    } else {
        throw new Exception("Hubo un problema. Cerramos su sesión por su seguridad", $response[0]);
    }
} catch(Exception $e){
    Session\logout();
    FlashMessages\create_flash_message($e,"error");
    Redirection\redirect("");
}
