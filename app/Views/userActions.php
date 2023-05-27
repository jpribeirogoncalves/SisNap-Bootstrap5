<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/usuarios.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>

    <title>Gerenciar Ações | SisNap</title>


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
                            <a class="nav-link btn btn-light text-dark" href="<?= base_url('index.php/usuarios') ?>" title="Voltar">
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
                window.history.back();
            });
        <?php endif; ?>
    </script>


    <main>
        <div class="container" style="margin-top: 20px;">
            <div class="text-center mt-4">
                <h2>Gerenciamento de Ações dos Usuários</h2>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <p class="text-center">Para pesquisar, digite o Nome ou Ação</p>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <form method="GET" action="<?= base_url('index.php/usuarios/search_Action') ?>" class="d-flex justify-content-center">
                        <div class="input-group">
                            <input type="text" name="searchTerm" id="txtBusca" class="form-control" placeholder="" required="" value="<?= $searchTerm ?? '' ?>" />
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url('index.php/usuarios/actionUser') ?>" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-striped table-colored">
                    <thead class="table-dark">
                        <tr>
                            <th>ID da ação</th>
                            <th>ID do usuario</th>
                            <th>Nome</th>
                            <th>Ação</th>
                            <th>Data e Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_action as $action) : ?>
                            <tr>
                                <td><?php echo $action['id'] ?></td>
                                <td><?php echo $action['id_usuario'] ?></td>
                                <td><?php echo $action['nome'] ?></td>
                                <td><?php echo $action['action'] ?></td>
                                <td><?php echo $action['timestamp'] ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?php if ($currentPage == 1) echo 'disabled'; ?>">
                                <a class="page-link" href="<?= base_url('index.php/usuarios/actionUser?page=' . ($currentPage - 1)) ?>">Anterior</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                    <a class="page-link" href="<?= base_url('index.php/usuarios/actionUser?page=' . $i) ?>"><?php echo $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php if ($currentPage == $totalPages) echo 'disabled'; ?>">
                                <a class="page-link" href="<?= base_url('index.php/usuarios/actionUser?page=' . ($currentPage + 1)) ?>">Próxima</a>
                            </li>
                        </ul>
                    </nav>
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