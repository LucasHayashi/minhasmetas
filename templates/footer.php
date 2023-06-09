<footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
        <span class="mb-3 mb-md-0 text-body-secondary">© MinhasMetas - Desenvolvido por Lucas Hayashi</span>
    </div>
</footer>

<script src="./includes/DataTables/datatables.min.js"></script>
<script src="./includes/jquery-mask-plugin/jquery.mask.min.js"></script>
<script src="./includes/jquery-maskmoney-3.0.2/jquery.maskMoney.min.js"></script>
<script src="./includes/bootstrap-datepicker-1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="./includes/bootstrap-datepicker-1.10.0/locales/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>
<script src="./includes/notifyjs/notify.min.js"></script>
<script src="./js/main-script.js"></script>
<?php
if (isset($extraScripts)) {
    foreach ($extraScripts as $script) {
        echo '<script src="' . $script . '"></script>';
    }
}
?>
</body>

</html>