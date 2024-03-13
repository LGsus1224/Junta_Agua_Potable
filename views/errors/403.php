<?php
use Utils\Redirection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403</title>
    <link rel="icon" href="<?= Redirection\format_url('img/logo.png') ?>">
    <link href="<?= Redirection\format_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= Redirection\format_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 100vh">
        <h1 class="text-center display-1 fw-bold">403</h1>
        <h2 class="text-center">Acceso denegado</h2>
        <p class="text-center lead">No tienes permiso para acceder a este recurso.</p>
        <a href="<?= Redirection\format_url('') ?>" class="btn btn-primary">Volver al inicio</a>
    </div>
</body>
</html>