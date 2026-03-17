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
	<link rel="stylesheet" type="text/css" href="../style/form.css">

	<script src="https://kit.fontawesome.com/9eddd44c51.js" crossorigin="anonymous"></script>
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

	#title h1 {

	    position: relative;
	    top: 50%;
	    transform: translate(0px, -50%);
	}


	.center {
		display: block;
		width: fit-content;
		margin: auto;
	}

	.left {
		display: flex;
		justify-content: right;
	}

	/*
	 * Configurações da janela Pop-up!
	 *
	 *
	 **/
	body.no-scroll
	{
		overflow: hidden;
	}
	.hidden
	{
		display: none;
	}

	.pop-up-back
	{
	    position: fixed;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    background-color: #000000a1;
	}

	.pop-up-area
	{
		position: relative;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 60%;

		/*background-color: var(--color1);*/
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
					<h1 class="no-mar">Painel de Clientes e Usuários</h1>	
				</section>
				<section>
					<div>
						<a class="red-link" href="index.php">Voltar</a>
					</div>
				</section>
			</section>
			<hr>
			<section>
				<section class="form-area">
					<section>
						<h1><i class="fa-solid fa-user-plus"></i> Adicionar Usuário:</h1>
					</section>					
					<form class="std-form">
						<div class="form-session">						
							<span>
								<span class="input-body">
									<input type="text" name="nome" placeholder="Nome:">
								</span>
							</span>
							<span>
								<span class="input-body">
									<input type="text" name="telefone" placeholder="Telefone:">
								</span>
							</span>
							<span>
								<span class="input-body">
									<input type="number" name="cpf" placeholder="CPF:">
								</span>
							</span>
						</div>
						<div class="form-session">
							<span class="center">
								<select class="std-select" name="Tipo:">
									<option value="1">Cliente</option>
									<option value="2">Autorizado</option>
									<option value="3">Administrador</option>
								</select>

							</span>
						</div>
						<div class="form-session">
							<span class="inline-block">
								<span class="input-body">
									<input type="text" name="Senha" placeholder="Senha">
								</span>
							</span>
							<span class="inline-block">
								<span class="input-body">
									<input type="text" name="email" placeholder="Email">
								</span>
							</span>
							<span class="inline-block">
								<span class="input-body">
									<input type="number" name="data_nascimento" placeholder="Data de Nascimento:">
								</span>
							</span>
							
						</div>
						<div class="form-session">
							<section class="left">
								<span>
									<input class="green-submit" type="submit" name="" value="Cadastrar">
								</span>
							</section>
						</div>
					</form> 				
				</section>
			</section>
			<section>
				<article class="panel">
					<section>
						<p><strong>Total de Produtos:</strong> 22</p>
					</section>
					<section>
						<p><strong>Produtos com baixa:</strong> 12</p>
					</section>
					<section>
						<p><strong>Produtos para venda:</strong> 59</p>
					</section>
				</article>
			</section>
			<section>
				<div class="table-area">
					<table class="std-table">
						<tr id="tb-head">
							<th>ID</th>
							<th>NOME</th>
							<th>TELEFONE</th>
							<th>EMAIL</th>
							<th>GRUPO</th>
							<th colspan="4">AÇÕES</th>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>
						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>						
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

						</tr>
						<tr>
							<td>22</td>
							<td>Demons Slayer Mangá</td>
							<td>Luiz Henrique</td>
							<td>33.99</td>
							<td>Campo Grande</td>					
							<td>22/10/2026</td>
							<td><i class="fa-solid fa-arrow-down table-action" placeholder="baixa" title="baixa"></i></td>
							<td class="edit-option"><i class="fa-regular fa-pen-to-square table-action" title="editar"></i></td>
							<td><i class="fa-regular fa-trash-can table-action" title="excluir"></i></td>
							<td><i class="fa-solid fa-info table-action" title="mais informações"></i></td>

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

	<section class="pop-up-back hidden" id="pop-up-edit">
		<section class="pop-up-area">
			<section class="form-area">
				<form class="">
					<section>
						<h1><i class="fa-solid fa-user-plus"></i> Alterar:</h1>
					</section>					
					<form class="std-form">
						<div class="form-session">
							
							<span>
								<span class="input-body">
									<input type="text" name="nome" placeholder="Nome:">
								</span>
							</span>
							<span>
								<span class="input-body">
									<input type="text" name="telefone" placeholder="Telefone:">
								</span>
							</span>
							<span>
								<span class="input-body">
									<input type="number" name="cpf" placeholder="CPF:">
								</span>
							</span>
						</div>
						<div class="form-session">
							<span class="center">
								<select class="std-select" name="Tipo:">
									<option value="1">Cliente</option>
									<option value="2">Autorizado</option>
									<option value="3">Administrador</option>
								</select>

							</span>
						</div>
						<div class="form-session">
							<span class="inline-block">
								<span class="input-body">
									<input type="text" name="Senha" placeholder="Senha">
								</span>
							</span>
							<span class="inline-block">
								<span class="input-body">
									<input type="text" name="email" placeholder="Email">
								</span>
							</span>
							<span class="inline-block">
								<span class="input-body">
									<input type="number" name="data_nascimento" placeholder="Data de Nascimento:">
								</span>
							</span>
							
						</div>
						<div class="form-session">
							<section class="left">
								<span>
									<input class="green-submit" type="submit" name="" value="Alterar">
								</span>
								<span>
									<a class="red-link cancelar-edit">Cancelar</a>
								</span>
							</section>
						</div>
					</form> 						
				</form>
			</section>
		</section>
	</section>
	<script type="text/javascript" src="pop_up.js"></script>
</body>
</html>