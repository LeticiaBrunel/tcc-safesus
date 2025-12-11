<?php


include_once __DIR__ . '/../models/conexao.php';

class ModeloUsuarios
{

    public static function mdlMostrarUsuarios($tabela, $item, $valor)
    {
        $conn = Conexao::conectar();

        if ($item != null) {
            $sql = "SELECT * FROM $tabela WHERE $item = ? AND status = 'ativo'";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $valor);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return mysqli_fetch_assoc($result);
        } else {
            $sql = "SELECT * FROM $tabela  WHERE status = 'ativo'";
            $result = mysqli_query($conn, $sql);
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    /* REGISTRAR USUÁRIO */
    static public function mdlCriarUsuario($tabela, $dados)
{
    $conn = Conexao::conectar();

    $stmt = $conn->prepare("
        INSERT INTO $tabela (nome, tipo, senha, login, status)
        VALUES (?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    $stmt->bind_param(
        "sssss",
        $dados["nome"],
        $dados["tipo"],
        $dados["senha"],
        $dados["login"],
        $dados["status"]
    );

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
}


    

  

    /* EDITAR USUÁRIO */
 static public function mdlEditarUsuario($tabela, $dados) {
    $conn = Conexao::conectar();

    $stmt = $conn->prepare("UPDATE $tabela SET nome = ?, senha = ?, tipo = ?, login = ? WHERE login = ?");
    $stmt->bind_param("sssss", $dados["nome"], $dados["senha"], $dados["tipo"], $dados["login"], $dados["loginAtual"]);

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
}

    /* ATUALIZAR USUÁRIO */
    static public function mdlAtualizarUsuario($tabela, $item1, $valor1, $item2, $valor2) {
        $stmt = Conexao::conectar()->prepare("
            UPDATE $tabela 
            SET $item1 = :$item1 
            WHERE $item2 = :$item2
        ");
        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        $resultado = $stmt->execute();
        $stmt = null;
        return $resultado ? "ok" : "error";
    }


static public function mdlExcluirUsuario($tabela, $dados)
{
    $con = Conexao::conectar(); // mysqli

    $novoStatus = 'inativo';

    $stmt = $con->prepare("UPDATE $tabela SET status = ? WHERE id_usuario = ?");

    if (!$stmt) {
        die("Erro ao preparar statement: " . $con->error);
    }

    // Usa $dados, não $id
    $stmt->bind_param("si", $novoStatus, $dados);

    $resultado = $stmt->execute();

    $stmt->close();
    $con->close();

    return $resultado ? "ok" : "error";
}

static public function mdlMostrarUsuariosPorTipo($tabela, $login, $tipo)
{
    $conn = Conexao::conectar();
    $sql = "SELECT * FROM $tabela WHERE login = ? AND tipo = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $tipo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}





}