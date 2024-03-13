<?php

// ini_set('display_errors',1);
// error_reporting(E_ALL);

include "config.php";

include "utils/APIurls.php";
include "utils/curls.php";
include "utils/user_session.php";
include "utils/redirection.php";
include "utils/flash_messages.php";
include "utils/templates.php";


// Rutas
include "routes/auth_routes.php";
include "routes/main_routes.php";


// Rutas permitidas
$allowedRoutes = array_merge(
    $authRoutes,
    $mainRoutes,
);

// Obtener la ruta de la solicitud
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remover la ruta base de la solicitud
$route = substr($requestUri, strlen(BASE_ROUTE));
$route = $route ?: '/'; // Si la ruta está vacía, se considera la raíz

try {
    // Comprobar si la ruta tiene mas direcciones y termina en /
    if ($route !== '/' && substr($route, -1) === '/') {
        $route = substr($route, 0, -1);
    }

    // Verificar si la ruta esta definida y cargar el archivo
    if (array_key_exists($route, $allowedRoutes)) {
        $viewFile = 'views/' . $allowedRoutes[$route];
        if (!file_exists($viewFile)) {
            throw new Exception('No existe el recurso');
        }
        // incluir el archivo de vista
        include $viewFile;
    }
    else {
        // Ruta no permitida, mostrar error 404
        http_response_code(404);
        include 'views/errors/404.php';
    }
} catch (Exception $e) {
    if ($e->getCode() === 403){
        include 'views/errors/403.php';
    } else {
        include 'views/errors/500.php';
    }
}
