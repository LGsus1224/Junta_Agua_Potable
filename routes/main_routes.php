<?php

$mainRoutes = [
    // MAIN
    '/dashboard' => 'main/dashboard.php',
    '/configuracion' => 'main/configuracion.php',
    '/update/configuracion' => 'main/actualizar_configuracion.php',


    // ADMIN
    '/administradores' => 'main/administradores.php',
    '/administrador/new' => 'main/registrar_administrador.php',
    '/administrador/restore/password' => 'main/actualizar_contraseña.php',
    '/administrador/delete' => 'main/eliminar_administrador.php',

    // CLIENTES
    '/clientes' => 'main/clientes.php',
    '/cliente' => 'main/descripcion_cliente.php',
    '/cliente/new' => 'main/registrar_cliente.php',
    '/cliente/update' => 'main/actualizar_cliente.php',
    '/cliente/delete' => 'main/eliminar_cliente.php',

    // SERVICIOS
    '/servicios' => 'main/servicios.php',
    '/servicios/cliente' => 'main/servicios_clientes.php',
    // '/servicio' => 'main/.php',
    '/servicio/new' => 'main/registrar_servicio.php',
    '/servicio/update' => 'main/actualizar_servicio.php',
    '/servicio/update/cliente' => 'main/actualizar_cliente_servicio.php',
    '/servicio/update/estado' => 'main/actualizar_estado_servicio.php',
    '/servicio/delete' => 'main/eliminar_servicio.php',

    // NOTIFICACIONES
    '/notificaciones' => 'main/notificaciones.php',
    // '/notificacion/servicio' => 'main/.php',
    '/notificacion/new' => 'main/nueva_notificacion.php',
    '/notificacion/update/pago' => 'main/actualizar_pago_notificacion.php',
    '/notificacion/delete' => 'main/eliminar_notificacion.php',
    '/notificaciones/delete/pagadas' => 'main/eliminar_notificaciones_pagadas.php',
    // '/notificaciones/servicio/delete/pagados' => 'main/.php',

    // PLANILLAS
    '/planillas/pendientes' => 'main/planillas_pendientes.php',
    '/planillas/servicio' => 'main/planillas.php',
    '/planilla' => 'main/planilla_descripcion.php',
    '/planilla/new' => 'main/registrar_planilla.php',
    '/planilla/update/lectura' => 'main/actualizar_lectura_planilla.php',
    '/planilla/update/pago' => 'main/actualizar_pago_planilla.php',
    '/planilla/delete' => 'main/eliminar_planilla.php',

    // LOGS
    '/logs' => 'main/logs.php',
    '/logs/delete/old' => 'main/eliminar_logs_old.php',

    // PAGOS CONEXION
    '/pagos/conexion/contado' => 'main/pagos_conexion_contado.php',
    '/pagos/conexion/financiamiento' => 'main/pagos_conexion_financiamiento.php',
    '/pagos/reconexion' => 'main/pagos_reconexion.php',
    '/pago/financiamiento/update/cuotas' => 'main/actualizar_pago_cuotas.php',
];
