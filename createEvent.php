<?php

ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $description = $_POST['description'];
  $rules = $_POST['rules'];
  $award = $_POST['award'];

  // Gambiarra ate finalizar a sessão
  $_SESSION['id'] = 1;

  if (strlen($name) <= 0) {
    header("Location: createEvent.php?error=Favor preencher o nome!");

    return;
  }

  if (strlen($description) <= 0) {
    header("Location: createEvent.php?error=Favor preencher a descrição!");
    return;
  }

  if (strlen($rules) <= 0) {
    header("Location: createEvent.php?error=Favor preencher as regras!");
    return;
  }

  if (strlen($award) <= 0) {
    header("Location: createEvent.php?error=Favor preencher a premiação!");
    return;
  }

  try {
    $imgPath = $_FILES['img']['tmp_name'];
    $imgData = file_get_contents($imgPath);
    $base64Img = base64_encode($imgData);

    $shortImgPath = $_FILES['short-img']['tmp_name'];
    $shortImgData = file_get_contents($shortImgPath);
    $base64ShortImg = base64_encode($shortImgData);


    require_once 'connect.php';

    $sql = "INSERT INTO `tournament` (`name`, `description`, `image`, `short_image`, `rules`, `award`, `create_by`) 
                            VALUES (:name,  :description,  :image,  :short_image,  :rules,  :award,  :create_by)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $base64Img);
    $stmt->bindParam(':short_image', $base64ShortImg);
    $stmt->bindParam(':rules', $rules);
    $stmt->bindParam(':award', $award);
    $stmt->bindParam(':create_by', $_SESSION['id']);

    $stmt->execute();


    header("Location: createEvent.php?success=true");
  } catch (\Throwable $th) {
    header("Location: createEvent.php?error=Falha ao criar torneio");
  }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fiap Arena</title>

  <link rel="icon" href="./src/img/MiniLogo.png" />

  <!-- Link com o RESET -->
  <link rel="stylesheet" href="./src/css/reset.css" />
  <!-- Link com o ESTILO DO HEADER -->
  <link rel="stylesheet" href="./src/css/header.css" />
  <!-- Link com o ESTILO DO CONTEÚDO  -->
  <link rel="stylesheet" href="./src/css/createEvent.css" />
  <!-- Link com o ESTILO DO FOOTER -->
  <link rel="stylesheet" href="./src/css/footer.css" />

  <!-- BIBLIOTECA DE EDIÇÃO DOS PARAGRAFOS  -->
  <link
    href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css"
    rel="stylesheet" />

  <!-- Link com Font Awesome -->
  <script
    src="https://kit.fontawesome.com/92f82bc9ac.js"
    crossorigin="anonymous"></script>

  <!-- FONTES -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Bungee&display=swap"
    rel="stylesheet" />
</head>

