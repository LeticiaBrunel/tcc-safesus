<?php


include_once __DIR__ . '/../models/conexao.php';

class ModeloMedico {

    public static function mdlMostrarMedico($tabela, $item, $valor) {
    $conn = Conexao::conectar();

    if ($item != null) {
        $sql = "SELECT * FROM $tabela WHERE $item = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $valor);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result); 
    } else {
        $sql = "SELECT * FROM $tabela";
        $result = mysqli_query($conn, $sql);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

    /* REGISTRAR USUÁRIO */
   static public function mdlCriarMedico($tabela, $dados) {
    $conn = Conexao::conectar();

    $sql = "INSERT INTO $tabela (nome, especialidade, crm, telefone, email) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verifica se o prepare foi bem-sucedido
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    $stmt->bind_param("sssss", $dados["nome"], $dados["especialidade"], $dados["crm"], $dados["telefone"], $dados["email"]);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return "error";
    }

    $stmt->close();
}





    public static function mdlMostrarMedicoPorCRM($tabela, $crm) {
        $conn = Conexao::conectar();
        $stmt = $conn->prepare("SELECT * FROM $tabela WHERE crm = ?");
        $stmt->bind_param("s", $crm);
        $stmt->execute();
        $res = $stmt->get_result();
        $medico = $res->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $medico;
    }



    public static function mdlObterMedicoPorId($id_medico) {
        $conn = Conexao::conectar();
        $stmt = $conn->prepare("SELECT * FROM medico WHERE id_medico = ?");
        $stmt->bind_param("i", $id_medico);
        $stmt->execute();
        $res = $stmt->get_result();
        $medico = $res->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $medico;
    }
     public static function mdlBuscarMedicosPorTermo($termo) {
        $conn = Conexao::conectar();
        $stmt = $conn->prepare("SELECT id_medico, nome FROM medico WHERE nome LIKE CONCAT('%', ?, '%')  LIMIT 10");
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





