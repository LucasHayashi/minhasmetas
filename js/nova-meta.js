function dateIsValid(date) {
    return date instanceof Date && !isNaN(date);
}

$(document).ready(function () {
    $('#criar-nova-meta').on('submit', function (event) {
        $('.brl').maskMoney('destroy');

        $('.brl').each(function () {
            var unmaskedValue = $(this).maskMoney('unmasked')[0];
            $(this).val(unmaskedValue);
        });

        let valor_total = Number($('#valor_total').val());
        let valor_atual = Number($('#valor_atual').val());
        let data_limite = $('#data_limite').datepicker('getDate');
        let alertDanger = $('.alert-danger');

        if ((valor_atual > valor_total) ||
            (valor_atual === valor_total)) {
            alertDanger.text('Não é possível cadastrar uma meta concluída');
        } else if (!dateIsValid(data_limite)) {
            alertDanger.text('Insira uma data válida');
        } else {
            return;
        }

        alertDanger.removeClass('d-none').addClass('show');

        event.preventDefault();
    });
})