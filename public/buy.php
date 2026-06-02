<?php 



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/shop.css">
    <link rel="stylesheet" type="text/css" href="../style/links.css">
    <link rel="stylesheet" type="text/css" href="../style/buy.css">
    <link rel="stylesheet" type="text/css" href="../style/form.css">
    <link rel="stylesheet" type="text/css" href="../style/modal.css">
    <link rel="stylesheet" type="text/css" href="../style/text.css">
    <script src="https://kit.fontawesome.com/9eddd44c51.js" crossorigin="anonymous"></script>
    <title>Luiz Livros</title>
  </head>
  <body>
    <!-- options to your account and a link to home-->
    <section id="logo-header-section">
        <img id="site-logo" src="../images/couto-dark-transp-name.png" alt="site logo">
    </section>
    <header>
        <div id="header-start">
            <span>
                <span class="search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="search-input" placeholder="what you're looking for?">
                </span>
            </span>
        </div>
        <div id="header-end">
                <a href="./signup.php">Login<i class="fa-solid fa-user"></i></a>
                <a href=""><i class="fa-solid fa-bag-shopping"></i></a>
        </div>
    </header>
    <!-- main area
        here will be the shop area, whit its options and stuff
    -->
    <main>
    
    <section>
    	<section class="upper-payment-section order-section">
            <!-- 
            * Aqui fica uma sessão superior para fazer o pagamento
            *
            * -->
    		<section>
    			<h1>Confirme as informações do seu pedido:</h1>
    		</section>
    		<section>
    			<div>
	    			<p>Valor Total: R79,99</p>    		
    			</div>
    			<div>
    				<button class="green-button">Finish Order</button>
    			</div>
    		</section>

    	</section>

    	<section class="order-info order-section">
    		<section>
				<!--<section>

					<div>
						<p>shipping value:<p>
					</div>
				
				</section>-->
				<article>
					<div>
						<h1>Your Information:</h1>
					</div>
					<section>
						<div>
							<p> <strong>CPF:</strong> 11246452352
							<p><strong>Nome:</strong> Luiz Henrique da Mota Couto</p>
							<p><strong>Rua:</strong> Rua José Cangussu 436 - Vilas Boas</p>
						</div>
					</section>
                    <section>
                        <button class="std-button">Deseja alterar o endereço?</button>
                    </section>
				</article>
            </section>
			<section>	
				<article>
					<section>
						<div>
							<h1>Formas de Pagamento</h1>
						</div>
                        <div>
                            <ul>
                                <li>
                                    <img src="../images/2529_mastercard.svg">
                                </li>
                                <li>
                                    <img src="../images/3501_dinersclub.svg">
                                </li>
                                <li>
                                    <img src="../images/3688_pix.svg">
                                </li>
                                <li>
                                    <img src="../images/4779_hipercard.svg">
                                </li>
                                <li>
                                    <img src="../images/7525_visa.svg">
                                </li>
                                <li>
                                    <img src="../images/4591_amex.svg">
                                </li>
                            </ul>
                        </div>
					</section>
                    <section>
                        <section>
                            <select class="std-select" style="width: 100%;">
                                <option value="pix" selected>Pix</option>
                                <option>Boleto</option>
                                <option>Crédito</option>
                                <option>HyperCard</option>
                                <option>PayPal</option>
                            </select>                            
                        </section>

                    </section>

				</article>
			
			</section>    		
    	</section>
    </section>
    <section class="your-products">
        <!-- 
        *   Area de listagem dos produtos adicionados no carrinho. 
        *
        -->
        <section id="products-show">
            <article>
                <section>
                    <ul>
                        <li>
                            <div>
                                <img src="../assets/products/alice_pais_maravilhas_1.jpg" alt="product photo">
                            </div>                            
                        </li>
                        <li>
                            <div>
                                <p>Alice no País das maravilhas.</p>
                                <p>R$79,99</p>
                            </div>                            
                        </li>
                    </ul>

                       
                </section>
                <section id="actions-area">
                    <!--
                    * Area para algumas ações de exclusão e acesso a página do produto 
                    *
                    -->
                    <div>
                        <a id="takeout-link" href="shop.php?number=2" title="Excluir produto"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </section>

            </article>
            <article>
                <section>
                    <ul>
                        <li>
                            <div>
                                <img src="../assets/products/alice_pais_maravilhas_1.jpg" alt="product photo">
                            </div>                            
                        </li>
                        <li>
                            <div>
                                <p>Alice no País das maravilhas.</p>
                                <p>R$79,99</p>
                            </div>                            
                        </li>
                    </ul>

                       
                </section>
                <section id="actions-area">
                    <!--
                    * Area para algumas ações de exclusão e acesso a página do produto 
                    *
                    -->
                    <div>
                        <a id="takeout-link" href="shop.php?number=2" title="Excluir produto"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </section>

            </article>
            <article>
                <section>
                    <ul>
                        <li>
                            <div>
                                <img src="../assets/products/alice_pais_maravilhas_1.jpg" alt="product photo">
                            </div>                            
                        </li>
                        <li>
                            <div>
                                <p>Alice no País das maravilhas.</p>
                                <p>R$79,99</p>
                            </div>                            
                        </li>
                    </ul>

                       
                </section>
                <section id="actions-area">
                    <!--
                    * Area para algumas ações de exclusão e acesso a página do produto 
                    *
                    -->
                    <div>
                        <a id="takeout-link" href="shop.php?number=2" title="Excluir produto"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </section>

            </article>
        </section>
        
    </section>
    <section>
    </section>
    </main>
    <footer>
        <section>
            <span>
                <h1>Institutional</h1>
                <ul>
                    <li><a href="">Who we are:</a></li>
                    <li><a href="">Usage rules</a></li>
                    <li><a href="">Politics</a></li>
                    <li><a href="">exchange or return</a></li>
                </ul>
            </span>
            <span>
                <h1>Common Questions</h1>
                <a href="">Sebo</a>
                <a href="">How to pack your books</a>
                <a href="">Buy used books online</a>
            </span>
            <span>
                <div>
                    <h1>Follow us</h1>
                    <i class="fa-brands fa-square-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <p>47 9987-0233</p>
                </div>
            </span>
            <span>
                <h1>Ways of Payment</h1>
                <img src="../images/125X125_pagarme.png" alt="ways of payment">                
            </span>
           
        </section>
        
        <p>LuizBooks online store - retail services - Rua Frederico Weege, 400 - Centro - Pomerode/SC - 89107-000 - CNPJ 23.640.838/0001-45 - e-mail: contato@containercultura.com.br</p>
        <p class="copy">&copy;NerdSoft</p>

    </footer>
    <section class="modal-bg hidden">
        <section class="modal-content md-size cnt">
            <section>
                <!--Cabeçario do Modal-->
                <section class="modal-header">
                    <!--Composto em duas partes
                    *   O Título
                    *   E o Botão para fechar a janela.
                    -->
                    <section>
                        <h1>Alterar Dados Castrais</h1>
                    </section>
                    <section class="hd-right vt-cnt-dad">
                        <div class="vt-cnt">
                            <button class="invisible"><i class="fa-regular fa-circle-xmark modal-close"></i></button>
                        </div>
                    </section>
                </section>
                <!--
                * Aqui fica a sessão principal do nosso modal, local onde estará
                * o formulárío com os dados de endereço e nome de quem será feito
                * o pedido.
                *
                -->
                <section>
                    <div class="form-area" style="width:auto">
                        <form class="std-form">
                            <div class="form-session">
                                <span>
                                    <label for="estado-inp">Estado</label>
                                    <select id="estado-inp">
                                        <option>Mato Grosso do Sul</option>
                                        <option>Mato Grosso</option>
                                        <option>DF</option>
                                        <option>São Paulo</option>
                                        <option>Rio de Janeiro</option>
                                        <option>Paraná</option>
                                        <option>Espirito Santo</option>
                                        <option>Santa Catarina</option>
                                        <option>Rio Grande do Sul</option>
                                        <option>Goiás</option>
                                    </select>
                                </span>
                                <span>
                                    <label for="cidade-inp">Cidade</label>
                                    <select id="cidade-inp">
                                        <option>Campo Grande</option>
                                        <option>Ivinhema</option>
                                        <option>Bodoquena</option>
                                        <option>Bandeirantes</option>
                                        <option>São Gabriel do Oeste</option>
                                        <option></option>
                                        <option></option>
                                        <option></option>
                                        <option></option>
                                        <option></option>

                                    </select>
                                </span>
                            </div>
                            <div class="form-session">
                                <span>
                                    <!--<label for="inp-cep">CEP</label>-->
                                    <span class="input-body">
                                        <input type="number" name="cep" id="inp-cep" placeholder="CEP">
                                    </span>
                                </span>
                                <span>
                                    <span class="input-body">
                                        <input type="number" name="numero" placeholder="Número">
                                    </span>
                                </span>
                            </div>
                            <div class="form-session">
                                <span>
                                    <span class="input-body">
                                        <input type="text" name="referencia" placeholder="Referencia" style="width: 100%; display: inline-block;">
                                    </span>
                                </span>
                            </div>
                            <div class="form-session">
                                <div class="sub-lf">
                                    <input class="green-submit" type="submit" name="submit">
                                </div>
                            </div>
                        </form>                        
                    </div>

                </section>
            </section>
        </section>
    </section>
    <script type="text/javascript" src="main.js"></script>
    <script type="module" src="setRelated.js"></script>
  </body>
</html>
  