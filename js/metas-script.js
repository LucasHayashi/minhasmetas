function dateIsValid(date) {
    return date instanceof Date && !isNaN(date);
}

$(document).ready(function () {
    $('#criar-nova-meta, #atualiizar-meta').on('submit', function (event) {
        let notifyMessage = "";
        let valor_total = $('#valor_total').maskMoney('unmasked').get(0)
        let valor_atual = $('#valor_atual').maskMoney('unmasked').get(0)
        let data_limite = $('#data_limite').datepicker('getDate');
        console.log(valor_atual, valor_total)
        if ( (valor_atual > valor_total) ) {
            notifyMessage = 'O valor atual não pode ser maior que o valor da sua meta';
        } else if (!dateIsValid(data_limite)) {
            notifyMessage = 'Insira uma data válida';
        } else {
            return;
        }

        notify(notifyMessage, 'error');

        event.preventDefault();
    });
});