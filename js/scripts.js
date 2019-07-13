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

function peticionHttpEditarTranscripcion(){
	var idTranscripcionEditar = document.getElementById("idTranscripcionEditar").value;
	var editarTitulo = document.getElementById("editarTitulo").value;
	var editarTranscripcion = document.getElementById("editarTranscripcion").value;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
		if(xhttp.readyState == 4 && xhttp.status == 200){
			document.getElementById("edicion").innerHTML = xhttp.responseText;
		}
	};
	xhttp.open("POST","/Transcript/php/editarTranscripcion.php");
	xhttp.setRequestHeader("Content-type", "aplication/x-www-form-urlencoded");
	xhttp.send("id="+idTranscripcionEditar+"&titulo="+editarTitulo+"&transcripcion="+editarTranscripcion+"");
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