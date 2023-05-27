<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/anamnese.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>

    <title>Anamnese | SisNap</title>
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
                window.location.href = "../historico_anamnese";
            });
        <?php endif; ?>
    </script>

    <main>
        <div class="container" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <form class="formulario" method="post" action="<?php echo base_url('historico_anamnese/storeEdit'); ?>">
                        <?php echo csrf_field(); ?>
                        <h1>Editar - Ficha de Anamnese</h1>
                        <div class="espaco">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3" style="margin-top: 5px;">
                                        <label for="responsavel" class="form-label">Responsável do paciente</label>
                                        <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?php echo isset($anamnese['responsavel']) ? $anamnese['responsavel'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="paciente" class="form-label">Nome do paciente</label>
                                        <input type="text" class="form-control" id="paciente" name="paciente" value="<?php echo isset($anamnese['paciente']) ? $anamnese['paciente'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data" class="form-label">Data e Hora:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="date" class="form-control" id="data" name="data" value="<?php echo isset($anamnese['data']) ? $anamnese['data'] : ''; ?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="time" class="form-control" id="hora" name="hora" value="<?php echo isset($anamnese['hora']) ? $anamnese['hora'] : ''; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="curso" class="form-label">Curso</label>
                                        <input type="text" class="form-control" id="curso" name="curso" value="<?php echo isset($anamnese['curso']) ? $anamnese['curso'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($anamnese['email']) ? $anamnese['email'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo isset($anamnese['data_nascimento']) ? $anamnese['data_nascimento'] : ''; ?>" required>
                                    </div>



                                    <div class="mb-3">
                                        <label for="idade" class="form-label">Idade</label>
                                        <input type="text" class="form-control" id="idade" name="idade" value="<?php echo isset($anamnese['idade']) ? $anamnese['idade'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo isset($anamnese['telefone']) ? $anamnese['telefone'] : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3" style="margin-top: 5px;">
                                        <label for="periodo_turno" class="form-label">Período/Turno</label>
                                        <input type="text" class="form-control" id="periodo_turno" name="periodo_turno" value="<?php echo isset($anamnese['periodo_turno']) ? $anamnese['periodo_turno'] : ''; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="responsavel_ficha" class="form-label">Encaminhado por</label>
                                        <input type="text" class="form-control" id="responsavel_ficha" name="responsavel_ficha" value="<?php echo isset($anamnese['responsavel_ficha']) ? $anamnese['responsavel_ficha'] : ''; ?>" required>
                                    </div>


                                    <div class="mb-3">
                                        <label for="descricao" class="form-label">Breve descrição do motivo</label>
                                        <textarea class="form-control" id="descricao" name="descricao" required><?php echo isset($anamnese['descricao']) ? $anamnese['descricao'] : ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="historico" class="form-label">Histórico (Uso de medicação, faz psicoterapia, etc)</label>
                                        <textarea class="form-control" id="historico" name="historico" required><?php echo isset($anamnese['historico']) ? $anamnese['historico'] : ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="historico_familia" class="form-label">Histórico familiar</label>
                                        <textarea class="form-control" id="historico_familia" name="historico_familia" required><?php echo isset($anamnese['historico_familia']) ? $anamnese['historico_familia'] : ''; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="relacao_familiar" class="form-label">Relação familiar</label>
                                        <textarea class="form-control" id="relacao_familiar" name="relacao_familiar" required><?php echo isset($anamnese['relacao_familiar']) ? $anamnese['relacao_familiar'] : ''; ?></textarea>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <input type="submit" value="Enviar Dados" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo isset($anamnese['id']) ? $anamnese['id'] : ''; ?>">
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