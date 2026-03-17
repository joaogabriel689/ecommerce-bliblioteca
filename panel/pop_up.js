/*
 * Neste aquivo está tratado todas manipulações de eventos
 * para janelas Pop-Up.
 *
 */

alert("helooo2");

//selecionando todos os botoês Edit.
let editOpt = document.querySelectorAll(".edit-option");

editOpt.forEach(function(item){
	//console.log(item)

	item.addEventListener("click", function(){
		document.querySelector("#pop-up-edit").classList.toggle("hidden");
		document.querySelector("body").classList.toggle("no-scroll")
	})

})

let cancEdit = document.querySelectorAll(".cancelar-edit")

cancEdit.forEach(function(item){
	//console.log(item);
	item.addEventListener("click", function(){
		document.querySelector("#pop-up-edit").classList.toggle("hidden");
		document.querySelector("body").classList.toggle("no-scroll")
	})

})
//console.log(editOpt);