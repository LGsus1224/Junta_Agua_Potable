<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("POST", "configuracion");

    $session_cookie = Session\get_session_cookie();

    $consumo_base = (float)$_POST['consumo_base'];
    $exedente = (float)$_POST['exedente'];
    $valor_consumo_base = (float)$_POST['valor_consumo_base'];
    $valor_exedente = (float)$_POST['valor_exedente'];
    $reconexion = (float)$_POST['reconexion'];

    $data = [
        'consumo_base' => $consumo_base,
        'exedente' => $exedente,
        'valor_consumo_base' => $valor_consumo_base,
        'valor_exedente' => $valor_exedente,
        'reconexion' => $reconexion
    ];

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::CONFIGURACION['UPDATE_DEFAULT'];

    $response = Curls\curlPut($url, $data, $session_cookie);

    if ($response[0] === 200) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            'success'
        );
        Redirection\redirect("configuracion");
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
    Redirection\redirect("configuracion");
}
