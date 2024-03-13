<?php
use Utils\APIurls;
use Utils\Redirection;
use Utils\Curls;
use Utils\Session;
use Utils\FlashMessages;


try {
    $nombre = $_POST["nombre"];
    $id_cliente = (int)$_POST["id_cliente"];
    $n_conexion = (int)$_POST["n_conexion"];
    $n_medidor = (int)$_POST["n_medidor"];
    $direccion = $_POST["direccion"];
    $estado = ($_POST["estado"] == "1") ? true : false;
    $lectura_anterior = (int)$_POST["lectura_anterior"];
    $contado_conexion = isset($_POST["contado_conexion_bool"]) && $_POST["contado_conexion_bool"] == "true";
    $financiamiento_conexion = isset($_POST["financiamiento_conexion_bool"]) && $_POST["financiamiento_conexion_bool"] == "true";

    Redirection\checkRequestMethod("POST", "servicios/cliente?id=$id_cliente&nombre=$nombre");

    $session_cookie = Session\get_session_cookie();

    // URL a la que deseas hacer la solicitud GET
    $url = APIurls\URLS::SERVICIOS['NEW'];

    // Datos a enviar en la solicitud cURL
    $data = array(
        'id_cliente' => $id_cliente,
        'n_conexion' => $n_conexion,
        'n_medidor' => $n_medidor,
        'direccion' => $direccion,
        'estado' => $estado,
        'lectura_anterior' => $lectura_anterior,
        'contado_conexion'=> $contado_conexion,
        'financiamiento_conexion'=> $financiamiento_conexion
    );

    $response = Curls\curlPost($url, $data, $session_cookie);

    if ($response[0] === 201) {
        FlashMessages\create_flash_message(
            $response[1]['success'],
            "success"
        );
        Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
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
    Redirection\redirect("servicios/cliente?id=$id_cliente&nombre=$nombre");
}
