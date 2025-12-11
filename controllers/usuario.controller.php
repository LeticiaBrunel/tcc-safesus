<?php
//Controller onde eu valido dados e faço a requisição aos Models
//Aqui é onde eu faço as regras
class ControllerUsuarios
{
  static public function ctrIngressoUsuario()
{
    if (isset($_POST["ingUsuario"], $_POST["ingPassword"], $_POST["tipo"])) {

        $usuario = trim($_POST["ingUsuario"]);
        $senha = $_POST["ingPassword"];
        $tipo = $_POST["tipo"];

        // Tipos válidos do sistema
        $tiposPermitidos = ["adm", "med", "enf", "rec"];

        if (in_array($tipo, $tiposPermitidos)) {

            $tabela = "usuarios";

            // 🔍 busca o usuário pelo login E tipo (você pode ajustar isso no ModeloUsuarios)
            $resposta = ModeloUsuarios::mdlMostrarUsuariosPorTipo($tabela, $usuario, $tipo);

            if ($resposta) {

                // Verifica tipo + senha
                if (
                    $resposta["tipo"] === $tipo &&
                    md5($senha) === $resposta["senha"]
                ) {

                    if ($resposta["status"] === "ativo") {

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION["iniciarSessao"] = "ok";
                        $_SESSION["id_usuario"] = $resposta["id_usuario"];
                        $_SESSION["login"] = $resposta["login"];
                        $_SESSION["tipo"] = $resposta["tipo"];
                        $_SESSION["nome"] = $resposta["nome"];

                        echo '<script>window.location = "index.php";</script>';
                        exit;
                    } else {
                        echo '<div class="alert alert-danger">Usuário inativo</div>';
                    }

                } else {
                    echo '<div class="alert alert-danger">Tipo ou senha incorretos</div>';
                }

            } else {
                echo '<div class="alert alert-danger">Usuário não encontrado</div>';
            }

        } else {
            echo '<div class="alert alert-danger">Tipo inválido</div>';
        }
    }
}



    /*CRIAR DE USUARIO*/
    /*CRIAR USUARIO*/
static public function ctrCriarUsuario()
{
    if (isset($_POST["docp"])) {

        // Remove caracteres não numéricos do documento
        $_POST["docp"] = preg_replace('/\D/', '', $_POST["docp"]);

        // Validação simples dos campos
        if (
            preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙ ]+$/u', $_POST["nomep"]) &&
            preg_match('/^[a-zA-Z0-9]+$/u', $_POST["docp"]) &&
            preg_match('/^[a-zA-Z0-9]+$/u', $_POST["senhap"])
        ) {

            $tabela = "usuarios";

            // Criptografa a senha em MD5
            $senhaCriptografada = md5($_POST["senhap"]);

            // Monta o array com os nomes EXATOS das colunas no banco
            $dados = array(
                "nome"   => $_POST["nomep"],
                "tipo"   => $_POST["tipoProfissional"], // campo tipo (adm, enf, med, etc.)
                "senha"  => $senhaCriptografada,
                "login"  => $_POST["docp"], // nome de login
                "status" => "ativo" // define ativo por padrão
            );

            // Chama o modelo
            $resposta = ModeloUsuarios::mdlCriarUsuario($tabela, $dados);

            if ($resposta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Usuário salvo com sucesso!",
                        showConfirmButton: true,
                        confirmButtonText: "Fechar"
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            window.location = "cadprofissional";
                        }
                    });
                </script>';
            }

        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao cadastrar usuário!",
                    text: "Verifique os campos e tente novamente.",
                    showConfirmButton: true,
                    confirmButtonText: "Fechar"
                }).then(function(result){
                    if(result.isConfirmed){
                        window.location = "cadprofissional";
                    }
                });
            </script>';
        }
    }
}


    /*MOSTRAR USUARIO*/
    static public function ctrMostrarUsuarios($item, $valor)
    {
        $tabela = "usuarios";
        $resposta = ModeloUsuarios::MdlMostrarUsuarios($tabela, $item, $valor);
        return $resposta;
    }
    /*EDITAR USUARIO*/
   public static function ctrEditarUsuario() {
    if(isset($_POST["editarUsuario"])){

        // Criptografa senha apenas se o campo não estiver vazio
        if($_POST["editarSenha"] != ""){
    $cript = md5($_POST["editarSenha"]);
} else {
    $cript = $_POST["passwordAtual"];
}


        $dados = array(
            "nome" => $_POST["editarNome"],
            "login" => $_POST["editarUsuario"], // novo login
            "loginAtual" => $_POST["loginAtual"], // login antigo
            "senha" => $cript,
            "tipo" => $_POST["editarProf"]
        );

        $resposta = ModeloUsuarios::mdlEditarUsuario("usuarios", $dados);

        if($resposta == "ok"){
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Usuário atualizado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => { window.location = 'index.php?rota=usuario'; });
            </script>";
        }
    }
}

    /*EXCLUIR USUARIO*/
   static public function ctrExcluirUsuario()
{
    if (isset($_GET["inativar"])) {
        $tabela = "usuarios";
        $dados = $_GET["inativar"];

        $resposta = ModeloUsuarios::mdlExcluirUsuario($tabela, $dados);

        if ($resposta == "ok") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Profissional excluido com sucesso!",
                    confirmButtonText: "Fechar"
                }).then(function(result) {
                    window.location = "index.php?rota=usuario";
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao inativar profissional!",
                    confirmButtonText: "Fechar"
                });
            </script>';
        }
    }
}
}

?>