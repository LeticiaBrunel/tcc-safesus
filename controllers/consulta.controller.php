<?php
require_once "models/consulta.models.php";
require_once "models/classificacao.models.php";

class ControllerConsulta
{


    static public function ctrCriarConsulta()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['diaConsulta'], $_POST['recConsulta'], $_POST['id_paciente'])) {

            // DEBUG TEMPORÁRIO: Imprime os valores enviados (remova depois)
            error_log("DEBUG: diaConsulta = " . ($_POST['diaConsulta'] ?? 'NULL'));
            error_log("DEBUG: recConsulta = " . ($_POST['recConsulta'] ?? 'NULL'));
            error_log("DEBUG: id_medico = " . ($_POST['id_medico'] ?? 'NULL'));
            error_log("DEBUG: id_paciente = " . ($_POST['id_paciente'] ?? 'NULL'));

            // Validação simples dos campos obrigatórios
            if (empty($_POST['diaConsulta']) || empty($_POST['recConsulta'])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Preencha o diagnóstico e a receita!",
                    confirmButtonText: "Fechar"
                });
            </script>';
                return;
            }

            // Validação extra: id_medico deve ser válido (não vazio/null)
            if (empty($_POST['id_medico']) || !is_numeric($_POST['id_medico'])) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Selecione um médico válido da lista!",
                    confirmButtonText: "Fechar"
                });
            </script>';
                return;
            }

            // Buscar a triagem mais recente do paciente
            $triagem = self::ctrObterTriagem($_POST['id_paciente']);
            if (!$triagem) {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Nenhuma triagem encontrada para este paciente!",
                    confirmButtonText: "Fechar"
                });
            </script>';
                return;
            }

            // Monta o array de dados
            $dados = [
                "diagnostico" => $_POST["diaConsulta"],
                "receita" => $_POST["recConsulta"],
                "data_hora" => date('Y-m-d H:i:s'),
                "observacoes" => $_POST["obsConsulta"] ?? '',
                "encaminhamento" => $_POST["encaminhamento"] ?? '',
                "id_triagem" => $triagem['id_triagem'],
                "id_medico" => intval($_POST['id_medico']) // Garante que seja inteiro
            ];

            // Chama o modelo que insere no banco
            $id_consulta = ModeloConsulta::mdlCriarConsulta($dados);
            if ($id_consulta) {
                // Inativa a classificação de risco do paciente
                ModeloClassificacao::mdlInativarClassificacao('classificacao_risco', $triagem['id_triagem']);

                echo '<script>
        Swal.fire({
            icon: "success",
            title: "Consulta cadastrada com sucesso!",
            confirmButtonText: "Fechar",
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "listapacienteCla";
            }
        });
        
    </script>';
            } else {

                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao cadastrar consulta!",
                    confirmButtonText: "Fechar"
                });

            </script>';
            }
        }
    }



    static public function ctrObterPaciente($idPaciente)
    {
        return ModeloConsulta::mdlObterPaciente("paciente", $idPaciente);
    }

    static public function ctrObterTriagem($idPaciente)
    {
        $tabela = "triagem";
        // Busca a triagem mais recente do paciente
        return ModeloConsulta::mdlObterTriagemPorPaciente($tabela, $idPaciente);
    }

    static public function ctrObterSintomasTriagem($idTriagem)
    {
        return ModeloConsulta::mdlObterSintomasTriagem("sintomas_triagem", $idTriagem);
    }


    public static function ctrListarMedicos()
    {

        return ModeloConsulta::mdlListarMedicos();
    }

}
