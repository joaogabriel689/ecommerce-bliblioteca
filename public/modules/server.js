/**
 * @author Luiz-Mtca-tech
 * 
 * Esta classe possui o métodos para diálogo com o
 * servidor. Submit Post e Submit Get. Como serão várias as classes que irão
 * enviar requisições, resolvi experimentar fazer desse
 * modo, aplicando as por meio de herança, para que não seja nescessário
 * reescreve-las a todo momento.
 * 
 */

export default class Server {
	
	/**
	 * @param {url} phpFile  //url para o arquivo php responsável 
	 */
	constructor(phpFile)
	{
		this.url = phpFile;
		
		this.conn = new XMLHttpRequest();
	}
	
	
	/**
	 * Este método simplesmente envia um requisição para o arquivo da classe, caso
	 * executr algum outro arquivo do servidor.
	 */
	load()
	{
		this.conn.open("POST", this.url, true);
		this.conn.send();
	}
	
	submitFormPost(dataStr)
	{
		this.conn.open("POST", this.url, true);
		this.conn.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		this.conn.send(dataStr);
	}
	
	submitFormGet(dataStr)
	{
		this.conn.open("GET", this.url, true);
		this.conn.setRequestHeader("Content-type", "application/x-www-urlencoded");
		this.conn.send(dataStr);
	}
	
	
	/**
	 * @abstract response()
	 * 
	 * método abstrato para tratar respostas do servidor. Cada filho
	 * faz da sua maneira.
	 */
	response()
	{
		
	}
	
	/**
	 *  generatePostString cria um string com os dados POST do formulário
	 * no formato correto para indexar os dados na da requisição. Nesse método
	 * estático, voce pode escolher outra lista de inputs, ao seu critério, para
	 * obter a string.
	 * 
	 * @param {Object} inputList //lista com todos os elementos de um <form>
	 * @return {str} final_str
	 * 
	 **/
	static generatePostString(inputList)
	{
		let final_str = ""
		inputList.forEach(function(item, i, list){
			if (i == list.length - 1) {
				final_str += item.name + "=" + item.value

			} else {
				final_str += item.name + "=" + item.value + "&"				
			}
		})

		return final_str;
	}
}