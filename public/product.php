<!DOCTYPE html>
<html lang="pt-br">
        <head>
                <meta charset="UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />
                <title>Desembarki Webgráfica</title>

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
                                                                <a class="fs-5 nav-link" id="navbarLandings" href="quem-somos.php"aria-haspopup="true" aria-expanded="false">Quem somos</a>
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
            <div class="row justify-content-center">
                <div class="col-lg">
                    <div class="product-container">
                        <div class="row">
                            <!-- Product Image -->
                            <div class="col-md-6">
                                <img src="../assets/img/produto.png" 
                                     class="img-fluid product-image" alt="Product Image">
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-md-6 d-flex flex-column">
                                <div class="ms-5 mt-3">
                                    <h2 class="mb-4">Produto Exemplo</h2>
                                    
                                    <!-- Tabs Navigation -->
                                    <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                                                                <li class="nav-item" role="presentation">
                                                                <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Descrição</button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="fit-tab" data-bs-toggle="tab" data-bs-target="#fit" type="button" role="tab">Tamanho</button>
                                                                </li>
                                                                <li class="nav-item" role="presentation">
                                                                <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care" type="button" role="tab">Care</button>
                                                                </li>
                                                        </ul>
                                    
                                    <!-- Tab Content Container -->
                                    <div class="tab-content-container">
                                        <div class="tab-content" id="productTabsContent">
                                            <!-- Overview Tab -->
                                            <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                                <p>
                                                    First introduced in our permanent collection in 2016, this is our fifth version update: At its core is a custom developed soft and substantial, breathable organic cotton knit. Our straight cut silhouette is embellished with a perfectly balanced collar and a seamless French placket with our signature, tonal mother of pearl buttons. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor impedit dolorem dignissimos harum esse nemo! Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                </p>
                                            </div>
                                            
                                            <!-- Fit Tab -->
                                            <div class="tab-pane fade" id="fit" role="tabpanel">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Size</th>
                                                                <th>Chest (in)</th>
                                                                <th>Length (in)</th>
                                                                <th>Sleeve (in)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>S</td>
                                                                <td>38-40</td>
                                                                <td>27</td>
                                                                <td>8.5</td>
                                                            </tr>
                                                            <tr>
                                                                <td>M</td>
                                                                <td>40-42</td>
                                                                <td>28</td>
                                                                <td>9</td>
                                                            </tr>
                                                            <tr>
                                                                <td>L</td>
                                                                <td>42-44</td>
                                                                <td>29</td>
                                                                <td>9.5</td>
                                                            </tr>
                                                            <tr>
                                                                <td>XL</td>
                                                                <td>44-46</td>
                                                                <td>30</td>
                                                                <td>10</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            <!-- Care Tab -->
                                            <div class="tab-pane fade" id="care" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Washing</h5>
                                                                <ul>
                                                                    <li>Machine wash cold (30°C max)</li>
                                                                    <li>Gentle cycle</li>
                                                                    <li>Use mild detergent</li>
                                                                    <li>Do not bleach</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title">Drying & Ironing</h5>
                                                                <ul>
                                                                    <li>Lay flat to dry</li>
                                                                    <li>Do not tumble dry</li>
                                                                    <li>Iron on low heat (max 110°C)</li>
                                                                    <li>Do not dry clean</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Fixed Bottom Section (Button stays here) -->
                                <div class="fixed-bottom-section mt-auto ms-5 mb-4">
                                    <div class="row">
                                        <!-- Size Options -->
                                        <div class="col-md-6 mb-4">
                                            <h5 class="mb-3">Length</h5>
                                            <div class="btn-group d-flex" role="group">
                                                <button type="button" class="btn btn-outline-dark btn-size">XS</button>
                                                <button type="button" class="btn btn-outline-dark btn-size">S</button>
                                                <button type="button" class="btn btn-dark btn-size active">M</button>
                                                <button type="button" class="btn btn-outline-dark btn-size">L</button>
                                                <button type="button" class="btn btn-outline-dark btn-size">XL</button>
                                            </div>
                                        </div>
                                        
                                        <!-- Length Options -->
                                        <div class="col-md-6 mb-4">
                                            <h5 class="mb-3">Length</h5>
                                            <div class="btn-group d-flex" role="group">
                                                <button type="button" class="btn btn-outline-dark flex-grow-1">Regular</button>
                                                <button type="button" class="btn btn-dark flex-grow-1 active">Long</button>
                                            </div>
                                        </div>
                                        
                                        <!-- Add to Cart Button -->
                                        <div class="col-12 mb-4">
                                            <button class="btn btn-dark btn-lg w-100 py-3 btn-cart">
                                                ADD TO CART
                                            </button>
                                        </div>
                                        
                                        <!-- Delivery Info -->
                                        <div class="col-12">
                                            <div class="text-center border-top pt-3 delivery-info">
                                                <p class="mb-0">
                                                    <i class="bi bi-truck me-2"></i>Delivery in 4-6 days | 
                                                    <i class="bi bi-currency-euro me-2"></i>Free from 100 EUR | 
                                                    <i class="bi bi-arrow-repeat me-2"></i>Free returns & exchanges
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <p>© 2025 Desembarki. Todos os direitos reservados.</p>
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