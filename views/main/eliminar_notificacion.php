<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("POST", "notificaciones");

    $session_cookie = Session\get_session_cookie();

    $id_notificacion = $_POST['eliminar_notificacion_id'];

    // URL a la que deseas hacer la solicitud GET
    $url = str_replace('{id_notificacion}', $id_notificacion, APIurls\URLS::NOTIFICACIONES['DELETE']);

    $response = Curls\curlDelete($url, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect('notificaciones');
    } else if ($response[0] === 400) {
        throw new Exception($response[1]['error'],$response[0]);
    } else {
        throw new Exception("No fue posible eliminar la notificación",$response[0]);
    }
} catch(Exception $e){
    FlashMessages\create_flash_message(
        $e->getMessage(),
        'error'
    );
    Redirection\redirect('notificaciones');
}
