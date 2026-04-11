/**
 *
 * Neste arquivo é feito a configuração do formulário do
 * filtro de busca da página principal(public/index.php)
 * 
 * 
 **/

import FormClass from "./modules/form.js";

const filter = new FormClass("#filter-form", "./applyFilters.php");


document.querySelector("#apply-link").onclick = function(){

	filter.submit();
}

filter.conn.onreadystatechange = function(){
	switch(filter.conn.readyState){

		case 1:
			document.querySelector(".loading").classList.remove("hidden");

			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
			document.querySelector(".loading").classList.add("hidden");
			console.log("REPORT: the filter request was completed!");
			console.log("DATA FROM SERVER: " + filter.conn.responseText);
			break;
	}
}