/**
 * @author Luiz-Mtca-tech
 * 
 * Arquivo para configurar o funcionamento do campo de busca
 * da página principal(index.php).
 * 
 */


import SeachClass from "./modules/search.js";
import AddsClass from "./modules/adds.js";

const search = new SeachClass("#search-input", "./applySearch.php");

search.input.onchange = function(){
	
	search.submit();
}

search.conn.onreadystatechange = function(){
	switch(search.conn.readyState){
		case 1:
			document.querySelector(".loading").classList.remove("hidden");
			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
			//console.log("a busca deu certo! RESPONSE: " + search.conn.responseText);
			
			let products_array = JSON.parse(search.conn.responseText)
			document.querySelector("#shop").replaceChildren();
			AddsClass.generateAdds(products_array.data, "#shop");
			
			document.querySelector(".loading").classList.add("hidden");
			break;
	}
}

