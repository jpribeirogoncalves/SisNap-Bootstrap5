<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/historico-anam.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <!-- Inclua o CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

    <!-- Inclua o script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>
    <title>Gerenciar Anamnese | SisNap</title>


    <script>
        function confirma() {
            if (!confirm('Deseja excluir o registro?')) {
                return false;
            }

            return true;
        }
    </script>

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
                            <a class="nav-link btn btn-light text-dark" href="<?= base_url('index.php/historico_anamnese/create') ?>" title="Cadastrar Usúario">
                                <i class="bi bi-file-earmark-plus-fill"></i> Criar Nova Ficha
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto" style="margin-bottom: 10px;">
                        <li class="nav-item">
                            <a class="nav-link btn btn-light text-dark" href="<?= base_url('index.php/menu') ?>" title="Voltar">
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
        <div class="container">
            <div class="text-center mt-4">
                <h2>Gerenciamento das fichas de Anamnese</h2>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <p class="text-center">Para pesquisar, digite o nome do Paciente ou Responsável</p>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col">
                    <form method="GET" action="<?= base_url('index.php/historico_anamnese/search') ?>" class="d-flex justify-content-center">
                        <div class="input-group">
                            <input type="text" name="searchTerm" id="txtBusca" class="form-control" placeholder="" required="" value="<?= $searchTerm ?? '' ?>" />
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col text-end">
                    <a href="<?= base_url('index.php/historico_anamnese') ?>" class="btn btn-danger">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </div>

            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Responsável</th>
                            <th>Paciente</th>
                            <th>Data</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anamnese as $anamnese) : ?>
                            <tr>
                                <td><?php echo $anamnese['id'] ?></td>
                                <td><?php echo $anamnese['responsavel'] ?></td>
                                <td><?php echo $anamnese['paciente'] ?></td>
                                <td><?php echo $anamnese['data'] ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/historico_anamnese/edit/' . $anamnese['id']) ?>" class="btn btn-warning mr-4">
                                        <img src="<?= base_url('img/Editar-ficha-Preto.png') ?>" title="Editar" alt="Editar">
                                    </a>
                                    -
                                    <a href="<?= base_url('index.php/historico_anamnese/pdf/' . $anamnese['id']) ?>" class="btn btn-primary mr-4">
                                        <img src="<?= base_url('img/download-PDF-Preto.png') ?>" title="Gerar PDF" alt="Gerar PDF">
                                    </a>
                                    -
                                    <a href="<?= base_url('index.php/historico_anamnese/delete/' . $anamnese['id']) ?>" onclick="return confirma()" class="btn btn-danger">
                                        <img src="<?= base_url('img/Lixeira-Preto.png') ?>" title="Excluir" alt="Excluir">
                                    </a>
                                </td>
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
                                <a class="page-link" href="<?= base_url('index.php/historico_anamnese?page=' . ($currentPage - 1)) ?>">Anterior</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                    <a class="page-link" href="<?= base_url('index.php/historico_anamnese?page=' . $i) ?>"><?php echo $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?php if ($currentPage == $totalPages) echo 'disabled'; ?>">
                                <a class="page-link" href="<?= base_url('index.php/historico_anamnese?page=' . ($currentPage + 1)) ?>">Próxima</a>
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