<?php
include 'views/modulos/componentes/modal-editar-sintomas.php';
?>

<div class="content-wrapper" style="min-height: 2838.44px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sintomas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Sintomas</a></li>
              <li class="breadcrumb-item active">Tabela</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
     
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped dt-responsive tabelas" width="100%">
                <thead>
                    <tr>
                       <th style="width:10px">#</th>
                       <th>Sintoma</th>
                       <th>Índice de Urgência</th>
                       <th style="width: 90px;">Ações</th>
                     </tr>
                </thead>  
                <tbody>
                <?php
                $sintomas = ControllerSintoma::ctrMostrarSintoma(null, null);
                foreach ($sintomas as $key => $value){
                    echo ' <tr>
                        <td>'.$value["id_sintomas"].'</td>
                        <td>'.$value["sintomas"].'</td>
                        <td>'.$value["indice_urgencia"].'</td>
                        <td>
                            <div class="btn-group">
                              <button class="btn btn-warning btnEditarSintoma" 
                                idSintoma="'.$value["id_sintomas"].'" data-toggle="modal"  data-target="#modalEditarSintoma">
                                  <i class="fa fa-pen"></i>
                               </button>
        
                        <button class="btn btn-danger btnExcluirSintoma" 
                        idSintoma="' . $value["id_sintomas"] . '" 
                        sintoma="' . $value["sintomas"] . '"> 
                        <i class="fa fa-times"></i> 
                        </button>
                             </div>
                            </td>
                    </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
      </div>
    </section>
</div>

<?php
if (isset($_GET['inativar'])) {
    $sintoma = new ControllerSintoma();
    $sintoma->ctrInativarSintoma();
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

</style>
