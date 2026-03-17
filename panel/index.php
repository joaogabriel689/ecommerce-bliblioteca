<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style/header.css">
	<link rel="stylesheet" type="text/css" href="../style/menu.css">
	<link rel="stylesheet" type="text/css" href="../style/table.css">
	<link rel="stylesheet" type="text/css" href="../style/footer.css">
	<link rel="stylesheet" type="text/css" href="../style/text.css">
	<link rel="stylesheet" type="text/css" href="../style/links.css">

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<title>Panel - Couto's</title>
</head>
<style>
	
	html, body{
		margin: 0;
	}

	main {
		padding: 10px;
	}

	#bck-space {
		min-height: 200px;

		background-image: url("../images/background-image.jpg");
		background-size: 100%;

		background-attachment: fixed;
	    background-position: center;
	    background-repeat: no-repeat;
	    background-size: cover;

	}

	#img-area img {
		width: 400px;
	}

	main #main-content {
		min-width: 80%;
	}

	section#main-content > section {
		padding: 10px;
	}

	section#main-content > #title {
		padding: 20px 20px 0px 20px;


	}

	.flex-title {
		display: flex;
		justify-content: space-between;
	}
	.flex-graf {
		display: flex;
		justify-content: space-around;
	}

	#title h1.center {

	    position: relative;
	    top: 50%;
	    transform: translate(0px, -50%);
	}
	.area-grafico {
		width: 500px;
	}


</style>
<body>
	<header class="spc-head">
		<section>
			<section>
				<div id="img-area">
					<img src="../images/couto-dark-transp-name.png">
				</div>
			</section>
		</section>
	</header>
	<section id="bck-space">
	</section>
	<main>


		<section id="main-content">
			<section class="flex-title" id="title">
				<section>
					<h1 class="no-mar center">Painel de Controle</h1>	
				</section>
				<section>
					<div>
						<a class="red-link" href="../public/index.php">Voltar</a>
					</div>
				</section>
			</section>
			<hr>
			<section>
				<nav class="big-nav">
					<section class="menu-cards">
						<article class="card" id="card-produtos">
							<section>
								<div>
									<h1>Produtos<i></i></h1>
								</div>
							</section>
							<section>
								<div>
									<p><strong>Qtd. Total:</strong> 200</p>
									<p><strong>entradas:</strong> 39</p>
								</div>
							</section>
						</article>
						<article class="card" id="card-clientes">
							<section>
								<div>
									<h1>Usuários<i></i></h1>
								</div>
							</section>
							<section>
								<div>
									<p>n. de registos: 200</p>
									<p>entradas: 39</p>
								</div>
							</section>
						</article>
						<article class="card">
							<section>
								<div>
									<h1>Acessos <i></i></h1>
								</div>
							</section>
							<section>
								<div>
									<p>n. de registos: 200</p>
									<p>entradas: 39</p>
								</div>
							</section>
						</article>
					</section>
					<!--ul>
						<li><p>Produtos</p></li>
						<li><p>Clientes</p></li>
						<li><p>Pedidos</p></li>
						<li><p>Acessos<p></li>
					</ul-->
				</nav>
			</section>
			<section id="title">
				<section>
					<h1>Relatórios</h1>
					<hr>
				</section>
			</section>
			<section>
				<section>
					<article>
						<p>
						valores referentes a seus respectivos períodos. Para informações mais detalhadas, acesse o portal de acessos e vendas.</p>
					</article>
					<section class="flex-graf">
						<article class="area-grafico">
							<canvas class="grafico" id="acessos-graf"></canvas>
						</article>
						<article class="area-grafico">
							<canvas id="vendas-graf"></canvas>						
						</article>
					</section>
				</section>
			</section>
			<section id="title">
				<h1 class="no-mar">Pedidos</h1>
				<hr>
			</section>
			<section>
				<article class="panel">
					<section>
						<p><strong>Pedidos Totais:</strong> 22</p>
					</section>
					<section>
						<p><strong>Pedidos Pendentes:</strong> 12</p>
					</section>
					<section>
						<p><strong>Pedidos Entregues:</strong> 59</p>
					</section>
				</article>
			</section>
			<section>
				<div class="table-area">
					<table class="std-table">
						<tr id="tb-head">
							<th>ID</th>
							<th>PRODUTO</th>
							<th>CLIENTE</th>
							<th>VALOR</th>
							<th>CIDADE</th>
							<th>STATUS</th>
							<th>DATA</th>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="green-bg">Finalizado<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="green-bg">Finalizado<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="green-bg">Finalizado<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="green-bg">Finalizado<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="red-bg">Pendente<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="gray-bg">Entregue!<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="red-bg">Pendente<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="gray-bg">Entregue<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="red-bg">Pendente<span></td>
							<td>22/10/2026</td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td><span class="gray-bg">Entregue<span></td>
							<td>22/10/2026</td>
						</tr>
			
					</table>
				</div>
			</section>			
		</section>

	</main>
	<footer class="std-footer">
		<section>
			<p>&copyNerdSoft</p>
		</section>
	</footer>
	<script type="text/javascript">
		document.querySelector("#card-produtos").onclick = function(){
			window.location = "produtos.php"
		}

		document.querySelector("#card-clientes").onclick = function() {
			window.location = "clientes.php"
		}


	</script>
	<script src="./graficos-main-panel.js"></script>
</body>
</html>