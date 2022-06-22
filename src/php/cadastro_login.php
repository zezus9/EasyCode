<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['matricula'])) {
		header('Location: perfil.php');
    }

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<title>Entrar ou cadastrar</title>
	<!-- FAVICON -->
	<link rel='icon' type='imagem/png' href='../assets/img/logoEASYCODE.png'>

	<!-- CSS -->
	<link rel="stylesheet" href="../assets/css/main.css" />
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/inputs.css">
	<link rel="stylesheet" href="../assets/css/pageEntCad.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body class="is-preload">	
	<!-- ?Wrapper -->
	<div id="wrapper">
		<div id="head" class="fixed-top nonSelect">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container">
					<a class="navbar-brand Lovelofont" href="../index.php"><img width="35" src="../assets/img/logoEASYCODE.png"
							alt="Logo EC">
						EASYCODE</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
						aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav Josefinfont d-flex justify-content-center align-items-center p-1">
							<li class="nav-item">
								<a class="nav-link" href="../index.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="pagecursos.php">Cursos</a>
							</li>
							<li id="select" class="nav-item">
								<a class="nav-link" href="cadastro_login.php">Inscreva-se / Entrar</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="sobrenos.php">Sobre nós</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<!-- ?Header -->
		<header id="header">
			<div class="logo d-flex justify-content-center align-items-center">
				<span class="d-flex justify-content-center align-items-center nonSelect">
					<img src="../assets/img/logoMascoteSemFundo.png" alt="logo" width="75%">
				</span>
			</div>
			<div class="content">
				<div class="inner">
					<h1 class="text-color">Seja um desenvolvedor</h1>
					<p class="secundary">entre para esse novo mundo</p>
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="#entrar" class="secundary hover nonSelect">Entre na sua conta</a></li>
					<li><a href="#cadastrar" class="secundary hover nonSelect">Crie uma nova conta</a></li>
				</ul>
		</header>

		<!-- ?Main -->
		<div id="main" class="nonSelect">

			<!-- !Entrar -->
			<article id="entrar">
				<div>
					<!-- !logos -->
					<figure id="logo" class="m-1">
						<img src="../assets/img/logoEASYCODE.png" alt="Logo principal" width="10%" class="ms-5">
						<img src="../assets/img/EasyCode.png" alt="EasyCode" width="30%">
					</figure>
					<!-- !formulario -->
					<div class="h-100 m-2 mt-0">
						<form action="Auxiliares/login.php" method="post" class="formulario flex flex--coluna p-2">
							<h1 class="text-center Black">Entrar</h1>
							<!-- *email e matricula -->
							<div class="d-flex">
								<div class="form-group mb-4 w-100">
									<div class="input-container">
										<input id="emailMatricula" class="input" name="emailMatricula" placeholder="#" type="text" required
										data-tipo="emailMatricula">
										<label class="input-label-lg" for="emailMatricula">E-mail ou Matricula:</label>
										<span class="input-mensagem-erro">Este campo não está valido</span>
									</div>
								</div>
							</div>
							<!-- *senha -->
							<div>
								<div class="input-container">
									<input id="senhaEnt" class="input" name="senha" type="password" placeholder="#" required data-tipo="senhaEnt"
									pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ !@#$%^&*_=+-]).{6,12}$">
									<label class="input-label-lg label" for="senha">Senha:</label>
									<span class="input-mensagem-erro">Este campo não está valido</span>
								</div>
							</div>
							<!-- *esqueci a senha e lembrar-me -->
							<div class="d-flex">
								<!-- ?esqueci a senha -->
								<div class="w-50">
									<p><a href="resgSenha.php" class="nonTitle">Esqueci a senha</a></p>
								</div>
								<!-- ?lembre-me -->
								<!-- <div class="w-50 text-right">
									<label for="lembreme" class="nonTitle">Lembre-me</label>
									<input type="checkbox" id="lembreme">
								</div> -->
							</div>
							<!-- *botão para entrar -->
							<div class="d-flex justify-content-center">
								<input type="submit" value="ENTRAR" class="btn btn-outline-secondary bg-color text-light">
							</div>
							<br>
							<!-- *mudar para o formulário de cadastro -->
							<div class="text-center">
								<h5 class="Black">Não tem cadastro? <a href="#cadastrar" class="nonTitle">Cadastre-se aqui</a></h5>
							</div>
						</form>
					</div>
				</div>
			</article>

			<!-- !Cadastrar -->
			<article id="cadastrar">
				<div class="h-75">
                    <!-- !logos -->
                    <figure id="logo" class="m-1">
                        <img src="../assets/img/logoEASYCODE.png" alt="Logo principal" width="10%" class="ms-5">
                        <img src="../assets/img/EasyCode.png" alt="EasyCode" width="30%">
                    </figure>
                    <!-- !formulario -->
                    <div class="h-100 m-3 mt-0">
                        <form action="Auxiliares/cadastro.php" method="post" class="formulario flex flex--coluna p-2">
                            <h1 class="text-center Black">Cadastrar</h1>
                            <br>
							<!-- ?nome completo -->
							<div class="input-container mb-4 mx-2">
								<input id="nome" class="input" placeholder="#" type="text" required
								data-tipo="nome" name="nome">
								<label class="input-label-lg" for="nome">Nome Completo:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
							<!-- ?CPF -->
							<div class="input-container mb-4 mx-2">
								<input id="cpf" class="input" placeholder="#" type="text" required
								data-tipo="cpf" name="cpf">
								<label class="input-label-lg" for="cpf">CPF:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
							<!-- ?celular -->
							<div class="input-container mb-4 mx-2">
								<input id="celular" class="input" placeholder="#" type="text" required
								data-tipo="celular" name="celular">
								<label class="input-label-lg" for="celular">Celular:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
							<!-- ?email -->
							<div class="input-container mb-4 mx-2">
								<input id="email" class="input" placeholder="#" type="email" required
								data-tipo="email" name="email">
								<label class="input-label-lg" for="email">E-mail:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
							<!-- ?data de nascimento -->
							<div class="input-container mb-4 mx-2">
								<input id="nascimento" class="input" placeholder="#" type="text" required
								data-tipo="dataNascimento" name="nascimento" minlength="10">
								<label class="input-label-lg" for="nascimento">Data de nascimento:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
							<!-- ?senha -->
							<div class="input-container mb-4 mx-2">
								<input id="senhaCad" class="input" type="password" placeholder="#" required data-tipo="senhaCad"  name="senha"
								pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?!.*[ \\\/!@#$%^&*_=+-]).{6,12}$">
								<label class="input-label-lg" for="senha">Senha:</label>
								<span class="input-mensagem-erro">Este campo não está valido</span>
							</div>
                            <!-- *botão de cadastrar -->
                            <div class="d-flex justify-content-center">
                                <input type="submit" value="CADASTRAR" class="btn btn-outline-secondary bg-color text-light">
                            </div>
                            <br>
                            <!-- *mudar para formulario de login -->
                            <div class="text-center">
                                <h5 class="Black">Já está cadastrado? <a href="#entrar" class="nonTitle">Entre por aqui</a></h5>
                            </div>
                        </form>
                    </div>
                </div>
			</article>
		</div>

		<!-- ?Footer -->
		<footer id="footer">
			<p class="copyright">&copy; easy code</p>
		</footer>

	</div>

	<!-- ?BG -->
	<div id="bg"></div>

	<!-- ?Scripts -->
    <script src="../assets/js/app.js" type="module"></script>
	<script src="../assets/js/libs/jquery.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/libs/browser.min.js"></script>
	<script src="../assets/js/libs/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="../assets/js/main.js"></script>
	<script src="../assets/js/libs/jquery.js"></script>
    <script src="../assets/js/libs/jquery.mask.js"></script>
    <script src="../assets/js/mascara.js"></script>
	<script src="../assets/js/nav.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/"
        crossorigin="anonymous"></script>
</body>
</html>