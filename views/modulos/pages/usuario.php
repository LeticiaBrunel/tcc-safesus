<?php
include 'views/modulos/componentes/modal-editar-usuario.php';
?>

<div class="content-wrapper" style="min-height: 2838.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profissionais</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Profissionais</a></li>
              <li class="breadcrumb-item active">Tabela</li>
            </ol>
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
        <th style="width:10px">#</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Documento</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $usuarios = ControllerUsuarios::ctrMostrarUsuarios(null, null);
      foreach ($usuarios as $key => $value) {
          echo '<tr>
              <td>' . $value["id_usuario"] . '</td>
              <td>' . $value["nome"] . '</td>
              <td>' . $value["tipo"] . '</td>
              <td>' . $value["login"] . '</td>'; 

          echo '<td>
                  <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id_usuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pen"></i></button>
                      <button class="btn btn-danger btnExcluirUsuario" idUsuario="' . $value["id_usuario"] . '" usuario="' . $value["nome"] . '"><i class="fa fa-times"></i></button>
                  </div>
              </td>
          </tr>';
      }
      ?>
    </tbody>
  </table>
</div>

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
<?php
if (isset($_GET['inativar'])) {
    $excluirUsuario = new ControllerUsuarios();
    $excluirUsuario->ctrExcluirUsuario();
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



</style>
