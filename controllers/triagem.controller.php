<?php

class ControllerTriagem {

    static public function ctrCriarTriagem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tri'])) {

            // Validações numéricas (altura, peso, temp, freq)
            $altValida = preg_match('/^\d+(\.\d+)?$/', str_replace(',', '.', $_POST['alt'] ?? ''));
            $pesoValida = preg_match('/^\d+(\.\d+)?$/', str_replace(',', '.', $_POST['peso'] ?? ''));
            $tempValida = preg_match('/^\d+(\.\d+)?$/', str_replace(',', '.', $_POST['temp'] ?? ''));
            $freqValida = preg_match('/^\d+(\.\d+)?$/', str_replace(',', '.', $_POST['freq'] ?? ''));

            if (!$altValida || !$pesoValida || !$tempValida || !$freqValida) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Campos numéricos inválidos! Verifique Altura, Peso, Temperatura e Frequência.",
                        confirmButtonText: "Fechar"
                    });
                </script>';
                return;
            }

          $dados = [
    "id_paciente" => intval($_POST['tri']),
    "id_usuario"  => intval($_POST['id_usuario']), 
    "alt"        => floatval(str_replace(',', '.', $_POST['alt'] ?? '0')),
    "peso"       => floatval(str_replace(',', '.', $_POST['peso'] ?? '0')),
    "pres"       => $_POST['pres'] ?? '',
    "temp"       => floatval(str_replace(',', '.', $_POST['temp'] ?? '0')),
    "freq"       => floatval(str_replace(',', '.', $_POST['freq'] ?? '0')),
    "dataT"      => $_POST['dataT'] ?? date('d/m/Y'),
];


            $id_triagem = ModeloTriagem::mdlCriarTriagem($dados);

            if ($id_triagem) {
                // Buscar paciente pelo id para pegar o nome
                $paciente = ModeloPaciente::mdlBuscarPacientePorId($dados['id_paciente']);
                $nomePaciente = $paciente['nome'] ?? 'Paciente';

                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Triagem cadastrada com sucesso para: ' . addslashes($nomePaciente) . '",
                        confirmButtonText: "Fechar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "cadTriSint?id_triagem=' . $id_triagem . '&id_paciente=' . $dados['id_paciente'] . '";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Erro ao cadastrar triagem!",
                        confirmButtonText: "Fechar"
                    });
                </script>';
            }
        }
    }
}


?>  