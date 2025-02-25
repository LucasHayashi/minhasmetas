const THEME_LIST = {
  light: { icon: "brightness-high", title: "Claro" },
  dark: { icon: "moon-stars-fill", title: "Escuro" },
  auto: { icon: "circle-half", title: "Auto" },
};

const getActiveTheme = () => localStorage.getItem("theme") || "dark";

const setActiveTheme = (theme) => {
  $("html").attr("data-bs-theme", theme);
  localStorage.setItem("theme", theme);
  updateThemeDisplay();
};

const updateThemeDisplay = () => {
  const { icon, title } = THEME_LIST[getActiveTheme()];
  $(".current-theme").html(`<i class="bi bi-${icon}"></i> ${title}`);
  $(".themes-list li a")
    .removeClass("active")
    .filter(`[data-theme="${getActiveTheme()}"]`)
    .addClass("active");
};

(() => {
  setActiveTheme(getActiveTheme());
})();

$(document).on("click", ".themes-list li a", function () {
  setActiveTheme($(this).data("theme"));
});

const formatarMoeda = (valor) =>
  new Intl.NumberFormat("pt-BR", { style: "currency", currency: "BRL" }).format(
    valor
  );

const calcularPorcentagem = (valorInicial, valorTotal) =>
  ((valorInicial / valorTotal) * 100).toFixed(2);

const calcularDiasRestantes = (dataLimite) =>
  moment(dataLimite).diff(moment(), "days");

const formatarData = (data) => moment(data).format("DD/MM/YYYY");

const notify = (message, className) =>
  $.notify(message, { position: "top right", className });

const carregarMetas = () => {
  $.post(
    "ajax.php",
    { acao: "carregar-metas" },
    (response) => {
      const metas = response.data || [];
      const $container = $("#metas-container").empty();

      if (!metas.length) {
        return $container.html(
          '<p class="text-center">Nenhuma meta encontrada.</p>'
        );
      }

      metas.forEach(
        ({ id_meta, titulo, valor_total, valor_inicial, data_limite }) => {
          const valorTotal = parseFloat(valor_total);
          const valorInicial = parseFloat(valor_inicial);
          const porcentagemConcluida = calcularPorcentagem(
            valorInicial,
            valorTotal
          );
          const diasRestantes = calcularDiasRestantes(data_limite);
          const statusDias =
            diasRestantes > 0 ? `${diasRestantes} dias` : "Meta vencida";

          $container.append(`
        <div class="col-md-6 col-lg-4">
          <div class="card card-meta" id="meta-${id_meta}">
            <div class="card-body">
              <h5 class="card-title">${titulo}</h5>
              <p><strong>Valor Total:</strong> ${formatarMoeda(valorTotal)}</p>
              <p><strong>Valor Inicial:</strong> ${formatarMoeda(
                valorInicial
              )}</p>
              <p><strong>Data Limite:</strong> ${formatarData(data_limite)}</p>
              <p><strong>Dias Restantes:</strong> ${statusDias}</p>
              <div class="progress mb-3">
                <div class="progress-bar" role="progressbar" 
                  style="width: ${porcentagemConcluida}%;" 
                  aria-valuenow="${porcentagemConcluida}" aria-valuemin="0" aria-valuemax="100">
                  ${porcentagemConcluida}%
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <a href="editar-meta.php?id_meta=${id_meta}" class="btn btn-primary">
                  <i class="fas fa-edit"></i> Editar
                </a>
                <button class="btn btn-danger excluir-meta" data-idmeta="${id_meta}" data-bs-toggle="modal" data-bs-target="#modalExcluirMeta">
                  <i class="fas fa-trash"></i> Excluir
                </button>
              </div>
            </div>
          </div>
        </div>
      `);
        }
      );
    },
    "json"
  ).fail(() => {
    $("#metas-container").html(
      '<p class="text-center text-danger">Erro ao carregar as metas. Tente novamente mais tarde.</p>'
    );
  });
};

$(document).on("show.bs.modal", "#modalExcluirMeta", function (event) {
  $("#btn-confirmar-exclusao").data(
    "idmeta",
    $(event.relatedTarget).data("idmeta")
  );
});

$(document).on("click", "#btn-confirmar-exclusao", function () {
  const idMeta = $(this).data("idmeta");

  $.post(
    "ajax.php",
    { acao: "excluir-meta", idMeta },
    (data) => {
      if (data) {
        $(`#meta-${idMeta}`).remove();
        if (!$("#metas-container").children().length) {
          $("#metas-container").html(
            '<p class="text-center">Nenhuma meta encontrada.</p>'
          );
        }
      }
      $("#modalExcluirMeta").modal("hide");
      notify(data.message, data.class);
    },
    "json"
  ).fail(() => {
    notify("Erro ao excluir meta. Tente novamente.", "error");
  });
});

$(document).ready(() => {
  carregarMetas();
  $(".date").mask("00/00/0000", { selectOnFocus: true });
  $(".datepicker").datepicker({
    language: "pt-BR",
    todayHighlight: true,
    startDate: "+0d",
  });
  $(".brl")
    .maskMoney({
      allowNegative: false,
      thousands: ".",
      decimal: ",",
      affixesStay: false,
      reverse: true,
    })
    .maskMoney("mask");
});
