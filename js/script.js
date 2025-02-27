function setTheme(mode = "auto") {
  const userMode = localStorage.getItem("bs-theme");
  const sysMode = window.matchMedia("(prefers-color-scheme: light)").matches;
  const useSystem = mode === "system" || (!userMode && mode === "auto");
  const modeChosen = useSystem
    ? "system"
    : mode === "dark" || mode === "light"
    ? mode
    : userMode;

  if (useSystem) {
    localStorage.removeItem("bs-theme");
  } else {
    localStorage.setItem("bs-theme", modeChosen);
  }

  document.documentElement.setAttribute(
    "data-bs-theme",
    useSystem ? (sysMode ? "light" : "dark") : modeChosen
  );
  document
    .querySelectorAll(".mode-switch .btn")
    .forEach((e) => e.classList.remove("text-body"));
  document.getElementById(modeChosen).classList.add("text-body");
}

setTheme();

document
  .querySelectorAll(".mode-switch .btn")
  .forEach((e) => e.addEventListener("click", () => setTheme(e.id)));
window
  .matchMedia("(prefers-color-scheme: light)")
  .addEventListener("change", () => setTheme());

const brlCurrencyMask = (e) => {
  let value = e.target.value;
  value = value.replace(/\D/g, "");
  const formatted = new Intl.NumberFormat("pt-BR", {
    minimumFractionDigits: 2,
  }).format(parseFloat(value) / 100);

  e.target.value = value ? formatted : "";
};

const formatarMoeda = (valor) =>
  new Intl.NumberFormat("pt-BR", { style: "currency", currency: "BRL" }).format(
    valor
  );

const calcularPorcentagem = (valorInicial, valorTotal) =>
  ((valorInicial / valorTotal) * 100).toFixed(2);

const calcularDiasRestantes = (dataLimite) =>
  moment(dataLimite).diff(moment(), "days");

const formatarData = (data) => moment(data).format("DD/MM/YYYY");

const carregarMetas = () => {
  $.post(
    "ajax.php",
    { acao: "carregar-metas" },
    (response) => {
      const metas = response.data || [];
      const $container = $("#metas-container").empty();

      if (!metas.length) {
        return $container.html(
          '<p class="alert alert-primary" role="alert">Nenhuma meta encontrada.</p>'
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
            diasRestantes > 0 ? `${diasRestantes} dias` : "Meta expirada";

          $container.append(`
        <div class="col-md-6 col-lg-4">
          <div class="card card-meta bg-body-tertiary" id="meta-${id_meta}">
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

const dateIsValid = (date) => {
  return date instanceof Date && !isNaN(date);
};

const getCurrencyRawValue = (value) => {
  return Number(value.replace(/\./g, "").replace(",", "."));
};

function showToast(message, type = "primary") {
  var toastElement = $("#liveToast");

  $("#toastMessage").text(message);
  toastElement.attr("class", "toast text-bg-" + type);

  bootstrap.Toast.getOrCreateInstance(toastElement[0]).show();
}

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
        carregarMetas();
        if (!$("#metas-container").children().length) {
          $("#metas-container").html(
            '<p class="alert alert-primary" role="alert">Nenhuma meta encontrada.</p>'
          );
        }
      }
      $("#modalExcluirMeta").modal("hide");
      showToast(data.message, data.class);
    },
    "json"
  ).fail(() => {
    showToast("Erro ao excluir meta. Tente novamente.", "danger");
  });
});
