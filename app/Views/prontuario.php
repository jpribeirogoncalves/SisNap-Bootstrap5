<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/prontuario.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>

    <title>Prontuario | SisNap</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('index.php/menu') ?>">
                    <div style="background-color: white; padding: 5px; display: inline-block; border-radius: 10px;">
                        <img class="img-logo" src="<?= base_url('img/nap2.png') ?>" alt="Univiçosa" style="width: 130px;">
                    </div>
                </a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav ms-auto" style="margin-bottom: 10px;">
                        <li class="nav-item">
                            <a class="nav-link btn btn-light text-dark" href="javascript:history.back()" title="Voltar">
                                <i class="bi bi-arrow-left-circle-fill"></i> Voltar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script>
        <?php if (isset($message) && isset($type)) : ?>
            Swal.fire({
                title: '<?php echo $message; ?>',
                icon: '<?php echo $type; ?>',
                timer: 3000,
                showConfirmButton: false
            }).then(function() {
                window.location.href = "../historico_prontuario";
            });
        <?php endif; ?>
    </script>

    <main>
        <div class="container" style="margin-top: 50px;">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form class="formulario" method="post" action="<?php echo base_url('historico_prontuario/store'); ?>">
                        <?php echo csrf_field(); ?>
                        <h1>Ficha de Prontuário</h1>
                        <div class="mb-3">
                            <label for="responsavel" class="form-label">Responsável pelo atendimento</label>
                            <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo isset($prontuario['responsavel']) ? $prontuario['responsavel'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="paciente" class="form-label">Nome do paciente</label>
                            <input type="text" class="form-control" id="paciente" name="paciente" value="<?php echo isset($prontuario['paciente']) ? $prontuario['paciente'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data" name="data" value="<?php echo isset($prontuario['data']) ? $prontuario['data'] : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="descricao" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="descricao" name="descricao" required><?php echo isset($prontuario['descricao']) ? $prontuario['descricao'] : ''; ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo isset($prontuario['id']) ? $prontuario['id'] : ''; ?>">
                        <div class="mb-3">
                            <input type="submit" class="btn btn-primary" value="Enviar Dados">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js"></script>


</body>

</html>