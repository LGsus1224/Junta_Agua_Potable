<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    Redirection\checkRequestMethod("GET", "dashboard");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::CONFIGURACION['GET_DEFAULT'];

    $response = Curls\curlGet($url, $session_cookie);

    if ($response[0] === 200) {
        $configuracion = $response[1]['success'];

        // Acceder a los datos del cliente
        $consumo_base = $configuracion['consumo_base'];
        $exedente = $configuracion['exedente'];
        $valor_consumo_base = $configuracion['valor_consumo_base'];
        $valor_exedente = $configuracion['valor_exedente'];
        $reconexion = $configuracion['reconexion'];
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
    Redirection\redirect('dashboard');
}
