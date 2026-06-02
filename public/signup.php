<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../style/shop.css">
    <link rel="stylesheet" type="text/css" href="../style/links.css">
    <link rel="stylesheet" type="text/css" href="../style/form.css">
    <link rel="stylesheet" type="text/css" href="../style/modal.css">
    <link rel="stylesheet" type="text/css" href="../style/text.css">
    <link rel="stylesheet" type="text/css" href="../style/footer.css">
    <script src="https://kit.fontawesome.com/9eddd44c51.js" crossorigin="anonymous"></script>

    <title>Luiz Livros</title>
  </head>
  <style>

    body
    {
      margin: 0;
    }

    h1 {
      font-size: 1.8em;
    }

    header > section
    {
      width: 100%;
      padding: 15px;

      background-color: var(--color2);

    }

    header .f-header > div
    {
      width: fit-content;
      margin: auto;
    }
    main.signup-main
    {
      position: relative;
      width: 70%;
      /*height: 96vh;*/
      padding: 10px;
      margin: auto;

      background: none;
    }
    main.signup-main > section
    {
    }
    .f-box-pg
    {
      display: flex;
      flex-direction: row;
      justify-content: space-around;
      /*align-items: center;*/

      /*height: 96vh;*/

    }
    #first-page
    {
      padding: 20px;
    }
    #fs-form, #sd-form
    {
      width: 45%;

      padding: 20px;
    }
    .signup-header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      /*align-items: center;*/

      width: 100%;
    }
    .back-header-section
    {
      position: relative;
      width: 50px;

    }
    .back-header-section > button
    {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);

      border: none;
      background: none;
      font-size: 1.7em;
      color: var(--color3);/*#ff0000*/;
    }

    button.sbf
    {
      width: 100%;
      padding: 10px;
    }


    .exp-section
    {
      font-size: 0.7em;
      text-align: center;
      width: 80%;
      margin: auto;
    }

    #social-media-text
    {
      text-align: center;
      font-size: 1.5em;
    }

    #social-media-area
    {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: row;
    }
    #social-media-area > div
    {
      padding: 10px;
    }

    #facebook-button
    {
      padding: 10px;
      background-color: #5d85e9;
      border: none;
      outline: none;
      color: white;
      border-radius: 5px;
    }
    #facebook-button:hover
    {
      background-color: #4c6dbe;
    }
    #google-button
    {
      padding: 10px;
      /* color: white; */
      background-color: white;
      border: 1px solid red;
      border-radius: 5px;
      outline: none;
    }
    #google-button:hover
    {
      background-color: var(--color1);
    }

    #facebook-button > i, #google-button > i{
      padding-right: 5px;
    }
    .hidden
    {
      display: none;
    }

    .sd-form-area
    {
    border: 1px solid #d3d3d3;
    border-radius: 10px;
    padding: 10px;
    /*height: 56vh;*/
    align-items: center;
    }
    #sd-form form > .form-session
    {
      padding: 20px;
    }

    @media(max-width: 1666px)
    {
      main.signup-main
      {
        width: auto;
      }
    }
    @media(max-width: 1270px){
      .f-box-pg
      {
        display: block;
      }

      #fs-form, #sd-form
      {
        width: auto;
      }
    }

  </style>
  <body>
    <header>
      <section>
        <section class="f-header">
          <div>
            <img src="../images/couto-dark-transp-name.png">
          </div>
        </section>
      </section>
    </header>
    <main class="signup-main">
      <!--
      * Esta Section usa o display: flex; para alinhar os elementos na horizontal
      * -->
      <section class="f-box-pg" id="first-page">
        <!--
        *   Espaço para adicionar a logo da loja
        *
        * -->
        <section class="" id="left-side">
          <div>
            <img src="../images/coutos-light-transp.png">
          </div>
        </section>
        <section class="" id="right-side">
          <section class="" id="fst-form">
            <!--
            *  Área de título e botão de voltar
            *
            *  -->
            <section class="signup-header">
              <div>
                <h1>Criar Conta</h1>
              </div>
              <div>
                <a class="red-link" href="index.php" rel="link de voltar">Voltar</a>
              </div>
            </section>

            <!--
            *  Área do formulário de cadastro
            *
            *  -->
            <section>
              <div>
                <form class="std-form">
                  <div class="form-session">
                    <span>
                      <span class="input-body">
                        <input type="text" name="email" placeholder="Digite o seu Email">
                      </span>
                    </span>
                  </div>
                  <div class="form-session">
                    <div>
                      <button type="button" class="std-button sbf" id="alternarpaginas">Prosseguir</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
            <section>
              <div>
                <h1>Já Possui uma Conta?</h1>
              </div>
            <!--
            * Aqui está o formulário para Login
            *
            * -->
            </section>
            <section>
              <div>
                <form class="std-form">
                  <div class="form-session">
                    <span>
                      <span class="input-body">
                        <input type="email" placeholder="Informe o seu Email">
                      </span>
                    </span>
                  </div>
                  <div class="form-session">
                    <span>
                      <span class="input-body">
                        <input type="password" name="senha" placeholder="Informe a Senha">
                      </span>
                    </span>
                  </div>
                  <div class="form-session">
                    <div>
                      <button class="std-button sbf">Fazer Login</button>
                    </div>  
                  </div>
                </form>
              </div>
            </section>
          </section>
        </section>       
      </section>
      <section class="f-box-pg hidden" id="second-page">

          <section id="sd-form">
            <div class="sd-form-area">
              <section class="signup-header">
                <div>
                  <h1>Faça o seu cadastro</h1>
                </div>
                <div class="back-header-section">
                  <button id="voltarpagina">
                    <i class="fa-solid fa-backward"></i>
                  </button>
                </div>
              </section>
              <section>
                <div>
                  <form class="std-form">
                    <div class="form-session">
                      <div>
                        <h1 class="form-sub-title">Campos Obrigatórios</h1>
                      </div>
                      <span>
                        <span class="input-body-fat">
                          <input type="text" name="email" placeholder="Nome">
                        </span>
                      </span>
                      <span>
                          <span class="input-body-fat">
                            <input type="text" name="email" placeholder="Sobrenome">
                          </span>
                      </span>
                    </div>
                    <div class="form-session">
                      <span>
                        <span class="input-body-fat">
                          <input type="number" name="cpf" placeholder="CPF">
                        </span>
                      </span>
                    </div>
                    <div class="form-session">
                      <div>
                        <h1 class="form-sub-title">Data de Nascimento</h1>
                      </div>
                      <span>
                          <select class="std-select-fat">
                            <option selected>*Dia</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                            <option>11</option>
                            <option>12</option>
                            <option>13</option>
                            <option>14</option>
                            <option>15</option>
                            <option>16</option>
                            <option>17</option>
                            <option>18</option>
                            <option>19</option>
                            <option>20</option>
                            <option>21</option>
                            <option>23</option>
                            <option>24</option>
                            <option>25</option> 
                            <option>26</option>
                            <option>27</option>
                            <option>28</option>
                            <option>29</option>
                            <option>30</option>
                            <option>31</option>                                                                     
                          </select>
                      </span>
                      <span>
                        <select class="std-select-fat">
                          <option selected>*Mês</option>
                          <option>Janeiro</option>
                          <option>Fevereiro</option>
                          <option>Março</option>
                          <option>Abril</option>
                          <option>Maio</option>
                          <option>Junho</option>
                          <option>Julho</option>
                          <option>Agosto</option>
                          <option>Setembro</option>
                          <option>Outubro</option>
                          <option>Novembro</option>
                          <option>Dezembro</option>
                        </select>
                      </span>
                      <span>
                        <select class="std-select-fat">
                          <option selected>*Ano</option>
                          <option></option>
                          <option></option>
                          <option></option>
                        </select>
                      </span>
                    </div>
                    <div class="form-session">
                      <span>
                        <span class="input-body-fat">
                          <input type="text" name="email" placeholder="Telefone">
                        </span>
                      </span>
                    </div>
                    <div class="form-session">
                      <div>
                        <p>Endereço**</p>
                      </div>
                      <span>
                        <span class="input-body-fat">
                          <input type="number" name="cep" placeholder="CEP">
                        </span>
                      </span>
                      
                    </div>
                    <div class="form-session">
                      <span>
                        <span class="input-body-fat">
                          <input type="text" name="endereco" placeholder="Endereço">
                        </span>
                      </span>
                      <span>
                        <select class="std-select-fat">
                          <option selected>*Tipo de Residencia</option>
                          <option>Casa</option>
                          <option>Apartamento</option>
                          <option>Condominio</option>
                        </select>
                      </span>
                    </div>
                    <div class="form-session">
                      <span>
                        <span class="input-body-fat">
                          <input type="number" name="numero" placeholder="Número">
                        </span>
                      </span>
                    </div>
                    <div class="form-session">
                      <span>
                        <select class="std-select-fat">
                          <option selected>Estado*</option>
                          <option>Mato Grosso do Sul</option>
                          <option>Mato Grosso</option>
                          <option>Rondônia</option>
                          <option>Goiás</option>
                          <option>DF</option>
                          <option>São Paulo</option>
                          <option>Minas Gerais</option>
                          <option>Rio de Janeiro</option>
                          <option>Espírito Santo</option>
                          <option>Rio Grande do Sul</option>
                          <option>Santa Catarina</option>
                          <option>Paraná</option>
                          <option>Amazonas</option>
                          <option>Pará</option>
                          <option>Roraima</option>
                          <option>Amapá</option>
                          <option>Acre</option>
                          <option>Tocantins</option>
                          <option>Bahia</option>
                          <option>Cearpá</option>
                          <option>Paraíba</option>
                          <option>Rio Grande do Norte</option>
                          <option>Sergipe</option>
                          <option>Pernanbuco</option>
                          <option>Alagoas</option>
                        </select>
                      </span>
                      <span>
                        <span class="input-body-fat">
                          <input type="text" name="cidade" placeholder="Cidade">
                        </span>
                      </span>
                    </div>
                  </form>
                </div>
              </section>
            </div>          
          </section>
          <section id="fs-form">
              <div class="sd-form-area">
                <section class="signup-header">
                  <div>
                    <h1>Sobre sua conta</h1>
                  </div>
                </section>
                <form class="std-form">
                  <div class="form-session">
                    <span>
                      <span class="input-body-fat">
                        <input type="email" placeholder="Email">
                      </span>
                    </span>
                      <span>
                        <span class="input-body-fat">
                          <input type="password" name="senha" placeholder="Senha">
                        </span>
                    </span>
                  </div>
                  <div class="form-session">

                  </div>
                  <div class="form-session">
                    <span>
                      <input type="checkbox" name="oferta">
                      <label for="oferta">Quero receber <strong>ofertas e novidades</strong> da loja Couto's Books pelo meu email</label>
                    </span>
                  </div>
                  <hr>
                  <div class="form-session">
                    <span>
                      <input type="checkbox" name="termo">
                      <label for="termo">Declaro que li e concordo com o uso dos meus dados para a
                        compra e experiencia no site de acordo com os Termos de Privacidade.
                      </label>
                    </span>
                  </div>
                  <div class="form-session">
                    <div>
                      <button class="std-button sbf" id="criarconta">Criar Conta</button>
                    </div>  
                  </div>
                </form>
              </div>
          </section>
      </section>

    </main>
    <section class="social-media">
        <section id="social-media-text">
          <p>Acesse a sua conta no Couto's através de suas redes sociais.</p>
        </section>
        <section id="social-media-area">
          <div>
            <button id="facebook-button"><i class="fa-brands fa-facebook"></i>Conectar com Facebook</button>
          </div>
          <div>
            <button id="google-button"><i class="fa-brands fa-google"></i>Fazer login com o Google</button>
          </div>
        </section>
        <section class="exp-section">
          <p>Pessoa jurídica de direito privado, com sede na Rua da Assembléia, no 100, sala 2801, Centro, Cidade do Rio de Janeiro - RJ, CEP 20011-000, inscrita no CNPJ/MF sob o no 08.311.795/0001-60, uma plataforma digital de comércio eletrônico, que reúne inúmeros produtos em um só lugar e tem como um de seus objetivos facilitar a realização das compras de seus clientes por meio da internet, também chamada a seguir de "Couto's Books”. Canal de Atendimento "Formulário de Atendimento". Todo o conteúdo do site, fotos, imagens, logotipos, marcas e trade dress aqui veiculados são de propriedade exclusiva da Couto's Books ou de seus parceiros. É vedada qualquer reprodução sem autorização. Preços e condições de pagamento exclusivos para compras via internet, podendo variar nas lojas físicas. Ofertas válidas na compra de até 5 peças de cada produto por cliente, até o término dos nossos estoques para internet. A inclusão no carrinho não garante o preço e/ou a disponibilidade do produto. Caso os produtos apresentem divergências de valores, o preço válido é o exibido na tela de pagamento. Vendas sujeitas à análise e disponibilidade de estoque. As ações promocionais que envolvam a concessão de brindes são válidas enquanto durarem os estoques e podem ser encerradas sem aviso prévio. Os itens catalogados como "Usados" ou "Seminovos" são produtos singulares e apresentam estados de conservação variáveis. Tais itens podem conter marcas de manuseio, oxidação (páginas amareladas), grifos, assinaturas ou desgastes superficiais. O valor e a descrição são determinados individualmente pelo vendedor, baseados na edição e preservação do exemplar. Por se tratarem de peças únicas e exemplares de acervo, não garantimos a permanência do item em estoque ou a sua reposição, estando a venda condicionada à disponibilidade da unidade específica anunciada."</p>
        </section>
    </section>
    <footer class="std-footer">
      <section>
        <p>Developed by &copyNerdSoft</p>
      </section>
    </footer>
  </body>
  <script type="text/javascript">
    botao_alternar = document.querySelector("#alternarpaginas")

    pagina1 = document.querySelector("#first-page");
    pagina2 = document.querySelector("#second-page");

    botao_alternar.onclick = function(){
      pagina1.classList.toggle("hidden");
      pagina2.classList.toggle("hidden");
    }

    /**
     * Aqui é a função do botão de retornar dá segunda página
     * 
     * */

    botao_alternar2 = document.querySelector("#voltarpagina");

    botao_alternar2.onclick = function(){
      pagina1.classList.toggle("hidden");
      pagina2.classList.toggle("hidden");
    }
  </script>
</html>