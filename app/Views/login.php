<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | SisNap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
  
    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>

<body>
    <div id="login" class="container">
        <div class="aviso alert alert-danger" id="aviso-login" style="display:none;">
            <p><strong><?php echo $msg ?? ''; ?></strong></p>
        </div>

        <form class="card" method="post" style="padding: 20px;">

            <?php echo csrf_field(); ?>

            <div class="logo text-center">
                <img class="img-logo" src="<?= base_url('img/nap.png') ?>" alt="Univiçosa">
                <p>Núcleo de Apoio Psicopedagógico</p>
            </div>

            <script>
                <?php if (isset($msg) && $msg !== '') : ?>
                    document.getElementById('aviso-login').style.display = 'block';

                    // Definir o tempo de exibição em milissegundos (por exemplo, 5000 = 5 segundos)
                    var tempoExibicao = 4000;

                    // Função para ocultar o aviso após o tempo definido
                    setTimeout(function() {
                        document.getElementById('aviso-login').style.display = 'none';
                    }, tempoExibicao);
                <?php endif; ?>
            </script>

            <div class="form-floating mb-3">
                <input type="text" name="matricula" class="form-control" id="floatingInput" required>
                <label for="floatingInput">Matricula:</label>
                <i class="bi bi-person-fill form-icon"></i>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="senha" class="form-control" id="floatingPassword" required>
                <label for="floatingPassword">Senha:</label>
                <i class="bi bi-lock-fill form-icon"></i>
            </div>

            <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Entrar
                </button>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js"></script>

</body>

</html>