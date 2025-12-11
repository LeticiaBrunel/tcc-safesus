
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "controllers/usuario.controller.php";
ControllerUsuarios::ctrCriarUsuario();

$nomePreenchido = isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : '';
$tipoPreenchido = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$docPreenchido = isset($_GET['doc']) ? htmlspecialchars($_GET['doc']) : '';

?>
<style>
  .senha-container {
    position: relative;
}

.senha-container input {
    width: 100%;
    padding-right: 40px; /* espaço para o ícone */
    box-sizing: border-box;
}

.toggle-senha {
    position: absolute;
    right: 10px;
    top: 40%;
    transform: translateY(-30%);
    cursor: pointer;
    width: 20px;  /* diminuiu o tamanho */
    height: 20px; /* diminuiu o tamanho */
}
  </style>

<form id="quickForm" method="POST"  class="formLogin">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastro de profissionais</h1>
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
                  <label>Nome do Profissional</label>
                  <?php $nomePreenchido = isset($_GET['nome']) ? htmlspecialchars($_GET['nome']) : ''; ?>
                <input type="text" id="nomep" name="nomep" placeholder="Digite o Nome do Profissional" class="form-control select2"  style="width: 100%;" value="<?php echo $nomePreenchido; ?>"   />
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Cargo do profissional</label>
                <?php $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : ''; ?>
                <select id="tipoProfissional" name="tipoProfissional" class="form-control select2 select2-danger" style="width: 100%;">
                 <option value="">--Selecione--</option>
                <option value="rec" <?= $tipo == 'rec' ? 'selected' : '' ?>>Recepcionista</option>
                <option value="med" <?= $tipo == 'med' ? 'selected' : '' ?>>Médico(a)</option>
                 <option value="enf" <?= $tipo == 'enf' ? 'selected' : '' ?>>Enfermeiro(a)</option>
                 <option value="adm" <?= $tipo == 'adm' ? 'selected' : '' ?>>Administrador(a)</option>
                </select>

                </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Documento</label>
                  
                    <input type="text" id="docp" name="docp" placeholder="Digite o Documento" class="form-control select2" style="width: 100%;" value="<?php echo $docPreenchido; ?>"/>
                  <span id="docError" class="invalid-feedback" style="display: block;"></span>
                  </div>
                 
<div class="form-group">
    <label for="senhap" >Senha:</label>
    <div class="senha-container">
        <input type="password" id="senhap" name="senhap" placeholder="Insira sua senha" class="form-control select2" style="width: 100%;" maxlength="8" >
        <img src="tudo/imgs/icons8-visível-100.png" id="toggleSenha" class="toggle-senha" alt="Mostrar senha">
    </div>
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
const toggleSenha = document.getElementById('toggleSenha');
const senhaInput = document.getElementById('senhap');

toggleSenha.addEventListener('click', function() {
    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        toggleSenha.src = 'tudo/imgs/icons8-invisível-100.png'; // ícone para "ocultar"
    } else {
        senhaInput.type = 'password';
        toggleSenha.src = 'tudo/imgs/icons8-visível-100.png'; // ícone para "mostrar"
    }
});
</script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"967f01dcbea6619d","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>

</body>
</html>
