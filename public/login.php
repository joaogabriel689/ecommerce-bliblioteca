<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../images/logo-image.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="">
	<title>Couto's</title>
</head>
<style>
	@import url('https://fonts.googleapis.com/css2?family=Hind:wght@300;700&family=Kalam&family=Roboto&display=swap');
	@import url('https://fonts.googleapis.com/css2?family=Updock&display=swap');
	:root{

	    /*Color Theme Swatches in Hex */
	    --color1: #F2F2F2;
	    --color2: #3D6373;
	    --color3: #88B0BF;
	    --color4: #BF9E60;
	    --color5: #73451D;

	    --text-font: 'Roboto', sans-serif;
	    --logo-font: 'Updock', cursive;
	    --special-font: 'Kalam', cursive;
	    --title-font: 'Hind', sans-serif;
	}

	html{
		padding: 0px;
		margin: 0px;
		background: none;
		background-size: 100%;
		background-image: url("../images/background-image.jpg");
	}

	h1 {
		font-family: var(--special-font);
		text-align: center;
	}
	h1.logo {
		font-family: var(--logo-font);
		text-align: center;
	}

	p {
		font-family: var(--text-font);
	}
	a {
		font-family: var(--text-font);
	}
	hr {
		margin: 0;
	}

	main{
		position: relative;
		height: 96vh;
	}

	main > section{
		background-color: white;

		width: fit-content;
		margin: auto;

		padding: 20px;

		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);


		border-radius: 10px;

		box-shadow: 2px 6px 11px 4px #00000085;
		
	}
	article.login-area {
		margin: 0;
		padding: 10px 10px 0px 10px;

		/*border-bottom: 1px solid black;*/
	}

	article.login-area > h1 {
		font-family: var(--title-font);
		text-align: left;
		color: var(--color3);

		margin: 0;
	}
	section.form-area {
		width: fit-content;
		margin: auto;

		padding: 10px;
	}

	form {
		/*border-top: 1px solid var(--color5);*/
		/*border-bottom: 1px solid var(--color5);*/
	}
	form > div {
		padding: 10px;
	}

	form span.input-span {
		padding: 5px;

		border-bottom: 1px solid var(--color3);
	}

	form input[type="text"], input[type="password"] {
		background: none;
		outline: none;
		border: none;

		font-size: 1.1em;
	}

	section#submit-area div{
		padding: 10px;
		width: fit-content;
		margin: auto;
	}

	input.green-button {
	    display: inline-block;
	    width: fit-content;

	    font-size: 1.1em;
	    text-decoration: none;
	    text-align: center;

	    color: var(--color1);
	    background: linear-gradient(45deg, #37bb37, #1dca1d);

	    border-radius: 10px 0px 0px 10px;
	    outline: none;
	    border: none;

	    /*margin: 5px auto 5px 0px;*/
	    padding: 10px;
	}
	input.green-button:hover {
		transform: scale(1.1);
	}
	.gray-button {
	    display: inline-block;

	    font-size: 1.1em;
	    text-decoration: none;
	    text-align: center;

	    color: var(--color1);
	    /*background: linear-gradient(45deg, #37bb37, #1dca1d);*/
	    background-color: gray;

	    border-radius: 0px 10px 10px 0px;

	    /*margin: 5px auto 5px 0px;*/
	    padding: 10px;
	}
	.gray-button:hover {
		transform: scale(1.1);
	}
</style>
<body>
	<main>
		<section>

			<section>
				<article class="login-area">
					<h1>Log in</h1>
				</article>
				<hr>
				<section class="form-area">
					<form>
						<div class="form-session">
							<!--<label>email</label>-->
							<span class="input-span"> 
								<input type="text" name="" placeholder="Email">
							</span>

							
						</div>
						<div class="form-session">
							<!--<label>senha</label>-->
							<span class="input-span">
								<input type="password" name="" placeholder="Senha">
							</span>
						</div>
						<div class="form-session">
							<section id="submit-area">
								<div>
									<input class="green-button" type="submit" value="Login">
									<a class="gray-button" href="./signup.php">Sign up</a>
								</div>								
							</section>

						</div>
					</form>
					<hr>					
				</section>


			</section>
			<section>
				
			</section>

		</section>
	</main>
</body>
</html>