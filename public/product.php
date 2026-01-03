<?php
        require_once '../admin/db.php';
        
        $slug = $_GET['slug'] ?? '';
        
        if ($slug) {
                $stmt = $pdo->prepare("SELECT * FROM produtos WHERE slug = ?");
                $stmt->execute([$slug]);
                $product = $stmt->fetch();

                if ($product) {
                        $stmtImg = $pdo->prepare("SELECT caminho_arquivo FROM produto_imagens WHERE produto_id = ?");
                        $stmtImg->execute([$product['id']]);
                        $imagens = $stmtImg->fetchAll(PDO::FETCH_COLUMN);
                } else {
                        echo "Produto não encontrado.";
                        exit;
                }
        }
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Desembarki Webgráfica</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/product_page.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
        <script src="../assets/js/image-selector.js"></script>

</head>

<body>
        <header>
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container">
                                <a class="navbar-brand p-0" href="home.php">
                                        <img src="../assets/img/logo.png" class="navbar-brand-img" alt="..." height="70">
                                </a>
                                <!-- Updated target to match collapse ID -->
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#navbarCollapse" aria-controls="navbarCollapse"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                </button>
                                <!-- Collapse with matching ID -->
                                <div class="collapse navbar-collapse" id="navbarCollapse">
                                        <ul class="navbar-nav ms-auto">
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="home.php">Home</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" href="#">Produtos</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" id="navbarLandings" href="quem-somos.php" aria-haspopup="true" aria-expanded="false">Quem somos</a>
                                                </li>
                                                <li class="nav-item">
                                                        <a class="fs-5 nav-link" id="navbarLandings"
                                                                href="pagina-contato.php" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                Contato
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
                        </div>
                </nav>
        </header>

        <main>
                <div class="container py-5">
                        <div class="row">
                                <div class="col-lg-6">
                                        <div class="row">
                                                <div class="col-2 d-flex flex-column align-items-center">
                                                        <button class="btn btn-link p-0 mb-2" onclick="scrollThumbs(-1)">
                                                                <i class="bi bi-chevron-up fs-3"></i>
                                                        </button>

                                                        <div id="thumb-container" class="thumb-scroll-viewport">
                                                                <?php foreach ($imagens as $caminho): ?>
                                                                        <img src="../uploads/<?= $caminho ?>" 
                                                                        class="img-fluid thumb-image border" 
                                                                        style="cursor: pointer;" 
                                                                        onclick="changeImage(this.src, this)">
                                                                <?php endforeach; ?>
                                                        </div>

                                                        <button class="btn btn-link p-0 mt-2" onclick="scrollThumbs(1)">
                                                                <i class="bi bi-chevron-down fs-3"></i>
                                                        </button>
                                                </div>
                                                <div class="col-10">
                                                        <img src="../uploads/<?= $imagens[0] ?>" id="main-image" class="img-fluid product-image" alt="Principal">
                                                </div>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <h1 class="mb-3"><?php echo htmlspecialchars($product['nome']); ?></h1>
                                        <hr>
                                        <div class="card" style="height: 350px;">
                                                <div class="card-body">
                                                        <h5 class="card-title">Descrição do Produto: </h5>
                                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,</p>
                                                        <hr>
                                                        <h5 class="card-title">Gramaturas disponiveis:</h5>
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                        <hr>
                                                        <h5 class="card-title">Tabela de Preços:</h5>
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                </div>
                                        </div>
                                        <a class="btn btn-success btn-lg w-100 mt-4"><i class="bi bi-whatsapp me-2"></i>Interessado? Entre em contato! </a>
                                </div>
                        </div>
                        <div class="row">
                                <hr class="mt-5">
                                <h2 class="mt-2 mb-4">Confira outros produtos:</h2>

                                <div class="swiper mySwiper">
                                        <div class="swiper-wrapper">
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                                <div class="col-md-3 mb-4 swiper-slide">
                                                        <a href="#" class="card h-100">
                                                                <img src="../assets/img/produto.png" class="card-img-top" alt="Produto 1">
                                                                <div class="card-body">
                                                                        <h5 class="card-title">Produto 1</h5>
                                                                </div>
                                                        </a>
                                                </div>
                                        </div>
                                        <div class="swiper-pagination"></div>
                                </div>
                                <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
                                <script src="../assets/js/product_carrousel.js"></script>
                        </div>
                </div>
        </main>



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
                                                        <a href="#" class="nav-link p-0 text-muted">Produtos</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Quem Somos</a>
                                                </li>
                                                <li class="nav-item mb-2">
                                                        <a href="#" class="nav-link p-0 text-muted">Contatos</a>
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
                                <p>© <script>
                                                document.write(new Date().getFullYear())
                                        </script> Desembarki. Todos os direitos reservados.</p>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>