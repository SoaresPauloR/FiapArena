<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FIAP ARENA HOME</title>
  <link rel="icon" href="/public/src/img/MiniLogo.png" />

  <!-- Link com o RESET -->
  <link rel="stylesheet" href="/public/src/css/reset.css" />
  <!-- Link com o ESTILO DO HEADER -->
  <link rel="stylesheet" href="/public/src/css/header.css" />
  <!-- Link com o ESTILO DO FOOTER -->
  <link rel="stylesheet" href="/public/src/css/footer.css" />

  <!-- Link com Font Awesome -->
  <script
    src="https://kit.fontawesome.com/92f82bc9ac.js"
    crossorigin="anonymous"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Bungee&family=Inter:wght@100..900&display=swap"
    rel="stylesheet" />

  <script src="/public/src/js/header.js"></script>
</head>

<body>
  <header>
    <nav class="nav-bar">
      <div class="logo">
        <a href="/home"><img src="/public/src/img/Logo.png" alt="Logo escrito Fiap Arena" /></a>
      </div>

      <div class="nav-list">
        <ul>
          <li class="nav-item">
            <a class="nav-link <?php echo $uri === 'home' ? 'active' : '' ?>" href="/home">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $uri === 'tournament/new' ? 'active' : '' ?>" href="/tournament/new">Criar Torneio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $uri === 'ranking' ? 'active' : '' ?>" href="/ranking">Classificação</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo $uri === 'suporte' ? 'active' : '' ?>" href="mailto:rm557797@fiap.com.br">Suporte</a>
          </li>
        </ul>
      </div>

      <div class="container">
        <div class="text">
          <a class="text-link" href="/profile"><?php echo $_SESSION['name'] ?></a>
          <a class="text-link" href="/profile"><?php echo $_SESSION['email'] ?></a>
        </div>

        <div>
          <a href="/profile" id="perfil-icon">
            <img
              class="profile-img"
              src="<?php echo isset($_SESSION['photo']) && $_SESSION['photo'] != '' ? 'data:image/jpeg;base64,' . $_SESSION['photo'] : '/public/src/img/profile.jpg' ?>"
              alt="Foto de Perfil" />
          </a>
        </div>
      </div>

      <div class="menu-hamburger" onclick="toggleMenu()">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <ul class="menu">
        <li><a class="active" href="#">Página Inicial</a></li>
        <li><a href="/tournament/new">Criar Torneio </a></li>
        <li><a href="/ranking">Classificação</a></li>
        <li><a href="mailto:rm557797@fiap.com.br">Suporte</a></li>
      </ul>
    </nav>
  </header>