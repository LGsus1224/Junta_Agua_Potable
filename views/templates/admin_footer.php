<?php
use Utils\Redirection;
?>

</div></div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= Redirection\format_url('js/scripts.js') ?>"></script>
<script src="<?= Redirection\format_url('js/flash_messages.js') ?>"></script>
<script>
    $(document).ready(function() {
        showFlashMessages('<?= $message; ?>', '<?= $type; ?>');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="<?= Redirection\format_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>