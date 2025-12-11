<?php
//Controller onde eu valido dados e faço a requisição aos Models
//Aqui é onde eu faço as regras
class ControllerSintoma {
   
    static public function ctrCriarSintoma(){
        if (isset($_POST["nome"])) {

            // Validação do nome (apenas letras e espaços)
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
                "sintoma"         => $_POST["nome"],
                "indice_urgencia"  => $_POST["ind"]
            ];

            $resposta = ModeloSintoma::mdlCriarSintoma("sintomas", $dados);

            if ($resposta === "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Sintoma cadastrado com sucesso!",
                        confirmButtonText: "Fechar"
                    }).then((result) => {
                        if (result.isConfirmed) window.location = "sintomas";
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Erro ao cadastrar o sintoma!",
                        confirmButtonText: "Fechar"
                    });
                </script>';
            }
        }
    }


    
    /*MOSTRAR USUARIO*/
    static public function ctrMostrarSintoma($item, $valor){
        $tabela = "sintomas";
        $resposta = ModeloSintoma::MdlMostrarSintoma($tabela, $item, $valor);
        return $resposta;
    }
    /*EDITAR USUARIO*/
   static public function ctrEditarSintoma() {
    if (isset($_POST["editarNomeSintoma"])) {
        if (preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙ ]+$/u', $_POST["editarNomeSintoma"])) {
            if (is_numeric($_POST["editarIndiceUrgencia"])) {
                $tabela = "sintomas";
                $dados = [
                    "id_sintomas" => $_POST["idSintoma"],
                    "sintomas" => $_POST["editarNomeSintoma"],
                    "indice_urgencia" => $_POST["editarIndiceUrgencia"]
                ];
                $resposta = ModeloSintoma::mdlEditarSintoma($tabela, $dados);
                if ($resposta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Sintoma editado com sucesso!",
                            confirmButtonText: "Fechar"
                        }).then(() => window.location="sintomas");
                    </script>';
                }
            } else {
                echo 'Índice de urgência inválido.';
            }
        } else {
            echo 'Nome do sintoma inválido.';
        }
    }
}

    /*EXCLUIR USUARIO*/
   
 public static function ctrInativarSintoma(){
    if (isset($_GET["inativar"])) {
        $tabela = "sintomas";
        $id = $_GET["inativar"];

        $resposta = ModeloSintoma::mdlInativarSintoma($tabela, $id);

        if($resposta == "ok"){
            echo'<script>
                Swal.fire({
                    icon: "success",
                    title: "Sintoma excluído com sucesso!",
                    confirmButtonText: "Fechar"
                }).then(function(result) {
                    window.location = "index.php?rota=sintomas";
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao excluir sintoma!",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}


           
 }
    
?>