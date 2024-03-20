<?php include(__DIR__ . '/layouts/header.php'); ?>

<div class="card flex-grow-1">
    <div class="card-header"><div class="card-title">Dashboard</div></div>
    <div class="card-body">
        <?php if(isset($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $msg ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="row">
            <a href="/clientes" class="col text-decoration-none">
                <div class="card bg-info-subtle">
                    <div class="card-body">Cadastro de Clientes</div>
                </div>
            </a>
            <a href="/produtos" class="col text-decoration-none">
                <div class="card bg-info-subtle">
                    <div class="card-body">Cadastro de Produtos</div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/layouts/footer.php'); ?>