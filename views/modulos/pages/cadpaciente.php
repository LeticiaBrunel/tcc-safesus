<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "controllers/paciente.controller.php";
$id_usuario = $_SESSION['id_usuario'] ?? null;
ControllerPaciente::ctrCriarPaciente();
?>
 
<form id="quickForm" method="POST"  class="formLogin">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de paciente</h1>
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
                  <label>Nome do Paciente</label>
                <input type="text" id="nomePaciente" name="nomePaciente" placeholder="Digite o Nome do Paciente" class="form-control select2"  style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>CPF</label>
                    <input type="text" id="cpfPaciente" name="cpfPaciente" placeholder="Digite o CPF" class="form-control" style="width:100%;" data-inputmask="'mask': ['999.999.999-99','999.999.999-99']" />
                        <span id="cpfError" class="invalid-feedback" style="display:none"></span>
                    </div>

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Documento do sus</label>
                  <input type="text" id="docsusPaciente" name="docsusPaciente" placeholder="Digite o Documento" class="form-control "  style="width: 100%;" data-inputmask="'mask': ['999 9999 9999 9999','999 9999 9999 999  9']" maxlength="25" style="width: 100%;"/>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Data de Nascimento:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="dataNascPaciente" name="dataNascPaciente" class="form-control" data-inputmask="'alias': 'datetime','inputFormat': 'dd/mm/yyyy'" data-mask>
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
                  <label>Sexo</label>
                 <select name="sexoPaciente" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    <option value="">--Selecione--</option>
                <option value="m">Masculino</option>
                <option value="f">Feminino</option>
                  </select>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6">
                <div class="form-group">
                  <label>Telefone</label>
                  <div class="select2-purple">
                <input type="text" id="telPaciente" name="telPaciente" placeholder="Digite o telefone" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" />
                  </div>
                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
           
              
            <!-- /.row -->
                 
  <!-- Campo CEP -->
  <div class="col-12 col-sm-4 ">
    <div class="form-group">
      <label>CEP</label>
      <input type="text" id="cepPaciente" name="cepPaciente" placeholder="Digite o CEP" class="form-control" data-inputmask="'mask': '99999-999'" />
    </div>
  </div>

  <!-- Endereço -->
  <div class="col-12 col-sm-8">
    <div class="form-group">
      <label>Endereço</label>
      <input type="text" id="endPaciente" name="endPaciente" placeholder="Rua, número, complemento..." class="form-control" />
    </div>
  </div>

  <!-- Bairro -->
  <div class="col-12 col-sm-4">
    <div class="form-group">
      <label>Bairro</label>
      <input type="text" id="bairroPaciente" name="bairroPaciente" class="form-control" placeholder="Digite o bairro" />
    </div>
  </div>

  <!-- Cidade -->
  <div class="col-12 col-sm-4">
    <div class="form-group">
      <label>Cidade</label>
      <input type="text" id="cidadePaciente" name="cidadePaciente" class="form-control" placeholder="Digite a cidade" />
    </div>
  </div>

  <!-- Estado -->
  <div class="col-12 col-sm-4">
    <div class="form-group">
      <label>Estado</label>
      <input type="text" id="ufPaciente" name="ufPaciente" class="form-control" maxlength="2" placeholder="UF" />
    </div>
  </div>
 
                <!-- /.form-group -->
              
              
                <!-- /.form-group -->
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
              <!-- /.col -->
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

  // ---- MÉTODOS PERSONALIZADOS ----
  $.validator.addMethod("regex", function(value, element, pattern) {
      var regex = new RegExp(pattern);
      return this.optional(element) || regex.test(value);
  }, "Formato inválido");

  $.validator.addMethod("telefoneValido", function(value, element) {
      return this.optional(element) || /^\([1-9]{2}\)\s?(9\d{4}|[2-8]\d{3})-\d{4}$/.test(value);
  }, "Telefone inválido");

  // ---- VALIDADOR PRINCIPAL ----
  $('#quickForm').validate({
      rules: {
          nomePaciente: { required: true },
          cpfPaciente: { required: true, cpfValido: true },
          docsusPaciente: { required: true, validarCNS: true },
          dataNascPaciente: { required: true, dataNascimentoValida: true },
          sexoPaciente: { required: true },
          telPaciente: { required: true, telefoneValido: true },
          cepPaciente: { required: true },
          bairroPaciente: { required: true },
          cidadePaciente: { required: true },
          ufPaciente: { required: true },
          endPaciente: { required: true }
      },
      messages: {
          nomePaciente: "Por favor, insira o nome do paciente",
          cpfPaciente: { required: "Por favor, insira o CPF", cpfValido: "CPF inválido" },
          docsusPaciente: { required: "Por favor, insira o documento do SUS", validarCNS: "CNS inválido" },
          dataNascPaciente: { required: "Por favor, insira a data de nascimento", dataNascimentoValida: "Data de nascimento inválida" },
          sexoPaciente: "Por favor, selecione o sexo",
          telPaciente: "Por favor, insira um telefone válido",
          cepPaciente: "Por favor, insira o CEP",
          bairroPaciente: "Por favor, insira o bairro",
          cidadePaciente: "Por favor, insira a cidade",
          ufPaciente: "Por favor, insira o estado",
          endPaciente: "Por favor, insira o endereço"
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
      },
      highlight: function(element) { $(element).addClass('is-invalid'); },
      unhighlight: function(element) { $(element).removeClass('is-invalid'); }
  });
</script>

<script>
$(document).ready(function() {

  // Ativa as máscaras
  $("[data-inputmask]").inputmask();

  // Ao sair do campo CEP
  $('#cepPaciente').on('blur', function() {
    var cep = $(this).val().replace(/\D/g, '');

    if (cep.length !== 8) {
      Swal.fire({
        icon: 'warning',
        title: 'CEP inválido',
        text: 'Digite um CEP com 8 números.',
        confirmButtonColor: '#0033cc'
      });
      return;
    }

    // Exibe loading enquanto busca
    Swal.fire({
      title: 'Consultando CEP...',
      text: 'Aguarde alguns segundos.',
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      }
    });

    // Consulta o ViaCEP
    $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
      Swal.close(); // fecha o loading

      if ('erro' in data) {
        Swal.fire({
          icon: 'error',
          title: 'CEP não encontrado!',
          text: 'Verifique o número e tente novamente.',
          confirmButtonColor: '#0033cc'
        });
        limparCamposEndereco();
        return;
      }

      // Preenche automaticamente os campos
      $('#endPaciente').val(data.logradouro);
      $('#bairroPaciente').val(data.bairro);
      $('#cidadePaciente').val(data.localidade);
      $('#ufPaciente').val(data.uf);
    }).fail(function() {
      Swal.close();
      Swal.fire({
        icon: 'error',
        text: 'Verifique sua conexão e tente novamente.',
        confirmButtonColor: '#0033cc'
      });
    });
  });

  // Limpar campos de endereço
  function limparCamposEndereco() {
    $('#endPaciente').val('');
    $('#bairroPaciente').val('');
    $('#cidadePaciente').val('');
    $('#ufPaciente').val('');
  }
});
</script>






<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"967f01dcbea6619d","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>

</body>
</html>