<body>
  <!-- AQUI COMEÇA O HEADER -->
  <header>
    <nav class="nav-bar">
      <div class="logo">
        <a href="home.html"><img src="src/img/Logo.png" alt="Logo escrito Fiap Arena" /></a>
      </div>

      <div class="nav-list">
        <ul>
          <li class="nav-item">
            <a class="nav-link" href="./home.html">Página Inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./createEvent.html">Criar Torneio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./ranking.html">Classificação</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Suporte</a>
          </li>
        </ul>
      </div>

      <div class="container">
        <div class="text">
          <a class="text-link" href="#">Pedro Gonçaves</a>
          <a class="text-link" href="#">pedro@gmail.com</a>
        </div>

        <div>
          <a href="./profile.html" id="perfil-icon">
            <img
              class="profile-img"
              src="src/img/profileImage.svg"
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
        <li><a href="home.html">Página Inicial</a></li>
        <li><a class="active" href="createEvent.html">Criar Torneio </a></li>
        <li><a href="ranking.html">Classificação</a></li>
        <li><a href="#">Suporte</a></li>
      </ul>
    </nav>
  </header>
  <!-- AQUI TERMINA O HEADER -->

  <section class="main">
    <div>
      <h1 class="main-title">NOVO TORNEIO</h1>
    </div>
    <form class="tournament" enctype="multipart/form-data" id="tournament" method="POST">
      <div>
        <label for="tournament-name">Nome do torneio</label>
        <input
          class="input"
          placeholder="Nome do torneio"
          id="tournament-name"
          name="name"
          type="text" />
        <span class="error" hidden>Favor Preencher o campo</span>
      </div>
      <div>
        <label for="tournament-text">Breve descrição</label>
        <textarea
          class="input"
          placeholder="A descrição é..."
          id="tournament-description"
          name="description"
          rows="4"></textarea>
        <span class="" hidden>Favor Preencher o campo</span>
      </div>
      <div>
        <label for="tournament-text">Imagem</label>
        <input
          class="input"
          id="tournament-img"
          name="img"
          accept="image/*"
          type="file" />
        <span class="" hidden>Favor Preencher o campo</span>
      </div>
      <div>
        <label for="tournament-text">Imagem</label>
        <input
          class="input"
          id="tournament-img"
          name="short-img"
          accept="image/*"
          type="file" />
        <span class="" hidden>Favor Preencher o campo</span>
      </div>
      <div>
        <label for="tournament-rules">Regras</label>
        <div class="input" id="tournament-rules" type="text"></div>
        <erspanror class="" hidden>Favor Preencher o campo</erspanror>
      </div>
      <div>
        <label for="tournament-award">Premiação</label>
        <div class="input" id="tournament-award" type="text"></div>
        <span class="" hidden>Favor Preencher o campo</span>
      </div>

      <div class="btn-div">
        <button class="btn btn-cancelar">Cancelar</button>
        <button class="btn btn-salvar">Salvar</button>
      </div>
    </form>

    <!-- <div id="editor"></div> -->
  </section>

  <!-- AQUI COMECA O FOOTER -->
  <footer>
    <div class="conteudo-footer">
      <div class="midias">
        <a href="home.html"><img src="src/img/Logo.png" alt="Logo escrito Fiap Arena" /></a>
        <div class="icones-midia">
          <a href="#" id="twitter">
            <i class="fa-brands fa-x-twitter"></i>
          </a>

          <a href="#" id="instagram">
            <i class="fa-brands fa-instagram"></i>
          </a>

          <a href="#" id="youtube">
            <i class="fa-brands fa-youtube"></i>
          </a>

          <a href="#" id="linkedin">
            <i class="fa-brands fa-linkedin"></i>
          </a>
        </div>
      </div>

      <ul class="footer-list">
        <li>
          <h3>Use Cases</h3>
        </li>

        <li><a href="#" class="footer-link">UI Design</a></li>
        <li><a href="#" class="footer-link">UX Design</a></li>
        <li><a href="#" class="footer-link">Wireframing</a></li>
        <li><a href="#" class="footer-link">Diagramming</a></li>
        <li><a href="#" class="footer-link">Brainstorming</a></li>
        <li><a href="#" class="footer-link">Online Whiteboard</a></li>
        <li><a href="#" class="footer-link">Team Collaboaton</a></li>
      </ul>

      <ul class="footer-list">
        <li>
          <h3>Explore</h3>
        </li>

        <li><a href="#" class="footer-link">Design</a></li>
        <li><a href="#" class="footer-link">Prototyping</a></li>
        <li><a href="#" class="footer-link">Development Features</a></li>
        <li><a href="#" class="footer-link">Design Systems</a></li>
        <li><a href="#" class="footer-link">Collaboaton Features</a></li>
        <li><a href="#" class="footer-link">Design Process</a></li>
        <li><a href="#" class="footer-link">FigJam</a></li>
      </ul>

      <ul class="footer-list">
        <li>
          <h3>Resources</h3>
        </li>

        <li><a href="#" class="footer-link">Blog</a></li>
        <li><a href="#" class="footer-link">Best Practices</a></li>
        <li><a href="#" class="footer-link">Colors</a></li>
        <li><a href="#" class="footer-link">Color Wheel</a></li>
        <li><a href="#" class="footer-link">Suport</a></li>
        <li><a href="#" class="footer-link">Developers</a></li>
        <li><a href="#" class="footer-link">Resource Library</a></li>
      </ul>
    </div>
  </footer>
  <!-- AQUI TTERMINA O FOOTER -->

  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="src/js/createEvent.js"></script>
</body>

</html>