<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "models/paciente.models.php";
require_once "controllers/sintomas.controller.php";
require_once "controllers/trisint.controller.php";
require_once "models/sintomas.models.php";
require_once "models/trisint.models.php";

ControllerSintoma::ctrCriarSintoma();
ControllerTriSint::ctrCriarTriSint();

$id_triagem = isset($_GET['id_triagem']) ? intval($_GET['id_triagem']) : 0;
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

$paciente = ModeloPaciente::mdlBuscarPacientePorId($id_paciente);
$nomePaciente = $paciente['nome'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Sintomas do Paciente</title>

  <!-- Estilos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

  <style>
    /* autocomplete */
    .ui-autocomplete {
      background: #fff;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      max-height: 180px;
      overflow-y: auto;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 0.25rem;
    }

    .ui-menu-item-wrapper {
      padding: 8px 10px;
      cursor: pointer;
      border-radius: 6px;
      transition: background 0.2s;
    }

    .ui-menu-item-wrapper:hover {
      background: #007bff;
      color: #fff;
    }

    /* botão adicionar sintoma */
    .btn-add-sintoma {
 /* menos espaço */
  background-color: #007bff;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 6px;
  transition: 0.3s;
}

    .btn-add-sintoma:hover {
      background-color: #0069d9;
    }

    /* campos de sintoma */
    .sintoma-select {
  display: flex;
  align-items: flex-start; /* alinha o topo do botão e do input */
  gap: 8px;
  margin-bottom: 10px;
}

.campo-sintoma {
  display: flex;
  flex-direction: column; /* mensagem fica embaixo do input */
  flex: 1; /* ocupa toda a largura restante */
}

.invalid-feedback {
  color: #dc3545;
  font-size: 0.875rem;
  margin-top: 4px;
  margin-left: 2px;
}

.btn-remove-sintoma {
  padding: 6px 10px;
  background-color: #dc3545;
  border: none;
  color: #fff;
  border-radius: 6px;
  height: 38px; /* igual altura ao input */
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
}

.btn-remove-sintoma:hover {
  background-color: #b52b38;
}
    .campo-sintoma {
  display: flex;
  flex-direction: column; /* força a mensagem a ficar embaixo */
}

.invalid-feedback {
  color: #dc3545;
  font-size: 0.875rem;
  margin-top: 4px;
  margin-left: 2px;
}

#sintoma-container .invalid-feedback {
  margin-top: 2px;
  margin-left: 2px;
}
  </style>
</head>

<body>
<section class="content">
  <div class="content-wrapper">
    <form id="quickForm" method="POST" class="formLogin" novalidate>
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">  
              <h1>Sintomas do paciente</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="card card-default">
            <div class="card-header  text-black">
              <h3 class="card-title">Insira as informações abaixo</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
              </div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nome do paciente</label>
                    <input type="text" value="<?php echo htmlspecialchars($nomePaciente); ?>" readonly class="form-control" />
                  </div>
                </div>

                <div class="col-md-6">
  <div class="form-group">
    <label>Sintoma</label>
    <div id="sintoma-container">
      <div class="sintoma-select">
        <div class="campo-sintoma" style="flex: 1;">
          <input type="text" name="sint[]" class="form-control sint" required placeholder="Digite o sintoma" autocomplete="off">
          
          <input type="hidden" name="id_sintoma[]" class="id_sintoma">
        </div>
      </div>
    </div>
  </div>

  <!-- ✅ AGORA O BOTÃO FICA AQUI, FORA DO FORM-GROUP -->
  <button type="button" class="btn btn-add-sintoma">
    <i class="fas fa-plus-circle"></i> Adicionar Sintoma
  </button>
</div>
              </div>
            </div>

            <input type="hidden" name="id_triagem" value="<?php echo $id_triagem; ?>">
            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
          </div>
        </div>
      </section>
    </form>
  </div>
</section>

<!-- jQuery e plugins -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



</body>
</html>