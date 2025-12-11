
    <?php

    class ControllerClassificacao {
        static public function ctrMostrarPacientesCla() {
            return ModeloClassificacao::mdlMostrarPacientesCla();
        }

        public static function ctrProximoPaciente() {
            return ModelClassificacao::mdlProximoPaciente();
        }

        public static function ctrEditarPaciente() {
        
            
    if (isset($_POST["idTriagem"])) { // ✅ Corrigido
        $tabela = "classificacao_risco";
        $dados = [
            "id" => $_POST["idTriagem"], // ✅ idTriagem e não idPaciente
            "grau_risco" => $_POST["editarGrauRisco"]
        ];

        $resposta = ModeloClassificacao::mdlEditarClassificacao($tabela, $dados);
        

        if ($resposta == "ok") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Classificação editada com sucesso!",
                    confirmButtonText: "Fechar"
                }).then(() => window.location="listapacienteCla");
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao editar!",
                    text: "Tente novamente.",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}

      public static function ctrInativarClassificacao()
{
    if (isset($_GET["inativar"])) {
        $idTriagem = intval($_GET["inativar"]);

        $tabela = "classificacao_risco";
        $resposta = ModeloClassificacao::mdlInativarClassificacao($tabela, $idTriagem);

        if ($resposta == "ok") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Classificação inativada!",
                    confirmButtonText: "Fechar"
                }).then(() => window.location="listapacienteCla");
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao inativar",
                    text: "Tente novamente.",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}
    }