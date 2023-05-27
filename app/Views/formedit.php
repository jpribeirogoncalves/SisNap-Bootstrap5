<!DOCTYPE html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= base_url('css/registrar.css') ?>">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.min.js"></script>


  <title>Editar Usuario | SisNap</title>
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
        window.location.href = '../usuarios/';
      });
    <?php endif; ?>
  </script>


  <div class="container" style="margin-top: 50px;">
    <div id="login">
      <div class="card">
        <?php echo form_open('usuarios/storeEdit'); ?>
        <div class="card-body">
          <h2 class="card-title">Editar</h2>
          <div class="alert alert-danger text-center <?php echo isset($message_erro) && $message_erro !== '' ? 'show' : 'd-none'; ?>">
            <?php echo $message_erro ?? ''; ?>
          </div>
          <div class="card-content-area mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo isset($usuarios['nome']) ? $usuarios['nome'] : ''; ?>" class="form-control" required>
          </div>
          <div class="card-content-area mb-3">
            <label for="matricula" class="form-label">Matrícula:</label>
            <input type="number" id="matricula" name="matricula" value="<?php echo isset($usuarios['matricula']) ? $usuarios['matricula'] : ''; ?>" class="form-control" required>
          </div>
          <div class="card-content-area mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" id="senha" name="senha" value="<?php echo isset($usuarios['senha']) ? $usuarios['senha'] : ''; ?>" class="form-control" required>
          </div>
          <div class="card-content-area mb-3">
            <fieldset>
              <legend>Selecione o tipo de usuário:</legend>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="perfil" id="usuario" value="usuario" <?php if (isset($usuarios['perfil']) && $usuarios['perfil'] == "usuario") echo "checked" ?>>
                <label class="form-check-label" for="usuario">Usuário</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="perfil" id="admin" value="admin" <?php if (isset($usuarios['perfil']) && $usuarios['perfil'] == "admin") echo "checked" ?>>
                <label class="form-check-label" for="admin">Admin</label>
              </div>
            </fieldset>
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <input type="hidden" name="id" value="<?php echo isset($usuarios['id']) ? $usuarios['id'] : ''; ?>">
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js"></script>


</body>

</html>