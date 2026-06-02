/**
 * @author Luiz-Mtca-tech
 * 
 * Esta classe possui alguns métodos para criar os anuncios da página
 * principal e outras utilidades, que sejam usadas nos aquivos set*.js
 * 
 */
export default class AddsClass {
	
	/**
	 * @param {object} products_list //um array com os registros da tabela
	 * de produtos.
	 * @param {string} id //id do elemento onde será colocado os anúncios.
	 * 
	 * Essa função cria o html para os anuncios da página principal(public/index.php).
	 */
	static generateAdds(products_list, id)
	{
		//make the adds appea
		for (let i = 0; i <= Object.keys(products_list).length - 1; i++) {
		//products_list.data.mostsold.forEach(function(products_list){
		    const add_box = document.createElement("article")
		    
		    const title_add = document.createElement("p")
		    title_add.innerText = products_list[i].nome
		    add_box.appendChild(title_add)

		    const img_add = document.createElement("img")
		    img_add.src = ".." + products_list[i].img_path
		    img_add.alt = "product image"
		    add_box.appendChild(img_add)

		    const price = document.createElement("p")
		    price.innerText = "R$" + products_list[i].valor
		    price.className = "price-text"
		    add_box.appendChild(price)

		    const buy_link= document.createElement("a")
		    buy_link.href = "./shop.php?number=" + products_list[i].id
		    buy_link.innerText = "buy"
		    add_box.appendChild(buy_link)

		    document.querySelector(id).appendChild(add_box)
		}

	}
	
	/**
	 * @param {object} product // lista com todos as informações do produto
	 */
	static generateAddPage(product)
	{
		
	}
	
	/**
	 * @param {string} asideId //Id do elemento onde serão colocados os
	 * anuncios relacionados
	 * @param {Object} productArray //arrays com os anuncios relacionados alguns de 
	 * seus dados.
	 */
	static showRelatedAdds(asideId, productArray)
	{
		productArray.forEach(function(item, index){
			
			if(index <= 3) {
				var art_element = document.createElement("article");

				let img = docomument.createElement("img");
				img.src = item["img_path"];
				img.alt = "Product Image";

				let stars_div = document.createElement("div");
				stars_div.className = "stars-r-5-0";

				let second_div = document.createElement("div");

				let link = document.createElement("a");
				link.href = "./shop.php?number=" + item["id"];

				let text = document.createElement("p");
				text.className = "sub-description";
				text.innerText = item["nome"];

				let price = document.createElement(p);
				price.className = "price";
				price.innerText = item["valor"];

				second_div.appendChild(link)
				second_div.appendChild(text)
				second_div.appendChild(price);

				art_element.appendChild(img);
				art_element.appendChild(stars_div);
				art_element.appendChild(second_div);

				document.querySelector(asideId).appendChild(art_element);
				index++;
	
			}
		})
	}
}