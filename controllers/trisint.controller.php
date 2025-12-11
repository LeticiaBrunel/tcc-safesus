<?php

require_once "models/paciente.models.php";
require_once "models/classificacao.models.php";


class ControllerTriSint {

    /* CRIAR SINTOMAS VINCULADOS A UMA TRIAGEM */
    static public function ctrCriarTriSint() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_triagem'], $_POST['id_sintoma'])) {

            $id_triagem = intval($_POST['id_triagem']);
            $ids_sintomas = $_POST['id_sintoma'];

            // Você também precisa do ID do paciente para inativá-lo
            $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;

            // ✅ Verificar se o ID da triagem é válido
            if ($id_triagem <= 0 || empty($ids_sintomas) || !is_array($ids_sintomas)) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Erro nos dados!",
                        text: "Verifique os dados da triagem e sintomas.",
                        confirmButtonText: "Fechar"
                    });
                </script>';
                return;
            }

            $erros = [];

            foreach ($ids_sintomas as $id_sintoma) {
                $id_sintoma = intval($id_sintoma);

                if ($id_sintoma <= 0) {
                    $erros[] = "ID inválido: $id_sintoma";
                    continue;
                }

                $dados = [
                    "id_triagem"  => $id_triagem,
                    "id_sintomas" => $id_sintoma
                ];

                $resposta = ModeloTriSint::mdlCriarTriSint("sintomas_triagem", $dados);
                if ($resposta !== "ok") {
                    $erros[] = $id_sintoma;
                }
            }

            if (empty($erros)) {

    $conn = Conexao::conectar();
    $resultadoClassificacao = ModeloClassificacao::classificarRiscoPaciente($id_paciente, $conn);

    $classificacao = $resultadoClassificacao['classificacao'] ?? 'Indefinido';
    $indiceFinal = $resultadoClassificacao['indice_final'] ?? 'N/A';

    // ✅ Inativar paciente após classificação
    if ($id_paciente > 0) {
        $respostaInativar = ModeloPaciente::mdlInativarPaciente("paciente", $id_paciente);
    }

    echo '<script>
        Swal.fire({
            icon: "warning",
            title: "Sintomas cadastrados com sucesso!",
            html: "Classificação de risco: <b>' . $classificacao . '</b><br>Índice final: <b>' . $indiceFinal . '</b>",
            confirmButtonText: "Fechar"
        }).then((result) => {
            if (result.isConfirmed) window.location = "listapaciente";
        });
    </script>';



            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Erro ao cadastrar alguns sintomas!",
                        text: "Verifique os seguintes IDs com falha: ' . implode(", ", $erros) . '",
                        confirmButtonText: "Fechar"
                    });
                </script>';
            }
        }
    }
}
?>
