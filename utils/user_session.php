<?php

namespace Utils\Session;
use Exception;


function get_session(){
    if (session_status() == PHP_SESSION_NONE) {
        // Solo inicia la sesión si no hay una sesión activa
        session_start();
    }
}

function login($cookie){
    get_session();
    $_SESSION["session-cookie"] = $cookie;
}

function logout(){
    get_session();
    unset($_SESSION['session-cookie']);
    session_destroy();
}

function get_session_cookie(){
    try {
        get_session();
        if (isset($_SESSION['session-cookie'])) {
            return $_SESSION['session-cookie'];
        }
        return null;
    } catch (Exception) {
        return null;
    }
}
