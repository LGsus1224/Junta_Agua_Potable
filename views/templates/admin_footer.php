<?php
use Utils\Redirection;

include(__DIR__ . "/../main/obtenerNotificaciones.php");
$notificaciones = $response;
?>

</div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= Redirection\format_url('js/scripts.js') ?>"></script>
<script src="<?= Redirection\format_url('js/flash_messages.js') ?>"></script>
<script>
    $(document).ready(function() {
        showFlashMessages('<?= $message; ?>', '<?= $type; ?>');
    });
</script>
<script>
    $(document).ready(function (){
        var notificaciones_array = JSON.parse('<?= json_encode($notificaciones) ?>')
        if (notificaciones_array.length > 0) {
            showFlashMessages(`
            <div>
                <p>Existen notificaciones pendientes.</p>
                <a href="<?= Redirection\format_url('notificaciones') ?>" class="btn sm-btn btn-secondary">Revíselas</a>
            </div>
            `, 'warning');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= Redirection\format_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>