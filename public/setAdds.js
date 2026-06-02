/**
 *  (c) redxam llc and affiliates. Confidential and proprietary.
 *
 *  @oncall dev+Luiz-Mtca-tech
 *  @format
 * 
 */

'use strict';

/**
 * Esta função transforma o JSON, vindo do servidor, em html
 * passível de ser introduzido na página principal da loja. As
 * tags são criadas, com seus estilos aplicados, e então,
 * posicionadas dentro da <section id="shop">
 *
 * @param JSON com os registros dos produtos.
 */
function adds(params) {
    //make the adds appea
    for (let i = 0; i <= Object.keys(params).length - 1; i++) {
    //params.data.mostsold.forEach(function(params){
        const add_box = document.createElement("article")
        
        const title_add = document.createElement("p")
        title_add.innerText = params[i].nome
        add_box.appendChild(title_add)

        const img_add = document.createElement("img")
        img_add.src = ".." + params[i].img_path
        img_add.alt = "product image"
        add_box.appendChild(img_add)

        const price = document.createElement("p")
        price.innerText = "R$" + params[i].valor
        price.className = "price-text"
        add_box.appendChild(price)

        const buy_link= document.createElement("a")
        buy_link.href = "./shop.php?number=" + params[i].id
        buy_link.innerText = "buy"
        add_box.appendChild(buy_link)

        document.querySelector("#shop").appendChild(add_box)
    }

}

/**
 * Abrindo uma conexão com o servidor para buscar os dados
 * e iniciar a página
 */
var conn = new XMLHttpRequest();
console.log("--REPORT--\nSystem Initialized\n----------");

conn.onreadystatechange = function(){
    console.log("--REPORT--\nConnection Changed\n----------");
    if(conn.readyState == 4){
        console.log("--REPORT--\nRequest Sucessceful\n----------");


        var result = JSON.parse(conn.response)

        /**
         * @var data : é o array convertido de JSON vindo do PHP
         * com os dados dos produtos.
         */
        var data = JSON.parse(conn.responseText)

        //chamando a função para criar o html.
        adds(data.data.most_sold)
    }
    console.log(conn)
}

//enviando a requisição para o servidor
conn.open("GET", "./bringProducts.php");
conn.send();