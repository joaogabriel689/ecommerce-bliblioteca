/**
 * @author Luiz-Mtca-tech
 * 
 * Classe Javascript para tratar os eventos relacionados a campos
 * de busca dentro do site. 
 * 
 * 
 **/

import Server from "./server.js";

export default class SearchClass extends Server{
	
	/**
	 * @param {str} inputId //id do elemento do input texto
	 * @param {url} phpFile //url para o script php responsável
	 * 
	 * 
	 */
	constructor(inputId, phpFile)
	{
		super(phpFile)
		
		this.input = document.querySelector(inputId);
		this.url = phpFile;
		

	}
	
	submit()
	{
		this.submitFormPost("search=" + this.input.value);
	}
	
	
	/**
	 * 
	 * @override
	 */
	response()
	{
		switch(this.conn.readyState){
			case 1:
				break;
			case 2:
				break;
			case 3:
				break;
			case 4:
				console.log("a busca deu certo! RESPONSE: " + this.conn.responseText);
				break;
		}

	}
	
	
}
