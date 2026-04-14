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
		    buy_link.href = "./shop/shop.html?number=" + products_list[i].id
		    buy_link.innerText = "buy"
		    add_box.appendChild(buy_link)

		    document.querySelector(id).appendChild(add_box)
		}

	}
}