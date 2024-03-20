<header class="p-3 border-bottom shadow-sm">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-5">
                <h4>Soft-Line</h4>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 link-secondary">Início</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link link-body-emphasis" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Produtos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/produtos">Lista de Produtos</a></li>
                        <li><a class="dropdown-item" href="/produto/create">Cadastro de Produtos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link link-body-emphasis" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/clientes">Lista de Clientes</a></li>
                        <li><a class="dropdown-item" href="/cliente/create">Cadastro de Clientes</a></li>
                    </ul>
                </li>
            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= \App\Controllers\AuthController::getUser()->user_nome ?>
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item text-danger" href="/auth/logout">Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>