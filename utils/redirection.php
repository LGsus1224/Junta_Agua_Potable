<?php

namespace Utils\Redirection;


use Utils\FlashMessages;

function redirect($ruta){
    $new_route = APP_BASE_URL . $ruta;
    header("Location: $new_route");
    exit;
}


function format_url($ruta){
    $new_route = APP_BASE_URL . $ruta;
    return $new_route;
}


function checkRequestMethod(string $method, string $redirect_to){
    if ($_SERVER['REQUEST_METHOD'] !== $method) {
        FlashMessages\create_flash_message("Metodo no soportado", 'error');
        redirect($redirect_to);
    }
    return true;
}
