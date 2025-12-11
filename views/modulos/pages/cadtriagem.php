<?php
require_once "controllers/triagem.controller.php";
ControllerTriagem::ctrCriarTriagem();

$id_paciente = $_GET['id_paciente'] ?? null;
$id_usuario = $_SESSION['id_usuario'] ?? null; // ← Usuário logado


if ($id_paciente) {
    $conn = Conexao::conectar();

    $stmt = $conn->prepare("SELECT nome FROM paciente WHERE id_paciente = ?");
    $stmt->bind_param("i", $id_paciente); // "i" porque é inteiro
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res && $res->num_rows > 0) {
        $linha = $res->fetch_assoc();
        $nome_paciente = $linha['nome'];
    } else {
        $nome_paciente = "";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Triagem</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css">
    <style>
        .is-invalid ~ .select2-container .select2-selection {
            border-color: #dc3545 !important;
        }
        .select2-container .select2-selection.is-invalid {
            border-color: #dc3545 !important;
        }
   .invalid-feedback {
  display: block;
  font-size: 0.85rem;
  color: #dc3545;
  margin-top: 4px;
  margin-left: 0;
}
.is-invalid {
  border-color: #dc3545 !important;
}
.col-md-6 .form-group {
  min-height: 100px; /* ajustável */
}
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<form id="quickForm" method="POST" class="formLogin">
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <h1>Cadastro de Triagem</h1>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
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
                  <label>Nome do Paciente</label>
                  <input type="text" class="form-control" value="<?php echo htmlspecialchars($nome_paciente); ?>" readonly>
                  <input type="hidden" name="tri" value="<?php echo htmlspecialchars($id_paciente); ?>" />
                </div>
                <div class="form-group">
                  <label for="alt">Altura</label>
                  <input type="text" id="alt" name="alt" placeholder="Digite a altura" class="form-control">
                </div>
                <div class="form-group">
                  <label for="pres">Pressão</label>
                  <input type="text" id="pres" name="pres" placeholder="Digite a Pressão" class="form-control">
                </div>
                <div class="form-group">
                  <label for="dataT">Data da Triagem</label>
<input type="text" id="dataT" name="dataT" placeholder="Digite a data da triagem" class="form-control" 
       value="<?php echo date('d/m/Y'); ?>" 
       data-inputmask="'alias': 'datetime','inputFormat': 'dd/mm/yyyy'" data-mask>                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="preso">Peso</label>
                  <input type="text" id="peso" name="peso" placeholder="Digite o peso" class="form-control">
                </div>
                <div class="form-group">
                  <label for="temp">Temperatura</label>
                  <input type="text" id="temp" name="temp" placeholder="Digite a Temperatura" class="form-control">
                </div>
                <div class="form-group">
                  <label for="freq">Frequência Cardíaca</label>
                  <input type="text" id="freq" name="freq" placeholder="Digite a Frequência Cardíaca" class="form-control">
                </div>
              </div>
            </div>
          </div>
<input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">

          <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
          </div>
          <!-- /.card-body -->
             </section>
        </div>

</form>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
  $("[data-inputmask]").inputmask();
});
</script>

<script>
$(document).ready(function () {
  // Ativa máscaras
  $("[data-inputmask]").inputmask();

  // Configura validação
  $("#quickForm").validate({
    rules: {
      alt: { required: true },
      pres: { required: true },
      dataT: { required: true },
      peso: { required: true },
      temp: { required: true },
      freq: { required: true }
    },
    messages: {
      alt: "Por favor, insira a altura",
      pres: "Por favor, insira a pressão",
      dataT: "Por favor, insira a data da triagem",
      peso: "Por favor, insira o peso",
      temp: "Por favor, insira a temperatura",
      freq: "Por favor, insira a frequência"
    },
   errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function (form) {
      // 🔹 Aqui vai o envio real se tudo estiver válido
      form.submit();
    }
  });

  // 🔹 Se o botão for clicado, força verificação de todos os campos
  $(".btn-primary").on("click", function (e) {
    if (!$("#quickForm").valid()) {
      e.preventDefault(); // impede envio se tiver erro
      
    }
  });
});
</script>


</body>
</html>