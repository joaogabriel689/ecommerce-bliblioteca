
const grafico1 = document.querySelector("#acessos-graf")
const grafico2 = document.querySelector("#vendas-graf")


new Chart(grafico1, {
	type: 'bar',
	data: {
		labels: ["jan", "fev", "mar", "abr", "mai", "junh", "julh", "Ago", "set", "Out", "Nov", "Dec"],
		datasets: [{
			label: "Acessos da loja por mês",
			data: [50, 43, 46, 46, 50, 52, 40, 54, 57, 61, 55, 71],
			backgroundColor: '#88B0BF'
		}]
	}

})

new Chart(grafico2, {
	type: 'line',
	data: {
		labels: ["jan", "fev", "mar", "abr", "mai", "junh", "julh", "Ago", "set", "Out", "Nov", "Dec"],
		datasets: [{
			label: "Vendas por período",
			data: [45, 32, 40, 41, 50, 55, 55, 56, 50, 40, 45, 67],
			fill: false,
			tension: 0.5
		}]
	}
})


