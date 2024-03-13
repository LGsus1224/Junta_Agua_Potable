<?php

namespace Utils\Curls;


// Función POST
function curlPost($url,$data=null,$session_cookie=null,$json=true)
{
    try {
        $headers=array();

        // Inicializar cURL
        $ch = curl_init();

        //Verificación de tipo de formulario
        if ($json==false) {
            array_push($headers,'Content-Type: application/x-www-form-urlencoded');
        }else {
            array_push($headers,'Content-Type: application/json');
        }

        //Cabecera de autenticación
        if ($session_cookie!=null) {
            curl_setopt($ch, CURLOPT_COOKIE, "session=$session_cookie");
        }
        curl_setopt($ch, CURLOPT_COOKIEFILE, "");

        // Configurar las opciones de cURL para una solicitud POST
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true); // Configura la solicitud como POST
        if ($data != null) {
            if ($json==false) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query ($data)); // Define los datos a enviar en la solicitud
            }else{
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Define los datos a enviar en la solicitud
            }
        }

        // Configura las cabeceras si es necesario
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Realizar la solicitud
        $response = curl_exec($ch);
        $response = json_decode($response,true);

        // Cerrar la sesión cURL
        curl_close($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $cookies = curl_getinfo($ch, CURLINFO_COOKIELIST);

        // Configurar partes de la cookie
        $cookieParts = explode("\t", $cookies[0]);
        $cookieName = $cookieParts[5];
        if ($cookieName === 'session'){
            $cookie = $cookieParts[6];
        } else {
            $cookie = null;
        }
        return [
            $httpCode,
            $response,
            $cookie
        ];
    }catch (Exception){
        return [
            400,
            ['error' => 'No se pudo resolver'],
            $cookie
        ];
    }
}


// Función GET
function curlGet($url, $session_cookie = null, $json=true)
{
    try {
        $headers = ['Content-Type: application/json'];

        // Inicializar cURL
        $ch = curl_init();

        // Cabecera de autenticación
        if ($session_cookie != null) {
            curl_setopt($ch, CURLOPT_COOKIE, "session=$session_cookie");
        }

        // Configurar las opciones de cURL para una solicitud GET
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Configurar las cabeceras si es necesario
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Realizar la solicitud
        $response = curl_exec($ch);
        $response = json_decode($response, true);

        // Cerrar la sesión cURL
        curl_close($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return [
            $httpCode,
            $response
        ];
    } catch (Exception) {
        return [
            400,
            ['error' => "No se pudo resolver"],
        ];
    }
}


// Funcion PUT
function curlPut($url, $data=null, $session_cookie=null,$json=true)
{
    try {
        $headers = ['Content-Type: application/json'];

        // Inicializar cURL
        $ch = curl_init();

        if ($session_cookie != null) {
            curl_setopt($ch, CURLOPT_COOKIE, "session=$session_cookie");
        }

        // Configurar las opciones de cURL para una solicitud PUT
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if ($data != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // Realizar la solicitud
        $response = json_decode(curl_exec($ch), true);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Cerrar la sesión cURL
        curl_close($ch);

        return [
            $httpCode,
            $response
        ];
    } catch (Exception ) {
        return [
            400,
            ['error' => "No se pudo resolver"],
        ];
    }
}

// Funcion DELETE
function curlDelete($url, $session_cookie = null, $json=true)
{
    try {
        $headers = ['Content-Type: application/json'];

        // Inicializar cURL
        $ch = curl_init();

        // Cabecera de autenticación
        if ($session_cookie != null) {
            curl_setopt($ch, CURLOPT_COOKIE, "session=$session_cookie");
        }

        // Configurar las opciones de cURL para una solicitud DELETE
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Configurar las cabeceras si es necesario
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Realizar la solicitud
        $response = json_decode(curl_exec($ch), true);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Cerrar la sesión cURL
        curl_close($ch);

        return [
            $httpCode,
            $response
        ];
    } catch (Exception ) {
        return [
            400,
            ['error' => "No se pudo resolver"],
        ];
    }
}
