<?php
use Utils\Redirection;
use Utils\Session;
use Utils\FlashMessages;


$session_cookie = Session\get_session_cookie();
if (isset($session_cookie)) {
    Redirection\redirect('dashboard');
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
    <meta name="description" content="Junta de Agua Potable 'La Chongona'" />
    <meta name="author" content="Softec" />
    <title>Inicia sesión</title>

    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="<?= Redirection\format_url('img/logo.png') ?>">
    <link href="<?= Redirection\format_url('css2/styles.css') ?>" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="<?= Redirection\format_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <!-- CDN Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content" class=" bg-gradient-dark">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-5 rounded-4 mt-5">
                                <div class="card-header border-5 rounded-4 shadow" class="carta" id="carta">
                                    <h3 class="text-center font-weight-light my-4">
                                    <img src="<?= Redirection\format_url('img/logo.png') ?>">
                                    </h3>
                                </div>
                                <div class="card-body ">
                                    <form method="post" action="<?= Redirection\format_url('sign_in') ?>">
                                        <div class="form-floating mb-3">

                                            <div>
                                                <label for="inputEmail">Usuario</label>
                                                <div class="input-group">
                                                    <input class="form-control rounded-5 pt-4 pb-4" name="usuario" id="inputEmail" type="text" placeholder="Usuario" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text bg-white border-0">
                                                        <i class="fa-regular fa-user"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <label for="inputPassword">Contraseña</label>
                                        <div class="form-floating mb-3">
                                            <div class="input-group">
                                                <input class="form-control rounded-5 pt-4 pb-4" id="inputPassword" type="password" name="clave" placeholder="Contraseña" />
                                                <div class="input-group-append">
                                                    <span id="togglePassword" class="input-group-text bg-white border-0">
                                                    <i class="fa-solid fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" mx-auto">
                                        <button type="submit" class="btn btn-dark btn-block rounded-5 bg-info mt-4 border-0" id="inicio">
                                        Iniciar Sesión
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            const passwordField = document.getElementById("inputPassword");
            const toggleIcon = document.getElementById("toggleIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye");
                toggleIcon.classList.add("bi-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye-slash");
                toggleIcon.classList.add("bi-eye");
            }
        });
    </script>
    <script src="<?= Redirection\format_url('js/flash_messages.js') ?>"></script>
    <script>
        $(document).ready(function() {
            showFlashMessages('<?= $message; ?>', '<?= $type; ?>');
        });
    </script>
</body>
</html>
