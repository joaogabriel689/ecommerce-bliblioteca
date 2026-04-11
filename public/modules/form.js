

/**
 *  @author Luiz-Mtca-tech
 * 
 *  Esta é uma classe para formulários html.
 *  Esta classe possui métodos para coletar valores de formulários
 *  de forma dinâmica e criar strings no formato post para enviar dados.
 * 
 * 
 */
export default class FormClass {

	/**
	 *  @param string formId //id do <form>
	 *  @param string phpFile //url até o PHP que vai tratar os dados
	 */
	constructor(formId, phpFile)
	{
		this.form = document.querySelector(formId);
		this.url = phpFile;

		console.log("this.url: " + this.url + "    PHPFILE: " + phpFile);

		this.conn = new XMLHttpRequest();

	}

	/**
	 * Aqui é criado e enviado a requisição para o servidor junto com os dados do
	 * formulário
	 * 
	 *  @return Null
	 */
	submit()
	{
		this.conn.open("POST", this.url, true);
		this.conn.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//console.log("post string: " + this.generatePostString());
		let post_string = this.generatePostString();
		console.log("POST STRING: " + post_string);
		this.conn.send(post_string);
	}

	
	/**
	 *  Função pega todos os elementos do formulário e retorna
	 * seus valores.
	 * 
	 * @return Object final_list;
	 * lista com a chave sendo o .name do input e o valor o seu
	 * atributo .value.
	 * 
	 */
	getInputValues()
	{
		let inputs_list = this.form.querySelectorAll("input");
		let final_list = {}

		inputs_list.forEach(function(item){
			final_list[item.name] = item.value
		})
		return final_list;
	}

	/**
	 *  generatePostString cria um string com os dados POST do formulário
	 * no formato correto para indexar os dados na da requisição.
	 * 
	 * @return str final_str
	 * 
	 **/ 
	generatePostString()
	{
		let final_str = ""

		let inputs = this.form.querySelectorAll("input")//this.getInputValues();
		inputs.forEach(function(item, i, list){
			if (i == list.length - 1) {
				final_str += item.name + "=" + item.value

			} else {
				final_str += item.name + "=" + item.value + "&"				
			}
		})

		return final_str;
	}

	/**
	 *  generatePostString cria um string com os dados POST do formulário
	 * no formato correto para indexar os dados na da requisição. Nesse método
	 * estático, voce pode escolher outra lista de inputs, ao seu critério, para
	 * obter a string.
	 * 
	 * @param Object inputList //lista com todos os elementos de um <form>
	 * @return str final_str
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