<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("POST", "administradores");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::ADMINISTRADORES['RESET_PASSWORD'];

    $id_user = (int)$_POST['id_user'];
    $new_password = $_POST['new_password'];

    // Datos que deseas enviar en la solicitud PUT (en formato JSON)
    $data = array(
        'id_user' => $id_user,
        'new_password' => $new_password,
    );

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect('administradores');
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
    Redirection\redirect('administradores');
}
