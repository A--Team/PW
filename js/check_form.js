/**
 * Script che controlla i dati inseriti nei form
 */

function check_reg(){
	//Recupero i valori inseriti nel form
	var cf = document.reg_form.cf.value;
	var nome = document.reg_form.nome.value;
	var cognome = document.reg_form.cognome.value;
	var mail = document.reg_form.mail.value;
	var indirizzo = document.reg_form.indirizzo.value;
	var tel = document.reg_form.tel.value;
	var username = document.reg_form.username.value;
	var password = document.reg_form.password.value;
	var conf_password = document.reg_form.conf_password.value;
	
	var campi = new Array(cf,nome,cognome,mail,indirizzo,tel,username,password,conf_password);
	
	//Verifico che non ci siano campi vuoti	
	for(var i=0; i<campi.length; i++){
		if((campi[i] == "") || (campi[i] == "undefined")) {
			alert("Tutti i campi sono obbligatori!");
	   		return false;
		}
	}	
	if(password != conf_password){
		//Verifico che la password immessa e la conferma della stessa siano uguali
		alert("La password confermata è diversa da quella scelta!");
		document.reg_form.conf_password.value = "";
		document.reg_form.conf_password.focus();
		return false;
	}
	else{
		//Se tutti i controlli sono stati superati, invio il modulo
		document.reg_form.action = "signup.php";
        document.reg_form.submit();
	}
}