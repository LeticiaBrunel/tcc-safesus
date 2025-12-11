<?php
require_once "conexao.php";

class ModeloConsulta {

static public function mdlCriarConsulta($dados) {
    $conn = Conexao::conectar();
    $tabela = "consulta";

    // Verificação: id_medico deve existir na tabela medico (FK)
    if (!empty($dados["id_medico"])) {
        $checkSql = "SELECT id_medico FROM medico WHERE id_medico = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("i", $dados["id_medico"]);
        $checkStmt->execute();
        $checkStmt->store_result();
        if ($checkStmt->num_rows == 0) {
            $checkStmt->close();
            $conn->close();
            return false; // Médico não existe
        }
        $checkStmt->close();
    } else {
        // Se id_medico for vazio/null, falha (já validado no controller, mas segurança extra)
        $conn->close();
        return false;
    }

    $sql = "INSERT INTO $tabela (diagnostico, receita, data_hora, observacoes, encaminhamento, id_triagem, id_medico)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

 
    $stmt->bind_param(
        "sssssii",
        $dados["diagnostico"],
        $dados["receita"],
        $dados["data_hora"],
        $dados["observacoes"],
        $dados["encaminhamento"],
        $dados["id_triagem"],
        $dados["id_medico"]
    );

    if ($stmt->execute()) {
        $id = $conn->insert_id;
        $stmt->close();
        $conn->close();
        return $id;
    } else {
        error_log("Erro ao inserir consulta: " . $stmt->error);
        $stmt->close();
        $conn->close();
        return false;
    }
}
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



static public function mdlObterTriagemPorPaciente($tabela, $idPaciente) {
    $conn = Conexao::conectar();
    $idPaciente = intval($idPaciente);

    $query = "SELECT * FROM $tabela WHERE id_paciente = $idPaciente ORDER BY id_triagem DESC LIMIT 1";
    $resultado = mysqli_query($conn, $query);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        return mysqli_fetch_assoc($resultado);
    }

    return null;
}

 static public function mdlObterPaciente($tabela, $idPaciente)
    {
         $conn = Conexao::conectar();
        $idPaciente = intval($idPaciente);

        $query = "SELECT nome, data_nascimento, sexo FROM $tabela WHERE id_paciente = $idPaciente";
        $resultado = mysqli_query($conn, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        }

        return null;
    }

    static public function mdlObterTriagem($tabela, $idTriagem)
    {
          $conn = Conexao::conectar();
        $idTriagem = intval($idTriagem);

        $query = "SELECT * FROM $tabela WHERE id_triagem = $idTriagem";
        $resultado = mysqli_query($conn, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        }

        return null;
    }

   static public function mdlObterSintomasTriagem($tabela, $idTriagem)
{
    $conn = Conexao::conectar();
    $idTriagem = intval($idTriagem);

    $query = "
        SELECT s.sintomas
        FROM $tabela AS st
        INNER JOIN sintomas AS s ON st.id_sintomas = s.id_sintomas
        WHERE st.id_triagem = $idTriagem
    ";

    $resultado = mysqli_query($conn, $query);

    $sintomas = [];
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $sintomas[] = trim($row['sintomas']);
        }
    }

    mysqli_close($conn);

    // Remove duplicados e ordena
    $sintomas = array_unique($sintomas);
    sort($sintomas);

    return $sintomas;
}



    public static function mdlListarMedicos() {
        $con = Conexao::conectar(); // usa sua conexão atual
        $sql = "SELECT id_medico, nome FROM medico";
        $resultado = mysqli_query($con, $sql);

        $medicos = [];
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $medicos[] = $row;
            }
        }
        return $medicos;
    }
static public function mdlObterConsultaCompleta($idConsulta)
{
    $conn = Conexao::conectar();

    $sql = "SELECT 
            c.id_consulta,
            c.diagnostico,
            c.receita,
            c.data_hora,
            c.observacoes,
            c.encaminhamento,

            t.altura,
            t.peso,
            t.pressao,
            t.temperatura,
            t.frequencia_cardiaca,
            t.data_triagem,

            p.nome,
            p.cpf,
            p.data_nascimento,
            p.sexo,
            p.telefone,

            m.nome AS nome_medico
        FROM consulta c
        JOIN triagem t ON t.id_triagem = c.id_triagem
        JOIN paciente p ON p.id_paciente = t.id_paciente
        JOIN medico m ON m.id_medico = c.id_medico
        WHERE c.id_consulta = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idConsulta);
    $stmt->execute();

    $resultado = $stmt->get_result()->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $resultado;
}



   
}


