<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soft-Line | Login></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body class="vh-100 d-flex flex-column">
    <main class="container flex-grow-1 my-3 d-flex flex-column justify-content-center">
        <main class="form-signin w-100 m-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-4 text-center">
                    <?php if(isset($err)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $err ?>
                        </div>
                    <?php endif; ?>
                    <form action="/auth/store" method="POST">
                        <h1 class="h3 mb-3 fw-normal">Soft-Line | Novo Usuário</h1>
        
                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" id="user_nome" placeholder="Usuário" name="user_nome" value="<?= isset($request) ? $request->get('user_nome') : ''; ?>">
                            <label for="user_nome">Nome</label>
                        </div>

                        <div class="form-floating mb-1">
                            <input type="text" class="form-control" id="user_login" placeholder="Usuário" name="user_login" value="<?= isset($request) ? $request->get('user_login') : ''; ?>">
                            <label for="user_login">Usuário</label>
                        </div>

                        <div class="form-floating mb-1">
                            <input type="password" class="form-control" id="password" placeholder="Senha" name="password">
                            <label for="password">Senha</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirmar Senha" name="password_confirmation">
                            <label for="password_confirmation">Confirmar Senha</label>
                        </div>
        
                        <button class="btn btn-primary w-100 py-2 mb-2" type="submit">Cadastrar</button>
                        
                        <p class="text-muted">
                            Já tem uma conta? <a href="/auth/login"> fazer o login</a>
                        </p>
                    </form>
                </div>
            </div>
        </main>
    </main>
</body>

</html>