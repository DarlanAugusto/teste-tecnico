<?php include(__DIR__ . '/../layouts/header.php'); ?>

<div class="card flex-grow-1">
    <div class="card-header d-flex align-items-center gap-2 justify-content-between">
        <p class="card-title m-0">Lista de Produtos</p>
        <a href="/produto/create" class="btn btn-primary btn-sm">Cadastrar</a>
    </div>
    <div class="card-body">
        <?php if(isset($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $msg; ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <table class="table table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Cód. de Barras</th>
                    <th scope="col" class="text-end">Valor R$</th>
                    <th scope="col" class="text-end">Peso Bruto</th>
                    <th scope="col" class="text-end">Peso Liq.</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $produto): ?>
                    <tr>
                        <th scope="row"><?= $produto->idprodutos ?></th>
                        <td><?= $produto->prod_descricao ?></td>
                        <td><?= $produto->prod_cod_barras ?></td>
                        <td align="right">
                            <?= number_format($produto->prod_preco_venda, 2, ',', '.') ?>
                        </td>
                        <td align="right"><?= number_format($produto->prod_peso_bruto, 3, ',') ?></td>
                        <td align="right"><?= number_format($produto->prod_peso_liquido, 3, ',') ?></td>
                        <td class="text-end"><a role="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="show(<?= $produto->idprodutos ?>)">Ver</a></td>
                        <td class="text-end"><a href="/produto/edit/<?= $produto->idprodutos ?>" class="text-decoration-none link-secondary">Editar</a></td>
                        <td class="text-end">
                            <a role="button" class="text-decoration-none link-danger" onclick="destroy(<?= $produto->idprodutos ?>)">Excluir</a>
                            <form action="/produto/destroy/<?= $produto->idprodutos ?>" method="POST" id="formDestroy<?= $produto->idprodutos ?>"></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalShowLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalShowContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function destroy(id) {
        if(!confirm("Deseja reamente excluir o produto de ID " + id + " ?")) {
            return;
        }

        return $("#formDestroy" + id).submit();
    }

    function show(id) {
        $("#modalShowLabel").html(`
            <div class="clearfix">
                <div class="spinner-border float-end" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </div>
        `);  

        $("#modalShowContent").empty();

        $.get("/api/v1/produto/show/" + id, 
            function (data) {
                
                $("#modalShowLabel").html(data.prod_descricao)
                $("#modalShowContent").html(`
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="text-end fw-bold">Cód. Barras: </td>
                                <td>${data.prod_cod_barras}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Descrição: </td>
                                <td>${data.prod_descricao}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Preço: </td>
                                <td>R$ ${data.prod_preco_venda}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Peso Bruto: </td>
                                <td>${data.prod_peso_bruto} KG</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Peso Liq.: </td>
                                <td>${data.prod_peso_liquido} KG</td>
                            </tr>
                        </tbody>
                    </table>
                `);
            },
            "json"
        ).fail((error) => {

            alert("Erro inesperado: " + error.responseText);
            console.error(error);
        });
    }
</script>

<?php include(__DIR__ . '/../layouts/footer.php'); ?>