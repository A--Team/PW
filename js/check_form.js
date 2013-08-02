/**
 * Script che controlla i dati inseriti nei form, se tipo vale m form di modifica, se tipo vale r form di registrazione
 */

function check_comment(dest){
	var testo = document.form_commento.commento.value;
	if(testo == ""){
		alert("Non puoi inserire commenti vuoti!");
	}
	else
		document.form_commento.submit();
}
function check_reg(tipo)
{
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
		
	//Verifico che non ci siano campi vuoti	
	if(tipo == "r")
	{
		var campi = new Array(cf,nome,cognome,mail,indirizzo,tel,username,password,conf_password);
		
		for(var i=0; i<campi.length; i++)
		{
			if((campi[i] == "") || (campi[i] == "undefined")) 
			{
				alert("Tutti i campi sono obbligatori!");
				return false;
			}
		}	
		if(password != conf_password)
		{
			//Verifico che la password immessa e la conferma della stessa siano uguali
			alert("La password confermata è diversa da quella scelta!");
			document.reg_form.conf_password.value = "";
			document.reg_form.conf_password.focus();
			return false;
		}
		else
		{
			//Se tutti i controlli sono stati superati, invio il modulo
			document.reg_form.action = "signup.php";
			document.reg_form.submit();
		}
	}
	
	if(tipo == "m")
	{
		var campi = new Array(cf,nome,cognome,mail,indirizzo,tel,username);
		
		for(var i=0; i<campi.length; i++)
		{
			if((campi[i] == "") || (campi[i] == "undefined")) 
			{
				alert("Assicurarsi che i campi obbligatori siano compilati");
				return false;
			}
		}	
		if(password != conf_password)
		{
			//Verifico che la password immessa e la conferma della stessa siano uguali
			alert("La password confermata è diversa da quella scelta!");
			document.reg_form.conf_password.value = "";
			document.reg_form.conf_password.focus();
			return false;
		}
		else
		{
			//Se tutti i controlli sono stati superati, invio il modulo
			document.reg_form.action="gestioneprofilo.php";
			document.reg_form.submit();
		}
	}

}