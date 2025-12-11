
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "controllers/medico.controller.php";
ControllerMedico::ctrCriarMedico();
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
            <h1>Cadastro de médico</h1>
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
                  <label>Nome do médico</label>
                <input type="text" id="nome" name="nome" placeholder="Digite o Nome do Médico" class="form-control select2"  style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Especialidade</label>
               <input type="text" id="esp" name="esp" placeholder="Digite a Especialidade" class="form-control select2"  style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>CRM</label>
              <input type="text" id="crm" name="crm" placeholder="CRM/UF 123456" class="form-control" style="width: 100%;" data-inputmask="'mask': 'CRM/[AA] 999999', 'definitions': { 'a': { 'validator': '[A-Z]', 'casing': 'upper' } }"/>                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Telefone</label>
                  <div class="select2-purple">
                <input type="text" id="tel" name="tel" placeholder="Digite o telefone" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" />
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" id="email" name="email" placeholder="Digite o Email" class="form-control select2"  style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
              </div>
            </div>
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

$(document).ready(function() {
  $('#crm').inputmask();
});
</script>

<script>

// --- MÉTODO REGEX (necessário para email e telefone) ---
$.validator.addMethod("regex", function(value, element, pattern) {
    var regex = new RegExp(pattern);
    return this.optional(element) || regex.test(value);
}, "Formato inválido");


// -------------------- VALIDAÇÃO DO FORM --------------------
$('#quickForm').validate({
    rules: {
        nome: {
            required: true
        },
        esp: {
            required: true
        },
        crm: {
            required: true
        },
        tel: {
            required: true,
            // Validação de telefone com DDD, fixo e celular
            regex: /^\([1-9]{2}\)\s?(9\d{4}|[2-8]\d{3})-\d{4}$/
        },
        email: {
            required: true,
            email: true,
            // Validação avançada de email
            regex: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Z]{2,}$/i
        }
    },
    messages: {
        nome: "Por favor, insira o nome do médico",
        esp: "Por favor, insira a especialidade",
        crm: "Por favor, insira o CRM",
        tel: "Por favor, insira um telefone válido",
        email: "Por favor, insira um e-mail válido"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
        $(element).removeClass('is-invalid');
    }
});


// Ativa InputMask
$(document).ready(function() {
    $("[data-inputmask]").inputmask();
});

</script>


<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"967f01dcbea6619d","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>

</body>
</html>
