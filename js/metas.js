$(document).ready(function () {
  $(".date").mask("00/00/0000", { selectOnFocus: true });
  $(".datepicker").datepicker({
    language: "pt-BR",
    todayHighlight: true,
    startDate: "+0d",
  });

  $(".brl").on("input", brlCurrencyMask);
  $(".brl").trigger("input");
  $("#criar-nova-meta, #atualiizar-meta").on("submit", function (event) {
    let toastMessage = "";
    let valor_total = getCurrencyRawValue($("#valor_total").val());
    let valor_atual = getCurrencyRawValue($("#valor_atual").val());
    let data_limite = $("#data_limite").datepicker("getDate");

    if (valor_total <= 0) {
      toastMessage = "O valor da meta precisa ser maior que zero";
    } else if (valor_atual > valor_total) {
      toastMessage = "O valor atual não pode ser maior que o valor da sua meta";
    } else if (!dateIsValid(data_limite)) {
      toastMessage = "Insira uma data válida";
    } else {
      $("#valor_total").val(valor_total);
      $("#valor_atual").val(valor_atual);
      return;
    }

    showToast(toastMessage, "danger");

    event.preventDefault();
  });
});
