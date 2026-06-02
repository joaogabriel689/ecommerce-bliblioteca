<!-- 
 *  (c) redxam llc and affiliates. Confidential and proprietary.
 *
 *  @author Luiz-Mtca-tech
 *
 -->
 <?php

require_once __DIR__."/../controllers/productcontroller.php";

ini_set("display_errors", 1);
ini_set("display_ini_set", 1);
error_reporting(E_ALL);

//session_start();

$product_id = filter_input(INPUT_GET, "number", FILTER_VALIDATE_INT);

$control = new Productcontroller();

$product_array = $control->show_product($product_id);
$product_array = $product_array["data"];

//$_SESSION["category"] = $product_array["categoria"];
//$_SESSION["term"] = $product_array["nome"][0];
$term = $product_array["nome"][0];
$filters = ["category" => $product_array["categoria"]];

$related_products = $control->list_products($term, $filters);

$related_products = $related_products["data"];

$all_products = $control->index();
$all_products = $all_products["data"]["most_sold"];

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
        <section id="categories">
            <!--Categories bar-->
            <span id="cat-title">
                <p>Categories</p>
            </span>
            <span>
                <ul id="categorie-list">
                    <li><a href="">Releases</a></li>
                    <li><a href="">Foreign Literature</a></li>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Recommend</a></li>
                    <li id="cat-more">
                        <a href="">More...</a>
                        <section id="more-list" class="hidden">
                            <ul>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>                       
                
                            </ul>
                            <ul>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                
                            </ul>
                            <ul>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>                       
                
                            </ul>
                            <ul>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                                <li><a href="">Ficcion</a></li>
                                <li><a href="">Auto</a></li>
                                <li><a href="">Wear</a></li>
                                <li><a href="">Computers</a></li>
                                <li><a href="">Stories</a></li>
                                <li><a href="">Games</a></li>
                                <li><a href="">Fantasy</a></li>
                
                            </ul>
                        </section>
                    </li>

                </ul>
                
            </span>
        </section>
        <section id="main-area-add">
            <aside id="adds-left">
                <h1>Related Itens</h1>
                
                <?php 
                $loops = count($related_products) > 3 ? 3 : count($related_products) - 1;
                
                for($i = 0; $i <= $loops; $i++){
                    ?>
						<article>
                    		<img src="../<?php echo $related_products[$i]["img_path"]?>" alt="book photo">
                    			<div class="stars r-5-0"></div>
                    			<div>
                        			<a href="./shop.php?number=<?php echo $related_products[$i]["id"]?>"><?php echo $related_products[$i]["nome"]?></a>
                        			<!-- p class="sub-description">
									<?php //echo $related_products[$i]["descri"]?>
									</p-->
                        			<p class="price">R$<?php echo $related_products[$i]["valor"]?></p>
                    			</div>
                		</article>
                    <?php
                }
                
                ?>
                <!-- ><article>
                    <img src="../assets/img/panslab.jpg" alt="">
                    <div class="stars r-5-0"></div>
                    <div>
                        <a href="#">Pan's Labirinth</a>
                        <p class="sub-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nulla minima enim officia, inventore laudantium magnam quisquam
                            a eaque, eum officiis provident saepe facere,
                            totam accusantium odit? Ipsum quod mollitia quos.</p>
                        <p class="price">R$12.99</p>
                    </div>

                </article>
                <article>
                    <img src="../assets/img/panslab.jpg" alt="">
                    <div class="stars r-5-0"></div>
                    <div>
                        <a href="#">Pan's Labirinth</a>
                        <p class="sub-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nulla minima enim officia, inventore laudantium magnam quisquam
                            a eaque, eum officiis provident saepe facere,
                            totam accusantium odit? Ipsum quod mollitia quos.</p>
                        <p class="price">R$12.99</p>
                    </div>

                </article>
                <article>
                    <img src="../assets/img/panslab.jpg" alt="">
                    <div class="stars r-5-0"></div>
                    <div>
                        <a href="#">Pan's Labirinth</a>
                        <p class="sub-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nulla minima enim officia, inventore laudantium magnam quisquam
                            a eaque, eum officiis provident saepe facere,
                            totam accusantium odit? Ipsum quod mollitia quos.</p>
                        <p class="price">R$12.99</p>
                    </div>

                </article>

                </article>
                -->
            </aside>
            <div>
                <section id="buy">
                    <span>
                       <!--  <h1>Alice's Adventures in Wonderland</h1> -->
                        <img src="<?php echo "..".$product_array["img_path"]?>" alt="">
                    </span>
                    <span>
                        <h2><?php echo $product_array["nome"];?></h2>
                        <span class="stars r-5-0"></span>
                        <span class="stars-info">5 de 5 estrelas</span>
                        <div id="review-favorite-div">
                            <a href="" class="review-link">read reviews <i class="fa-regular fa-star"></i></a>
                            <!-- <i class="fa-solid fa-star"></i> -->
                
                            <a href="" class="favorite-link">Add to your list <i class="fa-regular fa-heart"></i></a>
                        </div>
                        <hr>
                        <!--<i class="fa-solid fa-heart"></i>-->
                        <p class="on">In Stock</p>
                        <p class="price"><?php echo "R$".$product_array["valor"];?></p>
                        <div>
                            <a href="" class="add-cart">Add to cart <i class="fa-solid fa-cart-shopping"></i></a>
                            <a href="./buy.php?number=<?php echo $product_array["id"]?>" class="buy-now">Buy now</a>
                        </div>
                        <hr>
                        <article id="details">
                            <p><?php echo $product_array["descri"]?>
                            </p>
                            <ul id="details-list">
                                <li>
                                    <p>Autor</p>
                                    <i class="fa-solid fa-user-tie"></i>
                                    <p><strong><?php echo $product_array["autor"];?></strong></p>
                                </li>
                                <li>
                                    <p>Release</p>
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <p><strong><?php ?></strong></p>
                                </li>
                                <li>
                                    <p>Publisher</p>
                                    <i class="fa-solid fa-building"></i>
                                    <p><strong><?php echo $product_array["editora"];?></strong></p>
                                </li>
                                <li>
                                    <p>Language</p>
                                    <i class="fa-solid fa-globe"></i>
                                    <p><strong><?php echo $product_array["idioma"];?></strong></p>
                                </li>
                                <li>
                                    <p>Pagecount</p>
                                    <i class="fa-solid fa-book"></i>
                                    <p><strong><?php echo $product_array["paginas"];?></strong></p>
                                </li>
                                <li>
                                    <p>Country</p>
                                    <i class="fa-solid fa-flag"></i>
                                    <p>England?></p>
                                </li>
                                <li>
                                    <p>Genre</p>
                                    <i class="fa-solid fa-dragon"></i>
                                    <p>Fantasy, Literary nonsense</p>
                                </li>
                            </ul>
                        </article>
                    </span>
                </section>
                <section id="comments">
                    <section id="your-comment">
                        <p>Leave your thougths about here! as: <strong>Luiz</strong></p>
                        <form action="">
                            <input id="y-review"type="text" placeholder="Write what you thought about this book">

                            <input id="s-review"type="submit">
                        </form>
                    </section>
                    <h1>Other comments about</h1>
                    <article>
                        <div>
                            <!-- <img src="../assets/user.png" alt=""> -->
                            <span class="stars r-5-0"></span>
                            <p class="comment-user-name">Por: <strong>Yasmin</strong></p>
                            <p class="comment-date">12/06/2021 14:55</p>
                        </div>
                        <div>
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, asperiores nemo. Tempora error delectus unde, ipsam facere laboriosam, eligendi, natus officia harum ad exercitationem quibusdam temporibus!</p>

                        </div>
                    </article>
                    <article>
                        <div>
                            <!-- <img src="../assets/user.png" alt=""> -->
                            <span class="stars r-4-0"></span>
                            <p class="comment-user-name">Por: <strong>Yasmin</strong></p>
                            <p class="comment-date">12/06/2021 14:55</p>
                        </div>
                        <div>
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, asperiores nemo. Tempora error delectus unde, ipsam facere laboriosam, eligendi, natus officia harum ad exercitationem quibusdam temporibus!</p>
                        </div>
                    </article>
                    <article>
                        <div>
                            <!-- <img src="../assets/user.png" alt=""> -->
                            <span class="stars r-4-5"></span>
                            <p class="comment-user-name">Por: <strong>Yasmin</strong></p>
                            <p class="comment-date">12/06/2021 14:55</p>
                        </div>
                        <div>
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, asperiores nemo. Tempora error delectus unde, ipsam facere laboriosam, eligendi, natus officia harum ad exercitationem quibusdam temporibus!</p>
                        </div>
                </section>
                <hr>
                <section id="adds-bottom">
                    <h1>You might like these</h1>
                    <?php 
                        $loops = count($all_products) > 3 ? 3 : count($all_products) - 1;
                
                        for($i = 0; $i <= $loops; $i++){
                    ?>
					<article>
                    	<img src="../<?php echo $all_products[$i]["img_path"]?>" alt="book photo">
                    		<div class="stars r-5-0"></div>
                    		<div>
                        		<a href="./shop.php?number=<?php echo $all_products[$i]["id"]?>"><?php echo $all_products[$i]["nome"]?></a>
                        		<!-- p class="sub-description">
								<?php //echo $all_products[$i]["descri"]?>
								</p-->
                        		<p class="price">R$<?php echo $all_products[$i]["valor"]?></p>
                    		</div>
               		</article>
                    <?php
                		}
                	?>
                	<!--<article>
                        <img src="../assets/img/panslab.jpg" alt="">
                        <div class="stars r-5-0"></div>
                        <div>
                            <a href="#">Pan's Labirinth</a>
                            <!-- <p class="sub-description">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nulla minima enim officia, inventore laudantium magnam quisquam
                                a eaque, eum officiis provident saepe facere,
                                totam accusantium odit? Ipsum quod mollitia quos.</p>--
                            <p class="price">R$12.99</p>
                        </div>
        
                    </article>
                    <article>
                        <img src="../assets/img/panslab.jpg" alt="">
                        <div class="stars r-5-0"></div>
                        <div>
                            <a href="#">Pan's Labirinth</a>
                            <!-- <p class="sub-description">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nulla minima enim officia, inventore laudantium magnam quisquam
                                a eaque, eum officiis provident saepe facere,
                                totam accusantium odit? Ipsum quod mollitia quos.</p> --
                            <p class="price">R$12.99</p>
                        </div>
        
                    </article>
                    <article>
                        <img src="../assets/img/panslab.jpg" alt="">
                        <div class="stars r-5-0"></div>
                        <div>
                            <a href="#">Pan's Labirinth</a>
                            <!-- <p class="sub-description">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Nulla minima enim officia, inventore laudantium magnam quisquam
                                a eaque, eum officiis provident saepe facere,
                                totam accusantium odit? Ipsum quod mollitia quos.</p> --
                            <p class="price">R$12.99</p>
                        </div>
        
                    </article>
        
                    </article>-->
                </section>
                
            </div>
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
    <script type="text/javascript" src="main.js"></script>
    <script type="module" src="setRelated.js"></script>
  </body>
</html>
