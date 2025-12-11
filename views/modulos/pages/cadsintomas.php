
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "controllers/sintomas.controller.php";
ControllerSintoma::ctrCriarSintoma();
?>
<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
  <section class="content">
 
<form id="quickForm" method="POST"  class="formLogin">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de sintoma</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Insira as informações abaixo</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nome do sintoma</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o Nome do sintoma" class="form-control select2"  style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Índice de Urgência</label>
                 <select  id="ind" name="ind"  class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option value="">--Selecione--</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                  </select>
                </div>

                
                <!-- /.form-group -->
                
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            
 </div>
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
            nome: {
                required: true
            },
            ind: {
                required: true
            }
        },
        messages: {
            nome: "Por favor, insira o nome do sintoma",
            ind: "Por favor, insira o índice de urgência"
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
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"967f01dcbea6619d","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>

</body>
</html>
