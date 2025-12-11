<?php


include_once __DIR__ . '/../models/conexao.php';

class ModeloSintoma {

    public static function mdlMostrarSintoma($tabela, $item, $valor) {
    $conn = Conexao::conectar();

    if ($item != null) {
        $sql = "SELECT * FROM $tabela WHERE $item = ? AND status = 'ativo'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $valor); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result); 
    } else {
        $sql = "SELECT * FROM $tabela WHERE status = 'ativo'";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

    /* REGISTRAR USUÁRIO */
    static public function mdlCriarSintoma($tabela, $dados) {
        $conn = Conexao::conectar();

        $stmt = $conn->prepare(
            "INSERT INTO $tabela (sintomas, indice_urgencia)
            VALUES (?, ?)"
            );

         if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    $stmt->bind_param(
        "ss", 
        $dados["sintoma"], 
        $dados["indice_urgencia"]
    );

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
}


    /* EDITAR USUÁRIO */
   
 static public function mdlEditarSintoma($tabela, $dados) {
  $conn = Conexao::conectar();
$stmt = $conn->prepare("UPDATE $tabela SET sintomas=?, indice_urgencia=? WHERE id_sintomas=?");
$stmt->bind_param("ssi", $dados["sintomas"], $dados["indice_urgencia"], $dados["id_sintomas"]);

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
    }

    /* ATUALIZAR USUÁRIO */
    static public function mdlAtualizarSintoma($tabela, $item1, $valor1, $item2, $valor2) {
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


    /* EXCLUIR USUÁRIO */
   
static public function mdlInativarSintoma($tabela, $id)
{
    $con = Conexao::conectar(); // mysqli
    $novoStatus = 'inativo';
    $stmt = $con->prepare("UPDATE $tabela SET status = ? WHERE id_sintomas = ?");
    if (!$stmt) {
        die("Erro ao preparar statement: " . $con->error);
    }
    $stmt->bind_param("si", $novoStatus, $id); // status é string (s), id é inteiro (i)
    $resultado = $stmt->execute();
    $stmt->close();
    $con->close();
    return $resultado ? "ok" : "error";
}

public static function mdlBuscarSintomasPorTermo($termo) {
    $conn = Conexao::conectar();
    $stmt = $conn->prepare("SELECT id_sintomas, sintomas FROM sintomas WHERE sintomas LIKE CONCAT('%', ?, '%') AND status = 'ativo' LIMIT 10");
    $stmt->bind_param("s", $termo);
    $stmt->execute();
    $result = $stmt->get_result();

    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $dados;
}


}