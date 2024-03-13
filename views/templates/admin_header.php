<?php
use Utils\Redirection;
use Utils\FlashMessages;
use Utils\Session;


Session\get_session();
$session_cookie = Session\get_session_cookie();
if (!isset($session_cookie)) {
        Session\logout();
        throw new Exception("Permiso insuficiente", 403);
}

$message = '';
$type = '';
$flash_message = FlashMessages\display_flash_message();
if (isset($flash_message)) {
    $message = $flash_message['message'];
    $type = $flash_message['type'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?= $title ?></title>
        <link rel="icon" href="<?= Redirection\format_url('img/logo.png') ?>">

        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <link href="<?= Redirection\format_url('css2/styles.css') ?>" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="<?= Redirection\format_url('css2/stilos.css') ?>">
        <link href="<?= Redirection\format_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?= Redirection\format_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">

        <!-- CDN Toastr -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <!-- Datatables -->
        <script src="<?= Redirection\format_url('js/datatables.js') ?>"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <!-- CDN DE PRINTJS.CRABBLY.COM -->
        <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
        <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body class="sb-nav-fixed">
        <header>
                <nav class="sb-topnav navbar navbar-expand navbar-light bg-primary shadow">
                        <!-- Navbar Brand-->
                        <a class="navbar-brand" href="<?= Redirection\format_url('dashboard') ?>">
                                <img src="<?= Redirection\format_url('img/logo.png') ?>" class=" img-fluid w-50 h-25 pb-4 pt-4 pl-0 pr-4" >
                        </a>
                        <!-- Sidebar Toggle-->
                        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
                        <!-- Navbar-->
                        <ul class="navbar-nav ms-auto  me-0 me-md-3 my-2 my-md-0">
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item btn" href="<?= Redirection\format_url('configuracion') ?>">Configuración</a></li>
                                        <li><hr class="dropdown-divider" /></li>
                                        <li>
                                                <form action="<?= Redirection\format_url('logout') ?>" method="post">
                                                        <button class="dropdown-item btn">Salir</button>
                                                </form>
                                        </li>
                                </ul>
                                </li>
                        </ul>
                </nav>
                <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu bg-primary">
                                <div class="nav ">
                                <a class="nav-link text-gray-100 shadow" href="<?= Redirection\format_url('dashboard') ?>">
                                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-gray-100"></i></div>
                                        Inicio
                                </a>
                                <a class="nav-link " href="<?= Redirection\format_url('administradores') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fas fa-user-shield text-gray-300"></i></div>
                                        Administradores
                                </a>
                                <hr class="bg-white ml-3 mr-3 mb-1 mt-1">
                                <a class="nav-link" href="<?= Redirection\format_url('clientes') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fas fa-user fa-fw"></i></div>
                                        Clientes
                                </a>
                                <hr class="bg-white ml-3 mr-3 mb-2 mt-2">
                                <a class="nav-link " href="<?= Redirection\format_url('planillas/pendientes') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fas fa-exclamation-circle text-gray-300"></i></div>
                                        Planillas Pendientes
                                </a>
                                <hr class="bg-white ml-3 mr-3 mb-2 mt-2">
                                <a class="nav-link " href="<?= Redirection\format_url('notificaciones') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fas fa-bell text-gray-300"></i></div>
                                        Notificaciones
                                </a>
                                <hr class="bg-white  ml-3 mr-3 mb-1 mt-1">
                                <a class="nav-link " href="<?= Redirection\format_url('servicios') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fas fa-clipboard-list text-gray-300"></i></div>
                                        Servicios Y Generar Planillas
                                </a>
                                <hr class="bg-white  ml-3 mr-3 mb-2 mt-2">

                                <a class="nav-link " href="<?= Redirection\format_url('logs') ?>" >
                                        <div class="sb-nav-link-icon text-gray-300"><i class="fa-solid fa-question text-gray-300"></i></div>
                                        Logs
                                </a>
                                <hr class="bg-white  ml-4 mr-4 mb-2 mt-2 ">

                                <a class="nav-link collapsed  shadow-sm" href="#" data-bs-toggle="collapse" data-bs-target="#collapseNewConfig" aria-expanded="false" aria-controls="collapseNewConfig">
                                        <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign text-gray-100"></i></div>
                                        Pagos de Conexión
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="collapseNewConfig">
                                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionNewConfig">
                                        <a class="nav-link " href="<?= Redirection\format_url('pagos/conexion/contado') ?>">
                                        Conexiones al Contado
                                        </a>
                                        </nav>
                                </div>
                                <div class="collapse" id="collapseNewConfig">
                                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionNewConfig">
                                        <a class="nav-link " href="<?= Redirection\format_url('pagos/conexion/financiamiento') ?>">
                                        Conexiones con Financiamiento
                                        </a>
                                        </nav>
                                </div>
                                <div class="collapse" id="collapseNewConfig">
                                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionNewConfig">
                                        <a class="nav-link " href="<?= Redirection\format_url('pagos/reconexion') ?>">
                                        Pagos por Reconexión
                                        </a>
                                        </nav>
                                </div>
                        </div>
                        </nav>
                </div>
                </div>
        </header>
        <main>
                <div id="layoutSidenav">
                <div id="layoutSidenav_content" class=" bg-light">