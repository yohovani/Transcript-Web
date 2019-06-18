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