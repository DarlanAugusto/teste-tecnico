<?php include(__DIR__ . '/../layouts/header.php'); ?>

<div class="card">
    <div class="card-header d-flex align-items-center gap-2 justify-content-between">
        <p class="card-title m-0"><?= isset($cliente) ? 'Editando: ' . $cliente->cli_nome_fantasia : 'Novo Cliente'; ?></p>
        <?php if(isset($cliente)): ?>
            <form action="/cliente/destroy/<?= $cliente->idclientes ?>" method="POST" id="formDestroy">
                <button class="btn btn-danger btn-sm" type="button" onclick="destroy()">Excluir</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <?php if(isset($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $msg; ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form id="form_cadastro" action="<?= isset($cliente) ? '/cliente/update/' . $cliente->idclientes : '/cliente/store' ?>" method="POST">
            <div class="mb-3 row">
                <div class="col-2">
                    <label for="idclientes" class="form-label">Código <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="idclientes" readonly disabled value="<?= $cliente->idclientes ?>">
                </div>
                <div class="col-5">
                    <label class="form-label" for="cli_razao_social">Razão Social <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cli_razao_social" name="cli_razao_social" onkeyup="$(this).removeClass('is-invalid')" value="<?= $cliente->cli_razao_social ?>">
                    <div id="error_cli_razao_social" class="invalid-feedback"></div>
                </div>
                <div class="col-5">
                    <label class="form-label" for="cli_nome_fantasia">Nome Fantasia <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cli_nome_fantasia" name="cli_nome_fantasia" onkeyup="$(this).removeClass('is-invalid')" value="<?= $cliente->cli_nome_fantasia ?>">    
                    <div id="error_cli_nome_fantasia" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-3">
                    <label for="cli_documento" class="form-label">Documento <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cli_documento" name="cli_documento" onkeyup="$(this).removeClass('is-invalid')" value="<?= $cliente->cli_documento ?>">
                    <div id="error_cli_documento" class="invalid-feedback"></div>
                </div>
                <div class="col">
                    <label for="cli_endereco" class="form-label">Endereço <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cli_endereco" name="cli_endereco" onkeyup="$(this).removeClass('is-invalid')" value="<?= $cliente->cli_endereco ?>">
                    <div id="error_cli_endereco" class="invalid-feedback"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col text-end">
                <?php if(isset($cliente)): ?>
                    <button class="btn btn-warning btn-small" type="button" onclick="submitForm()">Salvar Alterações</button>
                <?php else: ?>
                    <button class="btn btn-primary btn-small" type="button" onclick="submitForm()">Cadastrar</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#prod_preco_venda").mask("000.000.000,00", { reverse: true });
        $("#prod_peso_bruto").mask("0000,000", { reverse: true });
        $("#prod_peso_liquido").mask("0000,000", { reverse: true });
    });


    function submitForm() {
        let erros = false;
        if(!$("#cli_nome_fantasia").val().length) {
            erros = true;
            errorInput('cli_nome_fantasia');
        }
        if(!$("#cli_razao_social").val().length) {
            erros = true;
            errorInput('cli_razao_social');
        }
        if(!$("#cli_documento").val().length) {
            erros = true;
            errorInput('cli_documento');
        }
        if(!$("#cli_endereco").val().length) {
            erros = true;
            errorInput('cli_endereco');
        }

        if(erros) {
            return;
        }
    
        return $("#form_cadastro").submit();

    }

    function errorInput(InputId, errorMessage = 'Campo obrigatório') {
        $("#" + InputId).addClass('is-invalid');
        $("#error_" + InputId).text(errorMessage);
    }

    function destroy() {
        if(!confirm("Deseja realmente excluir este registro?")) {
            return;
        }

        return $("#formDestroy").submit();
    }
</script>

<?php include(__DIR__ . '/../layouts/footer.php'); ?>