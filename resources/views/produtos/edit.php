<?php include(__DIR__ . '/../layouts/header.php'); ?>

<div class="card">
    <div class="card-header d-flex align-items-center gap-2 justify-content-between">
        <p class="card-title m-0"><?= isset($produto) ? 'Editando: ' . $produto->prod_descricao : 'Novo Produto'; ?></p>
        <?php if(isset($produto)): ?>
            <form action="/produto/destroy/<?= $produto->idprodutos ?>" method="POST" id="formDestroy">
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
        <form id="form_cadastro" action="<?= isset($produto) ? '/produto/update/' . $produto->idprodutos : '/produto/store' ?>" method="POST">
            <div class="mb-3 row">
                <div class="col-2">
                    <label for="idprodutos" class="form-label">Código <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="idprodutos" readonly disabled value="<?= $produto->idprodutos ?>">
                </div>
                <div class="col-6">
                    <label class="form-label" for="prod_descricao">Descrição <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="prod_descricao" name="prod_descricao" onkeyup="$(this).removeClass('is-invalid')" value="<?= $produto->prod_descricao ?>">
                    <div id="error_prod_descricao" class="invalid-feedback"></div>
                </div>
                <div class="col-4">
                    <label class="form-label" for="prod_cod_barras">Código de Barras <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="prod_cod_barras" name="prod_cod_barras" onkeyup="$(this).removeClass('is-invalid')" value="<?= $produto->prod_cod_barras ?>">    
                    <div id="error_prod_cod_barras" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-2">
                    <label for="prod_preco_venda" class="form-label">Valor de Venda <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-text">
                            R$
                        </div>
                        <input type="text" class="form-control rounded-end text-end" id="prod_preco_venda" name="prod_preco_venda" onkeyup="$(this).removeClass('is-invalid')" value="<?= number_format($produto->prod_preco_venda, 2, ',', '.') ?>">
                        <div id="error_prod_preco_venda" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col-2">
                    <label for="prod_peso_bruto" class="form-label">Peso Bruto <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-text">
                            KG
                        </div>
                        <input type="text" class="form-control rounded_end text-end" id="prod_peso_bruto" name="prod_peso_bruto" onkeyup="$(this).removeClass('is-invalid')" value="<?= number_format($produto->prod_peso_bruto, 3, ',') ?>">
                    </div>
                    <div id="error_prod_peso_bruto" class="invalid-feedback"></div>
                </div>
                <div class="col-2">
                    <label for="prod_peso_liquido" class="form-label">Peso Líquido <span class="text-danger">*</span></label>
                    
                    <div class="input-group">
                        <div class="input-group-text">
                            KG
                        </div>
                        <input type="text" class="form-control rounded-end text-end" id="prod_peso_liquido" name="prod_peso_liquido" onkeyup="$(this).removeClass('is-invalid')" value="<?= number_format($produto->prod_peso_liquido, 3, ',') ?>">
                    </div>
                    <div id="error_prod_peso_liquido" class="invalid-feedback"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col text-end">
                <?php if(isset($produto)): ?>
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
        if(!$("#prod_descricao").val().length) {
            erros = true;
            errorInput('prod_descricao');
        }
        if(!$("#prod_cod_barras").val().length) {
            erros = true;
            errorInput('prod_cod_barras');
        }
        if(!$("#prod_preco_venda").val().length) {
            erros = true;
            errorInput('prod_preco_venda');
        }
        if(!$("#prod_peso_bruto").val().length) {
            erros = true;
            errorInput('prod_peso_bruto');
        }
        if(!$("#prod_peso_liquido").val().length) {
            erros = true;
            errorInput('prod_peso_liquido');
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