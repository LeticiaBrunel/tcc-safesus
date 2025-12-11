<?php
//Controller onde eu valido dados e faço a requisição aos Models
//Aqui é onde eu faço as regras
class ControllerMedico {
   
   static public function ctrCriarMedico() {
   if (isset($_POST["nome"])) {

    // validação do nome
if (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/u", $_POST["nome"])) {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Nome inválido! Use apenas letras e espaços.",
                        confirmButtonText: "Fechar"
                    });
                </script>';
                return;
            }
    $dados = [
        "nome" => $_POST["nome"],
        "especialidade" => $_POST["esp"],
        "crm" => $_POST["crm"],
        "telefone" => $_POST["tel"],
        "email" => $_POST["email"]
    ];

    $resposta = ModeloMedico::mdlCriarMedico("medico", $dados);

    if ($resposta === "ok") {
        // Sucesso
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Médico cadastrado com sucesso!",
                confirmButtonText: "Fechar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "cadprofissional?nome=' . urlencode($_POST["nome"]) . '&tipo=med&doc=' . urlencode($_POST["crm"]) . '";
                }
            });
        </script>';
    } else {
        // Erro ao cadastrar
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Erro ao cadastrar o medico!",
                confirmButtonText: "Fechar"
            });
        </script>';
    }
}
// Não coloque else aqui
}
    public static function ctrBuscarMedicos($termo) {
        return ModeloMedico::mdlBuscarMedicosPorTermo($termo);
    }
}
 

?>