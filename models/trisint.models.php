<?php

include_once 'conexao.php';

class ModeloTriSint {
    //BANCO DE DADOS
    
    static public function mdlCriarTriSint($tabela, $dados) {
    $conn = Conexao::conectar();

    $sql = "INSERT INTO $tabela (id_triagem, id_sintomas) VALUES (?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação: " . $conn->error);
    }

    $stmt->bind_param("ii", $dados["id_triagem"], $dados["id_sintomas"]);

    if ($stmt->execute()) {
        return "ok";
    } else {
        return false;
    }
}

}
?>
