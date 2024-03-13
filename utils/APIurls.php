<?php

namespace Utils\APIurls;


class URLS {
    const AUTH = [
        'SIGN_IN' => BASE_API . '/auth/sign_in',
        'LOGOUT' => BASE_API . '/auth/logout'
    ];

    const GENERAL = [
        'STATS' => BASE_API . '/general/get/stats',
        'STATS_COBROS_PLANILLAS' => BASE_API . '/general/get/stats/cobros/planilla',
        'STATS_COBROS_CONEXION' => BASE_API . '/general/get/stats/cobros/conexion',
        'GET_PLANILLAS_PENDIENTES' => BASE_API . '/general/get/planillas/pendientes',
    ];

    const CONFIGURACION = [
        'GET_DEFAULT' => BASE_API . '/configuracion/get/default',
        'UPDATE_DEFAULT' => BASE_API . '/configuracion/update/default'
    ];

    const LOGS = [
        'GET_ALL' => BASE_API . '/logs/get/all',
        'DELETE_OLD' => BASE_API . '/logs/delete/old'
    ];

    const ADMINISTRADORES = [
        'GET_ALL' => BASE_API . '/admin/get/all',
        'NEW' => BASE_API . '/admin/new',
        'RESET_PASSWORD' => BASE_API . '/admin/reset/password',
        'DELETE' => BASE_API . '/admin/delete/<id_admin>'
    ];

    const CLIENTES = [
        'GET_ALL' => BASE_API . '/clientes/get/all',
        'GET' => BASE_API . '/clientes/get/{id_cliente}',
        'NEW' => BASE_API . '/clientes/new',
        'UPDATE' => BASE_API . '/clientes/update/{id_cliente}',
        'DELETE' => BASE_API . '/clientes/delete/{id_cliente}'
    ];

    const SERVICIOS = [
        'GET_ALL' => BASE_API . '/servicios/get/all',
        'GET_ALL_CLIENTE' => BASE_API . '/servicios/get/all/{id_cliente}',
        'GET' => BASE_API . '/servicios/get/{id_servicio}',
        'NEW' => BASE_API . '/servicios/new',
        'UPDATE' => BASE_API . '/servicios/update/{id_servicio}',
        'UPDATE_CLIENTE' => BASE_API . '/servicios/update/cliente/{id_servicio}',
        'UPDATE_ESTADO' => BASE_API . '/servicios/update/estado/{id_servicio}',
        'DELETE' => BASE_API . '/servicios/delete/{id_servicio}'
    ];

    const NOTIFICACIONES = [
        'GET_ALL' => BASE_API . '/notificaciones/get/all',
        'GET_ALL_SERVICIO' => BASE_API . '/notificaciones/get/{id_servicio}',
        'NEW' => BASE_API . '/notificaciones/new/{id_servicio}',
        'UPDATE_PAGO' => BASE_API . '/notificaciones/update/pago/{id_notificacion}',
        'DELETE' => BASE_API . '/notificaciones/delete/{id_notificacion}',
        'DELETE_PAGADOS' => BASE_API . '/notificaciones/delete/pagados',
        'DELETE_SERVICIO_PAGADOS' => BASE_API . '/notificaciones/delete/pagados/{id_servicio}'
    ];

    const PLANILLAS = [
        'GET_ALL_SERVICIO' => BASE_API . '/planillas/get/all/{id_servicio}',
        'GET' => BASE_API . '/planillas/get/{id_planilla}',
        'NEW' => BASE_API . '/planillas/new',
        'UPDATE_LECTURA' => BASE_API . '/planillas/update/lectura/{id_planilla}',
        'UPDATE_PAGO' => BASE_API . '/planillas/update/pago/{id_planilla}',
        'DELETE' => BASE_API . '/planillas/delete/{id_planilla}',
    ];

    const PAGOS_CONEXION = [
        'GET_ALL_CONTADO' => BASE_API . '/pagos/contado/get/all',
        'GET_ALL_FINANCIAMIENTO' => BASE_API . '/pagos/financiamiento/get/all',
        'GET_ALL_RECONEXION' => BASE_API . '/pagos/reconexion/get/all',
        'UPDATE_PAGO_FINANCIAMIENTO' => BASE_API . '/pagos/financiamiento/update/cuotas/{id_pago}',
    ];
}
