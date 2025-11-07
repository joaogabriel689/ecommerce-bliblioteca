var category = document.getElementById('category-div')
var option = document.getElementsByName('option')
var new_category = document.getElementById('new')
var new_text = document.getElementById('new_input')


new_category.addEventListener('click', () => show_element(new_text))
function show_element(element){
    element.setAttribute('class', 'activete');
}