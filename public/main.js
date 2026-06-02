/**
 *  (c) redxam llc and affiliates. Confidential and proprietary.
 *
 *  @author Luiz-Mtca-tech
 *  @format
 */

'use strict';

document.querySelector("#cat-more").onmouseover = function(){
    document.querySelector("#more-list").className = "class-more-list"

}
/*Configurando um Delay para disparar a função de esconder o elemento #cat-more*/
function hide_cat_more(){
    document.querySelector("#more-list").className = "hidden"
    //alert("Hidden!")

}
const HIDDEN_CAT_MORE = setTimeout(hide_cat_more, 2000);

document.querySelector("#cat-more").onmouseout = function(){
    clearTimeout(HIDDEN_CAT_MORE)
}


document.querySelector("#more-list").onmouseover = function(){
    document.querySelector("#more-list").className = "class-more-list"
}
document.querySelector("#more-list").onmouseout = function(){
    
    document.querySelector("#more-list").className = "hidden"
}



document.querySelector("#site-logo").onclick = function(){
	
	window.location = "./index.php";
}