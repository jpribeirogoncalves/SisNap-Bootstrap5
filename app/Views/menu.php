<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="<?= base_url('css/menu.css') ?>">
  <link rel="stylesheet" href="<?= base_url('node_modules/bootstrap-icons/font/bootstrap-icons.css') ?>">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <title>Menu | SisNap</title>
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
          <div class="d-flex align-items-center">
            <p class="nav-item nav-link text-light mb-0 me-3">
              <strong>
                <i class="bi bi-person-fill"></i> Perfil:
              </strong>
              <?php echo $perfil; ?>
            </p>

            <p class="nav-item nav-link text-light mb-0 me-3">
              <strong>
                <i class="bi bi-person-circle"></i> Nome:
              </strong>
              <?php echo $nome; ?>
            </p>
          </div>
          <ul class="navbar-nav mx-auto margin" style="margin-bottom: 10px;">
            <li class="nav-item">
              <a class="nav-link btn btn-light text-dark" href="<?= base_url('index.php/usuarios') ?>" title="Gerenciar Usuários">
                <i class="bi bi-people-fill"></i> Gerenciar Usuários
              </a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto" style="margin-bottom: 10px;">
            <li class="nav-item">
              <a class="nav-link btn btn-light text-dark" href="<?= base_url('index.php/logout') ?>" title="Sair">
                <i class="bi bi-door-open-fill"></i> Sair
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>




  <main class="container-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="text-center" style="margin-bottom: 70px;">
            <h2 id="bemvindo" class="mb-4">Seja bem-vindo(a) <?php echo $nome; ?>!</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-6" style="margin-bottom: 20px;">
          <div class="card bg-dark text-center text-light shadow">
            <div class="card-body">
              <h5 class="card-title">Ficha de Prontuário</h5>
              <p class="card-text">Crie e gerencie uma nova ficha de prontuário.</p>
              <div class="d-grid gap-2" style="background-color: white; padding: 10px;">
                <a href="<?= base_url('index.php/historico_prontuario/create') ?>" class="btn btn-primary">Criar Nova Ficha</a>
                <a href="<?= base_url('index.php/historico_prontuario') ?>" class="btn btn-secondary">Gerenciar Historico de Fichas</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card bg-dark text-center text-light shadow">
            <div class="card-body">
              <h5 class="card-title">Ficha de Anamnese</h5>
              <p class="card-text">Crie e gerencie uma nova ficha de anamnese.</p>
              <div class="d-grid gap-2" style="background-color: white; padding: 10px;">
                <a href="<?= base_url('index.php/historico_anamnese/create') ?>" class="btn btn-primary">Criar Nova Ficha</a>
                <a href="<?= base_url('index.php/historico_anamnese') ?>" class="btn btn-secondary">Gerenciar Historico de Fichas</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>




  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.5.0/js/bootstrap.min.js"></script>


</body>

</html>