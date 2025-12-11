<?php
require_once "controllers/classificacao.controller.php";
$pacientes = ControllerClassificacao::ctrMostrarPacientesCla();
include 'views/modulos/componentes/modal-editar-paciente.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes Classificados</title>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Lista de Pacientes Classificados</h1>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive tabelas" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Grau de risco</th>
                            <th>Data</th>
                            <th style="width: 90px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pacientes as $value):
                        $riscoOriginal = trim($value["classificacao_risco"]);
                        $risco = mb_strtolower($riscoOriginal, 'UTF-8');
                        $risco = str_replace(
                            ["á","â","ã","é","ê","í","ó","ô","õ","ú","ç"],
                            ["a","a","a","e","e","i","o","o","o","u","c"],
                            $risco
                        );
                        $classes = [
                            "vermelho" => "emergencia",
                            "emergencia" => "emergencia",
                            "laranja" => "muito-urgente",
                            "muito urgente" => "muito-urgente",
                            "amarelo" => "urgente",
                            "urgente" => "urgente",
                            "verde" => "pouco-urgente",
                            "pouco urgente" => "pouco-urgente",
                            "azul" => "sem-risco",
                        ];
                        $classeCss = $classes[$risco] ?? "sem-risco";
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($value["nome"]) ?></td>
                            <td><span class="label-risco <?= $classeCss ?>"><?= ucfirst($riscoOriginal) ?></span></td>
                            <td><?= date('d/m/Y H:i', strtotime($value["data"])) ?></td>
                            <td>
                                <div class="btn-group">
                                    
                                    <a href="cadconsulta?id_paciente=<?= $value['id_paciente'] ?>" 
                                   class="btn btn-warning btnChamarPaciente"
                                    data-nome="<?= htmlspecialchars($value['nome']) ?>"
                                    data-sexo="<?= htmlspecialchars($value['sexo'] ?? '') ?>"
                                    data-data="<?= htmlspecialchars($value['data_nascimento'] ?? '') ?>"
                                    data-sintomas="<?= htmlspecialchars($value['sintomas'] ?? '') ?>">
                                     <i class="fa fa-bullhorn"></i>
                                    </a>
<?php
echo '<button class="btn btnEditarPaciente"    
             idPaciente="'.$value['id_paciente'].'" 
             data-toggle="modal" 
             data-target="#modalEditarPaciente"
             style="background-color: #FFA500;  border: none;">
          <i class="fa fa-pen"  ></i>
      </button>';
?>

                                    
                                   <button type="button" class="btn btn-danger btnExcluirClassificacao"
    data-id-triagem="<?= $value["id_triagem"] ?>"
    data-nome="<?= htmlspecialchars($value["nome"]) ?>">
    <i class="fa fa-times"></i>
</button>


                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
if (isset($_GET['inativar'])) {
    $paciente = new ControllerClassificacao();
    $paciente->ctrInativarClassificacao();
}
?>
<style>
/* Estilo visual para o grau de risco */
.label-risco {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 5px;
    font-weight: bold;
    min-width: 130px;
    text-align: center;
    font-size: 14px;
}

/* Cores específicas do grau de risco */
.emergencia {
    background-color: #E53935; /* vermelho */
    color: #fff;
}

.muito-urgente {
    background-color: #FB8C00; /* laranja forte */
    color: #fff;
}

.urgente {
    background-color: #FFD002; /* amarelo */
    color: #000;
}

.pouco-urgente {
    background-color: #43A047; /* verde */
    color: #fff;
}

/* caso venha sem classificação */
.sem-risco {
    background-color: #1565C0;
    color: #fff;
}

/* Estilos da tabela (opcionais) */
.dataTables_length,
.dataTables_info,
.dataTables_filter {
    display: none !important;
}
.table td:nth-child(2),
.table th:nth-child(2) {
    text-align: center;
    vertical-align: middle;
}

</style>



</body>
</html>
