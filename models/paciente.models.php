<?php


include_once __DIR__ . '/../models/conexao.php';

class ModeloPaciente {
    //BANCO DE DADOS
static public function mdlCriarPaciente($tabela, $dados) {
    $conn = Conexao::conectar();

    // Converte data
    $dataInvertida = DateTime::createFromFormat('d/m/Y', $dados["Data_Nascimento"])->format('Y-m-d');

    $stmt = $conn->prepare(
        "INSERT INTO $tabela (nome, cpf, docSus, Data_Nascimento, sexo, telefone, endereco, id_usuario) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    $stmt->bind_param(
        "sssssssi", 
        $dados["nome"], 
        $dados["cpf"], 
        $dados["docSus"], 
        $dataInvertida,       // Aqui usa a data invertida
        $dados["sexo"], 
        $dados["telefone"], 
        $dados["endereco"],
        $dados["id_usuario"]
    );

    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
}


    //Read one e All
    public static function mdlMostrarPacientes() {
        $conn = Conexao::conectar();

        $sql = "SELECT * FROM paciente WHERE status = 'ativo'";
        $res = mysqli_query($conn, $sql);

        $pacientes = [];

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $pacientes[] = $row;
            }
        }

        mysqli_close($conn);
        return $pacientes;
    }

static public function mdlInativarPaciente($tabela, $id)
{
    $con = Conexao::conectar(); // mysqli

    $novoStatus = 'inativo';

    $stmt = $con->prepare("UPDATE $tabela SET status = ? WHERE id_paciente = ?");
    
    if (!$stmt) {
        die("Erro ao preparar statement: " . $con->error);
    }

    $stmt->bind_param("si", $novoStatus, $id); // status é string (s), id é inteiro (i)

    $resultado = $stmt->execute();

    $stmt->close();
    $con->close();

    return $resultado ? "ok" : "error";
}

public static function mdlBuscarPacientePorId($id_paciente) {
    $conn = Conexao::conectar();

    // Protege contra SQL Injection
    $id_paciente_esc = mysqli_real_escape_string($conn, $id_paciente);

    $stmt = $conn->prepare("SELECT * FROM paciente WHERE id_paciente = ? AND status = 'ativo' LIMIT 1");
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$res = $stmt->get_result();

    if ($res && mysqli_num_rows($res) > 0) {
        $paciente = mysqli_fetch_assoc($res);
        mysqli_close($conn);
        return $paciente; // array com dados do paciente (incluindo nome)
    } else {
        mysqli_close($conn);
        return false;
    }
}


}