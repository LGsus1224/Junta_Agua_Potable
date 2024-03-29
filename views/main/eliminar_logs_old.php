<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("GET", "logs");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::LOGS['DELETE_OLD'];


    $response = Curls\curlDelete($url, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect('logs');
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible eliminar los logs antiguos",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect('logs');
}
