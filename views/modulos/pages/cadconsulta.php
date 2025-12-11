<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "controllers/consulta.controller.php";
ControllerConsulta::ctrCriarConsulta();
$idTriagem = isset($_GET['id_triagem']) ? $_GET['id_triagem'] : null;

// 🔹 Buscar informações da triagem
$dados = $idTriagem ? ControllerConsulta::ctrObterTriagem($idTriagem) : null;


$idPaciente = $_GET['id_paciente'] ?? null;
$dadosPaciente = null;

if ($idPaciente) {
    $dadosPaciente = ControllerConsulta::ctrObterPaciente($idPaciente);
}
$pacienteInfo = null;
$sintomas = "";

if (isset($_GET["id_paciente"])) {
    $idPaciente = $_GET["id_paciente"];

    // Buscar dados do paciente
    $pacienteInfo = ControllerConsulta::ctrObterPaciente($idPaciente);

    // Buscar triagem do paciente
    $triagem = ControllerConsulta::ctrObterTriagem($idPaciente); // ajuste conforme sua lógica

    // Buscar sintomas da triagem (se existir)
    if ($triagem && isset($triagem["id_triagem"])) {
       $sintomasArray = ControllerConsulta::ctrObterSintomasTriagem($triagem["id_triagem"]);

// monta lista formatada
if (!empty($sintomasArray)) {
    $sintomas = "<ul>";
    foreach ($sintomasArray as $s) {
        $sintomas .= "<li>" . htmlspecialchars($s) . "</li>";
    }
    $sintomas .= "</ul>";
} else {
    $sintomas = "<p>Nenhum sintoma registrado.</p>";
}

    }
}
$medicos = ControllerConsulta::ctrListarMedicos();


?>
<style>
/* Opcional: deixa o autocomplete igual ao da sua imagem */
.ui-autocomplete {
  max-height: 150px;
  overflow-y: auto;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
  padding: 0;
}
.ui-menu-item {
  padding: 6px 10px;
  cursor: pointer;
}
.ui-menu-item:hover {
  background-color: #f0f0f0;
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
            <h1>Cadastro de consulta</h1>
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
                  <label>Nome do paciente</label>
    <input type="text" name="nomePaciente" class="form-control"  value="<?= htmlspecialchars($pacienteInfo['nome'] ?? '') ?>" 
           readonly>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                  <div class="row">
                   <div class="col-md-6">
                     <label>Data de nascimento</label>
                    <input type="text" id="data" name="data" class="form-control select2" 
       value="<?= htmlspecialchars($dadosPaciente['data_nascimento'] ?? '') ?>" readonly/>
                    </div>
                     <div class="col-md-6">
                     <label>Sexo</label>
                     <input type="text" id="sexo" name="sexo" class="form-control select2" 
       value="<?= htmlspecialchars($dadosPaciente['sexo'] ?? '') ?>" readonly/>
                     </div>
                     </div>
                    </div>
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>Diagnóstico</label>
              <input type="text" id="diaConsulta" name="diaConsulta" placeholder="Digite o diagnóstico" class="form-control" style="width: 100%;" /></div>
                <!-- /.form-group -->
                <div class="form-group">
                  <label>Receita</label>
                  <div class="select2-purple">
                <input type="text" id="recConsulta" name="recConsulta" placeholder="Digite a receita" class="form-control"  />
                
                  </div>
                  
                  <!-- /.input group -->
                </div>
                

                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
  <div class="col-md-6">
    <div class="form-group">
  <label>Sintomas</label>
  <div class="form-select" 
       style="background-color:#fff; border:1px solid #ced4da; border-radius:4px; padding:8px 12px; height:auto; max-height:120px; overflow-y:auto; cursor:default;">
    <ul style="margin:0; padding-left:20px; list-style-type:disc;">
      <?php if (!empty($sintomasArray)): ?>
        <?php foreach ($sintomasArray as $s): ?>
          <li><?= htmlspecialchars($s) ?></li>
        <?php endforeach; ?>
      <?php else: ?>
        <li>Nenhum sintoma registrado.</li>
      <?php endif; ?>
    </ul>
  </div>


<div class="form-group">
  <label>Encaminhamento</label>
  <input type="text" name="encaminhamento" id="encaminhamento" class="form-control" placeholder="Digite o encaminhamento (opcional)">
</div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>Observações</label>
      <textarea id="obsConsulta" name="obsConsulta" placeholder="Digite observações adicionais" class="form-control" rows="2"></textarea>
    </div>
    
  
  <div class="form-group">
    <label for="medico">Médico</label>
    
<input type="text" id="medico" name="medico" class="form-control" placeholder="Digite o nome do médico">
<input type="hidden" id="id_medico" name="id_medico">

        </div>
  
      
 
 




  </div>
  
</div>
 </div>
 <div class="card-footer">

 <input type="hidden" name="id_triagem" value="<?= htmlspecialchars($_GET['id_triagem'] ?? '') ?>">
<input type="hidden" name="id_paciente" value="<?= htmlspecialchars($_GET['id_paciente'] ?? '') ?>">


                  <button type="submit" class="btn btn-primary">Cadastrar</button>
                 
                </div>
      </div>
          </div>
          <!-- /.card-body -->
             </section>
        </div>

</form>  
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/4.0.9/jquery.inputmask.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015" integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ==" data-cf-beacon='{"rayId":"967f01dcbea6619d","serverTiming":{"name":{"cfExtPri":true,"cfEdge":true,"cfOrigin":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"version":"2025.7.0","token":"2437d112162f4ec4b63c3ca0eb38fb20"}' crossorigin="anonymous"></script>
