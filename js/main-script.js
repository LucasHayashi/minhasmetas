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

function excluirMeta(button) {
	const idMeta = $(button).data("idmeta");

	$.ajax({
		url: "ajax.php",
		method: "post",
		dataType: "json",
		data: {
			acao: "excluir-meta",
			idMeta: idMeta,
		},
		success: function (data) {
			if (data.status === 204) {
				$("#tbl-minhas-metas").DataTable().ajax.reload();
			}

			$("#modalExcluirMeta").modal("hide");

			notify(data.message, data.class);
		}
	});
}

function notify(message, notifyClassName) {
	$.notify(message, {
		position: 'top right',
		className: notifyClassName
	});
}

function activeCurrentMenu() {
	const currentPageLink = window.location.href;
	const navLinks = $(".navbar-nav.main a");
	navLinks.removeClass('active');

	navLinks.each(function (k, v) {
		let currentNav = $(v);
		let currItemLink = currentNav.prop('href');
		if (currItemLink === currentPageLink) {
			currentNav.addClass('active');
			if (currentNav.closest('.nav-item').hasClass('dropdown')) {
				currentNav.closest('.nav-item').find('.nav-link').addClass('active');
			}
		}
	})
}

$(document).ready(function () {
	activeCurrentMenu();
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
	}).maskMoney('mask');

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
				data: "data_cadastro",
				render: function (data, type, row) {
					if (data) {
						var date = new Date(data);
						var day = ("0" + date.getDate()).slice(-2);
						var month = ("0" + (date.getMonth() + 1)).slice(-2);
						var year = date.getFullYear();
						return day + '/' + month + '/' + year;
					}
					return data;
				},
				title: "Dt. Cadastro",
				width: "20%",
			},
			{
				data: function (data, type, row) {
					let valorAtual = data.valor_inicial;
					let valorTotal = data.valor_total;
					let porcentagem = (valorAtual / valorTotal) * 100;
					let porcentagemFormatada = porcentagem.toFixed(2);

					return `<div class="progress">
					<div class="progress-bar" 
						 role="progressbar" 
						 style="width: ${porcentagemFormatada}%" 
						 aria-valuenow="${porcentagemFormatada}" 
						 aria-valuemin="0" 
						 aria-valuemax="100">
						  ${porcentagemFormatada} %
					</div>
				  </div>`;
				},
				title: "Progresso",
				width: "20%",
			},
			{
				data: function (data, type, row) {
					const id_meta = data.id_meta;

					return `<a href="editar-meta.php?id_meta=${id_meta}"
						  class="btn btn-success" 
						  title="Editar">
					<i class="bi bi-pencil-square"></i> 
				  </a>
				  <a href="#"
						  class="btn btn-danger" 
						  title="Excluir" 
						  data-bs-toggle="modal" 
						  data-bs-target="#modalExcluirMeta" 
						  data-bs-idmeta="${id_meta}">
					<i class="bi bi-x-square"></i>
				  </a>`;
				},
				title: "Ações",
				width: "10%",
			},
		],
	});

	$("#modalExcluirMeta").on("show.bs.modal", function (e) {
		let button = e.relatedTarget;
		let idmeta = button.getAttribute("data-bs-idmeta");
		$("#btn-confirmar-exclusao").data("idmeta", idmeta);
	});
});
