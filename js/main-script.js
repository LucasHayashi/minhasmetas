const THEME_LIST = {
  light: {
    icon: "brightness-high",
    title: "Claro",
  },
  dark: {
    icon: "moon-stars-fill",
    title: "Escuro",
  },
  auto: {
    icon: "circle-half",
    title: "Auto",
  },
};

function currentHtmlDisplayTheme(theme) {
  const { icon, title } = THEME_LIST[theme];

  return `<i class="bi bi-${icon}"></i> ${title}`;
}

function setDropdownDisplayTheme(dropdownItem) {
  if (typeof dropdownItem === "undefined") {
    let currentTheme = getActiveTheme();
    dropdownItem = $(".themes-list li a").filter(function () {
      return $(this).data("theme") === currentTheme;
    });
  }
  $(".themes-list li a.active").removeClass("active");
  dropdownItem.addClass("active");
}

function excluirMeta(id) {
  $("#meuModal").load("modals/confirmar-exclusao.php", function () {
    $("#meuModal").modal("show");
    $("#btn-confirmar-exclusao").data("id", id);
  });
}

$(document).ready(function () {
  $(".current-theme").html(currentHtmlDisplayTheme(getActiveTheme()));

  setDropdownDisplayTheme();

  $(".themes-list li").on("click", function () {
    let dropdownItem = $(this).find("a");
    let theme = dropdownItem.data("theme");
    setActiveTheme(theme);
    setDropdownDisplayTheme(dropdownItem);
    $(".current-theme").html(currentHtmlDisplayTheme(getActiveTheme()));
  });

  $(".datepicker").datepicker({
    language: "pt-BR",
    todayHighlight: true,
    startDate: "+0d",
  });

  $(".date").mask("00/00/0000", { selectOnFocus: true });

  $(".brl").maskMoney({
    allowNegative: false,
    thousands: ".",
    decimal: ",",
    affixesStay: false,
    reverse: true,
  });

  $("#tbl-minhas-metas").DataTable({
    language: {
      url: "includes/DataTables/i18n/pt-BR.json",
    },
    responsive: true,
    ajax: {
      url: "ajax.php",
      method: "post",
      dataType: "json",
      data: {
        acao: "carregar-metas",
      },
    },
    columns: [
      { data: "id_meta", title: "Id", width: "10%" },
      { data: "titulo", title: "Título", width: "40%" },
      {
        data: "valor_total",
        render: function (data, type, row) {
          if (type === "display") {
            return (
              "R$ " +
              $.fn.dataTable.render.number(".", ",", 2, "").display(data)
            );
          }
          return data;
        },
        title: "Valor Total",
        className: "dt-head-right dt-body-right",
        width: "10%",
      },
      {
        data: "valor_inicial",
        render: function (data, type, row) {
          if (type === "display") {
            return (
              "R$ " +
              $.fn.dataTable.render.number(".", ",", 2, "").display(data)
            );
          }
          return data;
        },
        title: "Valor Atual",
        className: "dt-head-right dt-body-right",
        width: "10%",
      },
      {
        data: function (data, type, row) {
          let valorAtual = data.valor_inicial;
          let valorTotal = data.valor_total;
          let porcentagem = (valorAtual / valorTotal) * 100;
          let porcentagemFormatada = porcentagem.toFixed(2);

          return `<div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: ${porcentagemFormatada}%" aria-valuenow="${porcentagemFormatada}" aria-valuemin="0" aria-valuemax="100">${porcentagemFormatada} %</div>
                            </div>`;
        },
        title: "%",
        width: "20%",
      },
      {
        data: function (data, type, row) {
          return `<button type="button" class="btn btn-success" title="Editar">
                                <i class="bi bi-pencil-square"></i> 
                            </button>
                            <button type="button" class="btn btn-danger" title="Excluir" onclick="excluirMeta(${data.id_meta})">
                                <i class="bi bi-x-square"></i>
                            </button>`;
        },
        title: "Ações",
        width: "10%",
      },
    ],
  });
});
