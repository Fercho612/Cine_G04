const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
$(document).ready(() => {
	if (registrando) {
		tab_iniciar_sesion(false);
		tab_registrar(false);
	}
	else {
		tab_registrar(false);
		tab_iniciar_sesion(false);
	}
});

function alertar(objetivo, mensaje, tipo, icon) {
	const contenido = `<div class="alert alert-${tipo}"> <i class="${icon}"> </i> ${mensaje} </div>`;
	$(objetivo).append(contenido);
}

function tab_registrar(vaciar = true) {
	if (vaciar) $(".alerta").empty();
	if (!registrando) {
		$(".registro").removeClass("d-none");
		$(".registro").addClass("d-block");
		$("#btn_tab_iniciar_sesion").addClass("btn-outline-primary");
		$("#btn_tab_iniciar_sesion").removeClass("btn-primary");
		$("#btn_tab_registrar").removeClass("btn-outline-primary");
		$("#btn_tab_registrar").addClass("btn-primary");
		$("#btn_iniciar_sesion").addClass("d-none");
		$("#btn_iniciar_sesion").removeClass("d-block");
		$("#btn_registrar").removeClass("d-none");
		$("#btn_registrar").addClass("d-block");
		$("#hidden_registro").val("1");
		registrando = true;
	}
}

function tab_iniciar_sesion(vaciar = true) {
	if (vaciar) $(".alerta").empty();
	if (registrando) {
		$(".registro").addClass("d-none");
		$(".registro").removeClass("d-block");
		$("#btn_tab_iniciar_sesion").removeClass("btn-outline-primary");
		$("#btn_tab_iniciar_sesion").addClass("btn-primary");
		$("#btn_tab_registrar").addClass("btn-outline-primary");
		$("#btn_tab_registrar").removeClass("btn-primary");
		$("#btn_iniciar_sesion").removeClass("d-none");
		$("#btn_iniciar_sesion").addClass("d-block");
		$("#btn_registrar").addClass("d-none");
		$("#btn_registrar").removeClass("d-block");
		$("#hidden_registro").val("0");
		registrando = false;
	}
}

function registrar() {
	$(".alerta").empty();
	if (registrando) {
		const username = $("#username").val();
		const correo = $("#correo").val();
		const apellido = $("#apellido").val();
		const nombre = $("#nombre").val();
		const contrasena = $("#contrasena").val();
		const contrasena2 = $("#contrasena2").val();
		let exito = true;
		if (username.length > 40) {
			exito = false;
			alertar("#alerta_username", "El nombre de usuario es demasiado largo", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (username.length < 4) {
			exito = false;
			alertar("#alerta_username", "El nombre de usuario es demasiado corto", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (nombre.length < 1 || !/^[a-z\s]+$/i.test(nombre)) {
			exito = false;
			alertar("#alerta_nombre", "El nombre debe estar compuesto por letras", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (apellido.length < 1 || !/^[a-z\s]+$/i.test(apellido)) {
			exito = false;
			alertar("#alerta_apellido", "El apellido debe estar compuesto por letras", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (contrasena != contrasena2) {
			exito = false;
			alertar("#alerta_contrasena2", "Las contraseñas no coindiden", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (contrasena.length < 4) {
			exito = false;
			alertar("#alerta_contrasena", "La contraseña es demasiado corta", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (!/^\w+\@\w+\.\w+$/.test(correo)) {
			exito = false;
			alertar("#alerta_correo", "La dirección de correo electrónico no es válida", "danger", "fa-solid fa-triangle-exclamation");
		}

		if (exito) {
			$("#ventana_login").submit();
		}
	}
}

function iniciar_sesion() {
	$(".alerta").empty();
	if (!registrando) {
		let exito = true;
		const username = $("#username").val();
		const contrasena = $("#contrasena").val();

		if (username.length < 4) {
			exito = false;
			alertar("#alerta_username", "El nombre de usuario es demasiado corto", "danger", "fa-solid fa-triangle-exclamation");
		}
		if (exito) {
			$("#ventana_login").submit();
		}
	}
}

function cerrar_sesion() {
	window.location.href = "iniciar_sesion.asp";
}

