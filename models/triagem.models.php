<?php

include_once 'conexao.php';

class ModeloTriagem {
    //BANCO DE DADOS
    
    static public function mdlCriarTriagem($dados) {
    $conn = Conexao::conectar(); // mysqli

    $dataObj = DateTime::createFromFormat('d/m/Y', $dados["dataT"]);
    $dataFormatada = $dataObj ? $dataObj->format('Y-m-d') : date('Y-m-d');

   $sql = "INSERT INTO triagem 
        (id_paciente, id_usuario, altura, pressao, data_triagem, peso, temperatura, frequencia_cardiaca) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Erro na preparação: " . $conn->error);
}

$stmt->bind_param(
    "iidssddd",
    $dados["id_paciente"],
    $dados["id_usuario"],
    $dados["alt"],
    $dados["pres"],
    $dataFormatada,
    $dados["peso"],
    $dados["temp"],
    $dados["freq"]
);


    if ($stmt->execute()) {
        return $stmt->insert_id;
    } else {
        return false;
    }
}
public static function mdlBuscarIdPacientePorTriagem($id_triagem) {
    $conn = Conexao::conectar();

    $sql = "SELECT id_paciente FROM triagem WHERE id_triagem = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_triagem);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    return $result['id_paciente'] ?? null;
}
}
?>