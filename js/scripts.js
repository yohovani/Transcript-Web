function listarTranscripciones(){
	$.post("/Transcript/php/transcripciones.php", {id:null}, function(mensaje) {
		$("#lista_transcripciones").html(mensaje);
	});
}

function verificarPassword(){
	//Obtenes la información desde el index mediante el Id de los campos de registro
	var pass1 = document.getElementById('contrasenna');
	var pass2 = document.getElementById('contrasenna2');
	var btn = document.getElementById('btn-registro');
	//Validamos que ambas contraseñas sean iguales
	if(pass1.value == pass2.value && pass1.value != ""){
		//Si son iguales el fondo de los campos cambia a verde
		pass1.style.background = "#009817";
		pass2.style.background = "#009817";
		//se habilita el boton para hacer el registro
		btn.disabled = false;
	}else{
		//Si son iguales el fondo de los campos cambia a rojo
		pass1.style.background = "#ac0000";
		pass2.style.background = "#ac0000";
		//se desabilita el boton para hacer el registro
		btn.disabled = true;
	}
}

function editarTranscripcion(){
	var idTranscripcionEditar = document.getElementById("idTranscripcionEditar").value;
	var editarTitulo = document.getElementById("editarTitulo").value;
	var editarTranscripcion = document.getElementById("editarTranscripcion").value;

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			document.getElementById("edicion").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST","/Transcript/php/editarTranscripcion.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+idTranscripcionEditar+"&titulo="+editarTitulo+"&transcripcion="+editarTranscripcion);
	mostarMensaje();

}

function verTranscripcion(idTranscripcion){
	if (idTranscripcion != "") {
		$.post("/Transcript/php/mostrarTranscripcion.php", {id: idTranscripcion}, function(mensaje) {
			$("#verTranscripcion").html(mensaje);
		});
	}else { 
		$("#verTranscripcion").html("Ocurrio un error Inesperado");
	}
}

function mostarMensaje(){
	$("#mensaje").modal("show");
	listarTranscripciones();
}

function validacionContrasennaActual(){
	var contrasenna = document.getElementById("password-actual");
	var contrasennaSesion = document.getElementById("contrasennaActual");
	var newContrasenna1 = document.getElementById("newPassword1");
	var newContrasenna2 = document.getElementById("newPassword2");
	var button = document.getElementById("btn-password");
	if(contrasenna.value.length >= (contrasennaSesion.value.length*0.75) ){
		if(contrasenna.value == contrasennaSesion.value){
			contrasenna.style.background = "#009817";
			button.disabled = true;
			newContrasenna1.disabled = false;
			newContrasenna2.disabled = false;
		}else{
			contrasenna.style.background = "#ac0000";
			button.disabled = true;
			newContrasenna1.disabled = true;
			newContrasenna2.disabled = true;
		}
	}
}

function validacionCambioContrasenna(){
	var newContrasenna1 = document.getElementById("newPassword1");
	var newContrasenna2 = document.getElementById("newPassword2");
	var button = document.getElementById("btn-password");
	var alert = document.getElementById("pass-dont-match");
	var alertLength = document.getElementById("pass-length");
	if(newContrasenna1.value.length == newContrasenna2.value.length  && newContrasenna1.value != "" && newContrasenna1.value.length >= 8){
		if(newContrasenna1.value == newContrasenna2.value){
			newContrasenna1.style.background = "#00b10f";
			newContrasenna2.style.background = "#00b10f";
			button.disabled = false;
			alert.style.display = "none";
			alertLength.style.display = "none";
		}else{
			newContrasenna1.style.background = "#ee0000";
			newContrasenna2.style.background = "#ee0000";
			button.disabled = true;
			alert.style.display = "block";
		}
	}else{
		newContrasenna1.style.background = "#ee0000";
		newContrasenna2.style.background = "#ee0000";
		if(newContrasenna1.value.length < 8 && newContrasenna1.value.length > 0){
			alertLength.style.display = "block";
		}
	}
}

function cambiarContrasenna(){
	var pass_actual = document.getElementById("password-actual");
	var password1 = document.getElementById("newPassword1");
	var password = document.getElementById("newPassword2");
	var button = document.getElementById("btn-password");

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			document.getElementById("mensaje-cambiar-password-body").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST","/Transcript/php/password.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("newPassword="+password.value);
	//Limpieza de los elementos del modal de cambiar contrasenna
	pass_actual.value = "";
	password1.value = "";
	password.value = "";
	//Cambio de color
	pass_actual.style.background = "#ffffff";
	password.style.background = "#ffffff";
	password1.style.background = "#ffffff";
	//Desabilitar elementos
	button.disabled = true;
	password.disabled = true;
	password1.disabled = true;
	//Mostrar mensajes de confirmacion y ocultar el modal de cambiar contrasenna
	$("#cambiar-password").modal("hide");
	$("#mensaje-cambiar-password").modal("show");
}

function mostrarInformacionEliminar(idTranscripcion){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			document.getElementById("eliminarModal").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST","/Transcript/php/eliminarTranscripcion.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+idTranscripcion+"&opcion="+'1');
}

function eliminarTranscripcion(idTranscripcion){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			document.getElementById("eliminarModal").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST","/Transcript/php/eliminarTranscripcion.php",true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("id="+idTranscripcion+"&opcion="+'2');
	listarTranscripciones();
}

function recuperarContrasenia(){
	var correo = document.getElementById("recuperarEmail");
	if(correo != null && correo != ""){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function(){
			if(xhttp.readyState == 4 && xhttp.status == 200){
				document.getElementById("mensaje_email-body").innerHTML = xhttp.responseText;
			}
		};
		xhttp.open("POST","/Transcript/php/password.php",true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("recuperarEmail="+correo.value);
		mostarMensajeEmail();
		correo.value = "";
	}
}

function mostarMensajeEmail(){
	$("#recuperar").modal("hide");
	$("#mensaje_email").modal("show");
}

