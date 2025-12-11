
<body class="hold-transition sidebar-mini layout-fixed">

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de paciente</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
      
        <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tabelas" width="100%">
                <thead>
                    <tr>
                       <th>Nome</th>
        <th>CPF</th>
        <th>Data Nascimento</th>
        <th>Sexo</th>
        <th style="width: 90px;">ações</th>
      
                     </tr>
                </thead>
              <?php
$linha = ControllerPaciente::ctrMostrarPacientes();

foreach ($linha as $key => $value) {
    echo '<tr>
            <td>' . $value["nome"] . '</td>
            <td>' . $value["cpf"] . '</td>
            <td>' . $value["Data_Nascimento"] . '</td>
            <td>' . $value["sexo"] . '</td>
            <td>
                <div class="btn-group">
                    <a href="cadtriagem?id_paciente=' . $value["id_paciente"] . '" class="btn btn-warning">
                        <i class="fa fa-bullhorn"></i>
                    </a>
                    <button class="btn btn-danger btnExcluirPaciente" 
                        idPaciente="' . $value["id_paciente"] . '" 
                        nome="' . $value["nome"] . '"> 
                        <i class="fa fa-times"></i> 
                    </button>
                </div>
            </td>
          </tr>';
}
?>


            </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    
</body>
</html>
<?php
if (isset($_GET['inativar'])) {
    $paciente = new ControllerPaciente();
    $paciente->ctrInativarPaciente();
}
?>
<style>
/* Oculta "Mostrar registros" no topo */
.dataTables_length {
    display: none !important;
}

/* Oculta o texto "Mostrando registros..." */
.dataTables_info {
    display: none !important;
}

/* Oculta a paginação (Anterior, Próximo etc) */

/* Oculta o campo de busca */
.dataTables_filter {
    display: none !important;
}
</style>
