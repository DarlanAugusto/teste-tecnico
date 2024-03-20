<?php include(__DIR__ . '/../layouts/header.php'); ?>

<div class="card flex-grow-1">
    <div class="card-header d-flex align-items-center gap-2 justify-content-between">
        <p class="card-title m-0">Lista de Clientes</p>
        <a href="/cliente/create" class="btn btn-primary btn-sm">Cadastrar</a>
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
                    <th scope="col">Razão Social</th>
                    <th scope="col">Nome Fantasia</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Endereço</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $cliente): ?>
                    <tr>
                        <th scope="row"><?= $cliente->idclientes ?></th>
                        <td><?= $cliente->cli_razao_social ?></td>
                        <td><?= $cliente->cli_nome_fantasia ?></td>
                        <td><?= $cliente->cli_documento ?></td>
                        <td><?= $cliente->cli_endereco ?></td>
                        <td class="text-end"><a role="button" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalShow" onclick="show(<?= $cliente->idclientes ?>)">Ver</a></td>
                        <td class="text-end"><a href="/cliente/edit/<?= $cliente->idclientes ?>" class="text-decoration-none link-secondary">Editar</a></td>
                        <td class="text-end">
                            <a role="button" class="text-decoration-none link-danger" onclick="destroy(<?= $cliente->idclientes ?>)">Excluir</a>
                            <form action="/cliente/destroy/<?= $cliente->idclientes ?>" method="POST" id="formDestroy<?= $cliente->idclientes ?>"></form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modalShow" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
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
        if(!confirm("Deseja reamente excluir o cliente de ID " + id + " ?")) {
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

        $.get("/api/v1/cliente/show/" + id, 
            function (data) {
                
                $("#modalShowLabel").html(data.cli_nome_fantasia)
                $("#modalShowContent").html(`
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <td class="text-end fw-bold">Razão Social: </td>
                                <td>${data.cli_razao_social}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Nome Fantasia: </td>
                                <td>${data.cli_nome_fantasia}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Documento: </td>
                                <td>${data.cli_documento}</td>
                            </tr>
                            <tr>
                                <td class="text-end fw-bold">Endereço: </td>
                                <td>${data.cli_endereco}</td>
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