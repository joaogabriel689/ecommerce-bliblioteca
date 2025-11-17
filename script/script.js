
var botao = document.getElementById('mobile-menu-button');
var menu = document.getElementById('mobile-menu');
botao.onclick = function() {
    if(menu.style.left == '0px') {
        menu.style.left = '-100%';
    } else {
        menu.style.left = '0px';
    }
}
var links = menu.getElementsByTagName('a');
for(var i = 0; i < links.length; i++) {
    links[i].onclick = function() {
        menu.style.left = '-100%';
    }
}