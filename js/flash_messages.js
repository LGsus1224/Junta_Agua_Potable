function showFlashMessages (message, type){
    var alerta = message;
    if (alerta!='') {
        var tipo = type;
        if (tipo=="error") {
            toastr.error('',alerta,{
                "closeButton": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            });
        }
        else if (tipo=="success"){
            toastr.success('',alerta,{
                "closeButton": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
            });
        }
        else if (tipo=="warning"){
            toastr.warning('',alerta,{
                "closeButton": true,
                "newestOnTop": false,
                "positionClass": "toast-top-right",
                "timeOut": 0,
                "extendedTimeOut": 0,
                "tapToDismiss": false
            });
        }
    }
}