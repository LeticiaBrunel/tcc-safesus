<?php

class ControllerPaciente {
    /* MÉTODO: Criar Paciente */
    
static public function ctrCriarPaciente() {
    if (isset($_POST["nomePaciente"])) {

        // Validação do nome (apenas letras e espaços)
        if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $_POST["nomePaciente"])) {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Nome inválido! Use apenas letras e espaços.",
                    confirmButtonText: "Fechar"
                });
            </script>';
            return; // Para execução se nome inválido
        }

        $dados = [
            "nome"     => $_POST["nomePaciente"],
            "cpf"      => $_POST["cpfPaciente"],
            "docSus"   => $_POST["docsusPaciente"],
            "Data_Nascimento" => $_POST["dataNascPaciente"], // Manter no formato enviado
            "sexo"     => $_POST["sexoPaciente"],
            "telefone" => $_POST["telPaciente"],
            "endereco" => $_POST["endPaciente"],
            "id_usuario"  => intval($_POST['id_usuario'])
        ];

        $resposta = ModeloPaciente::mdlCriarPaciente("paciente", $dados);

        if ($resposta === "ok") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Paciente cadastrado com sucesso!",
                    confirmButtonText: "Fechar"
                }).then((result) => {
                    if (result.isConfirmed) window.location = "cadpaciente";
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao cadastrar o paciente!",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}
      //Read one e All
    static public function ctrMostrarPacientes(){
        $pacientes = ModeloPaciente::mdlMostrarPacientes();
        return $pacientes;
    }



    //Update

 public static function ctrInativarPaciente(){
    if (isset($_GET["inativar"])) {
        $tabela = "paciente";
        $id = $_GET["inativar"];

        $resposta = ModeloPaciente::mdlInativarPaciente($tabela, $id);

        if ($resposta == "ok") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Paciente excluído com sucesso!",
                    confirmButtonText: "Fechar"
                }).then(function(result) {
                    window.location = "index.php?rota=listapaciente";
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao excluir paciente!",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}

}

?>