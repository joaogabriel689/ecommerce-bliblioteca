<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="shortcut icon" href="images/logo-image.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style/index.css">
    <title>bliblioteca online</title>
</head>
<body>
     <header>
        
            <div>
                <img src="/images/logo-image.png" alt="">
                <h1>bliblioteca online</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="">home</a></li>
                    <li><a href="">livros</a></li>
                    <li><a href=""><i class="fa-solid fa-heart"></i></a></li>
                    <li><a href=""><i class="fa-solid fa-cart-shopping"></i></a></li>
                </ul>
            </nav>
            <?php
            if (empty($_SESSION['user'])){
                echo '<button><a href="login.html">login</a></button>';
            }else{
                echo '<button><a href="painel_controle.html"><i class="fa-solid fa-user"></i></a></button>';
            }


            
            ?>
        
    </header>
    
    <main>
        <h2>Bem-vindo à nossa biblioteca online!</h2>
        <section id="welcome-section">
            <article>
                
                <p>Aqui você pode encontrar uma vasta coleção de livros para todos os gostos.</p>
               
            </article>
            <img src="images/welcome-image.png" alt="">
        </section>
        <section id="catalog-books">
            <article>
                <h2>Catálogo de Livros</h2>
                <p>Explore nossa seleção de livros disponíveis para empréstimo ou compra.</p>
                <a href="">veja o catalogo completo aqui</a>
            </article>
            <div id="books">
                <div class="card-product">
                    <div class="image-book">
                        <img src="" alt="Capa do Livro Exemplo">
                    </div>
                    <h3>Título do Livro Exemplo</h3>
                    <p>Autor: Autor Exemplo</p>
                    <p>Descrição breve do livro exemplo.</p>
                    <button>adicionar aos favoritos</button>
                    <button>Adicionar ao Carrinho</button>
                </div>
                <div class="card-product">
                    <div class="image-book">
                        <img src="" alt="Capa do Livro Exemplo">
                    </div>
                    <h3>Título do Livro Exemplo</h3>
                    <p>Autor: Autor Exemplo</p>
                    <p>Descrição breve do livro exemplo.</p>
                    <button>adicionar aos favoritos</button>
                    <button>Adicionar ao Carrinho</button>
                </div>
                <div class="card-product">
                    <div class="image-book">
                        <img src="" alt="Capa do Livro Exemplo">
                    </div>
                    <h3>Título do Livro Exemplo</h3>
                    <p>Autor: Autor Exemplo</p>
                    <p>Descrição breve do livro exemplo.</p>
                    <button>adicionar aos favoritos</button>
                    <button>Adicionar ao Carrinho</button>
                </div>
                <div class="card-product">
                    <div class="image-book">
                        <img src="" alt="Capa do Livro Exemplo">
                    </div>
                    <h3>Título do Livro Exemplo</h3>
                    <p>Autor: Autor Exemplo</p>
                    <p>Descrição breve do livro exemplo.</p>
                    <button>adicionar aos favoritos</button>
                    <button>Adicionar ao Carrinho</button>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <section id="social-media">
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-github"></i></a>
            <a href=""><i class="fa-brands fa-linkedin"></i></a>

        </section>
        <p>&copy; 2024 Biblioteca Online. Todos os direitos reservados.</p>

    </footer>
    
</body>
</html>