<?php
require_once '../admin/db.php';

// Usamos MIN(i.caminho_arquivo) para pegar a primeira imagem encontrada
$sql = "SELECT p.*, MIN(i.caminho_arquivo) AS imagem_principal
        FROM produtos p 
        LEFT JOIN produto_imagens i ON p.id = i.produto_id 
        GROUP BY p.id 
        ORDER BY p.criado_em DESC
        LIMIT 12";

$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Desembarki</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <script src="../assets/js/dark-mode.js"></script>
</head>

<body>
        <header>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container">
                                <a class="navbar-brand p-0" href="#">
                                        <img src="../assets/img/logo.png" class="navbar-brand-img" alt="Logo" height="70" />
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarCollapse">
                                        <ul class="navbar-nav ms-auto">
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="#">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="products_page.php">Produtos</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="quem-somos.php">Quem somos</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="pagina-contato.php">Contato</a>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </nav>
        </header>

        <main>
                <div id="carouselExampleSlidesOnly" class="carousel slide remove-on-small" data-bs-ride="carousel">
                        <div class="carousel-inner">
                                <div class="carousel-item active">
                                        <img src="../assets/img/slide1.png" class="d-block w-100" alt="Slide 1" />
                                </div>
                                <div class="carousel-item">
                                        <img src="../assets/img/slide2.png" class="d-block w-100" alt="Slide 2" />
                                </div>
                                <div class="carousel-item">
                                        <img src="../assets/img/slide3.png" class="d-block w-100" alt="Slide 3" />
                                </div>
                        </div>
                </div>

                <!-- Informational Cards -->
                <div class="container">
                        <div class="row my-5">
                                <div class="col-md-4 col-12 mb-4">
                                        <div class="card border-0">
                                                <i class="bi-box-seam ms-3 fs-1"></i>
                                                <div class="card-body">
                                                        <h5 class="card-title">Entrega Rápida</h5>
                                                        <p class="card-text">
                                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, praesentium.
                                                        </p>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                        <div class="card border-0">
                                                <i class="bi-award ms-3 fs-1"></i>
                                                <div class="card-body">
                                                        <h5 class="card-title">Melhor Qualidade no Mercado</h5>
                                                        <p class="card-text">
                                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, praesentium.
                                                        </p>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-4 col-12 mb-4">
                                        <div class="card border-0">
                                                <i class="bi-chat-dots ms-3 fs-1"></i>
                                                <div class="card-body">
                                                        <h5 class="card-title">Atendimento Personalizado</h5>
                                                        <p class="card-text">
                                                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit, praesentium.
                                                        </p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

                <!-- Product Cards -->
                <div class="container mb-5">
                        <h2>Conheça Nossos Produtos</h2>
                        <div class="row remove-on-small">
                                <div class="row row-cols-12">
                                        <div id="carouselProdutos" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                        <?php $chunks = array_chunk($produtos, 4); foreach ($chunks as $index => $bloco): ?>
                                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                <div class="row g-4">
                                                                <?php foreach ($bloco as $p): ?>
                                                                        <div class="col-md-3">
                                                                        <div class="card h-100 shadow-sm">
                                                                                <?php $caminho = !empty($p['imagem_principal']) ? $p['imagem_principal'] : 'assets/img/sem-foto.png'; ?>
                                                                                <img src="<?= $caminho ?>" class="card-img-top" alt="<?= htmlspecialchars($p['nome']) ?>" style="aspect-ratio: 1/1; object-fit: cover;">
                                                                                <div class="card-body text-center">
                                                                                <a href="produto/<?= $p['slug'] ?>" class="stretched-link text-reset">
                                                                                        <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                                                                                        <p class="card-text"><?= htmlspecialchars($p['descricao']) ?></p>
                                                                                </a>
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                </div>
    
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProdutos" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProdutos" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                                                </button>
                                        </div>
                                </div>
                        </div>
                </div>

                <!-- Categories -->
                <div class="container">
                        <h2>Categorias de Produtos</h2>
                        <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                        <a href="#"><img src="../assets/img/categoria1.png" class="category"
                                                        style="border-radius:5px; width: 100%;" alt="Categoria 1" /></a>
                                </div>
                                <div class="col-12 col-md-6">
                                        <a href="#"><img src="../assets/img/categoria2.png" class="category"
                                                        style="border-radius:5px; width: 100%;" alt="Categoria 2" /></a>
                                        <div class="row my-4">
                                                <div class="col-6">
                                                        <a href="#"><img src="../assets/img/categoria3.png" class="category"
                                                                        style="border-radius:5px; width: 100%;"
                                                                        alt="Categoria 3" /></a>
                                                </div>
                                                <div class="col-6">
                                                        <a href="#"><img src="../assets/img/categoria3.png" class="category"
                                                                        style="border-radius:5px; width: 100%;"
                                                                        alt="Categoria 3" /></a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </main>

        <!-- Footer -->
        <div class="container border-top">
                <footer class="pt-5">
                        <div class="row">
                                <div class="col-6 col-md-2 remove-on-small">
                                        <h5>Section</h5>
                                        <ul class="nav flex-column">
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Features</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                                                </li>
                                        </ul>
                                </div>
                                <div class="col-6 col-md-2 remove-on-small">
                                        <h5>Produtos</h5>
                                        <ul class="nav flex-column">
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Features</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                                                </li>
                                        </ul>
                                </div>
                                <div class="col-6 col-md-2 remove-on-small">
                                        <ul class="nav flex-column">
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Home</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Features</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Pricing</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">FAQs</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">About</a>
                                                </li>
                                        </ul>
                                </div>
                                <div class="col">
                                        <div class="card border-0">
                                                <div class="card-body">
                                                        <h5 class="card-title mb-3">Horário de Atendimento</h5>
                                                        <p class="card-text">
                                                                Chat e WhatsApp: Segunda a Sexta das 09:00 às 18:00
                                                                horas
                                                        </p>
                                                        <p class="card-text">
                                                                Televendas: Segunda a Sexta das 08:00 às 19:00 horas
                                                        </p>
                                                        <p class="card-text">Telefone e WhatsApp: (XX) XXXXX-XXXX</p>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row justify-content-between my-4 py-4 border-top">
                                <p>© <script>document.write(new Date().getFullYear())</script> Desembarki. Todos os direitos reservados.</p>
                                <ul class="list-unstyled d-flex">
                                        <li class="ms-3">
                                                <a class="link-dark" href="#"><i class="bi bi-whatsapp"></i></a>
                                        </li>
                                        <li class="ms-3">
                                                <a class="link-dark" href="#"><i class="bi bi-instagram"></i></a>
                                        </li>
                                        <li class="ms-3">
                                                <a class="link-dark" href="#"><i class="bi bi-facebook"></i></a>
                                </ul>
                                </li>
                        </div>
                </footer>
        </div>

        <!-- Bootstrap Bundle JS (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>