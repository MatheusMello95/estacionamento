function placa(objeto, e){
	var x = (document.all) ? event.keyCode : e.keyCode;
	var placa = objeto.value;
	if (x!= 8 && kC!=46 ) {
		if(placa.length == 3){
			objeto.valeu = placa += '-';
		}else{
			objeto.value = placa;
		}
	}
}


/*
https://www.youtube.com/watch?v=5YSsfuCgB5A*/