<?php
require_once "conexao.php";

class ModeloClassificacao {

    public static function classificarRiscoPaciente($idPaciente, $conn) {
        // 1. Buscar o ID da triagem
        $stmt = $conn->prepare("SELECT id_triagem FROM triagem WHERE id_paciente = ? ORDER BY id_triagem DESC LIMIT 1");
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        $stmt->bind_result($idTriagem);
        $stmt->fetch();
        $stmt->close();

        if (!$idTriagem) {
            return "Triagem não encontrada.";
        }

        // 2. Buscar sintomas da triagem
        $stmt = $conn->prepare("SELECT id_sintomas FROM sintomas_triagem WHERE id_triagem = ?");
        $stmt->bind_param("i", $idTriagem);
        $stmt->execute();
        $result = $stmt->get_result();

        $sintomasIds = [];
        while ($row = $result->fetch_assoc()) {
            $sintomasIds[] = $row['id_sintomas'];
        }
        $stmt->close();

        if (empty($sintomasIds)) {
            return "Nenhum sintoma cadastrado.";
        }

        // 3. Buscar índice de urgência de cada sintoma
        $indices = [];
        foreach ($sintomasIds as $idSintoma) {
            $stmt = $conn->prepare("SELECT indice_urgencia FROM sintomas WHERE id_sintomas = ?");
            $stmt->bind_param("i", $idSintoma);
            $stmt->execute();
            $stmt->bind_result($indice);
            $stmt->fetch();
            $stmt->close();

            if ($indice !== null) {
                $indices[] = (int)$indice;
            }
        }

        if (empty($indices)) {
            return "Sintomas sem índice válido.";
        }

        $indiceMaximo = max($indices);

        // 4. Buscar idade do paciente
        $stmt = $conn->prepare("SELECT Data_Nascimento FROM paciente WHERE id_paciente = ?");
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        $stmt->bind_result($dataNascimento);
        $stmt->fetch();
        $stmt->close();

        $idade = null;
        if ($dataNascimento) {
        $dataNasc = new DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $hoje->diff($dataNasc)->y;
        }

        if ($idade !== null && ($idade <= 5 || $idade >= 65)) {
        $indiceMaximo = min($indiceMaximo + 1, 10);
    }

        // 5. Definir classificação
        if ($indiceMaximo >= 9) {
            $classificacao = "vermelho";
        } elseif ($indiceMaximo >= 6) {
            $classificacao = "amarelo";
        } elseif ($indiceMaximo >= 3) {
            $classificacao = "verde";
        } else {
            $classificacao = "azul";
        }

        // 6. Atualizar paciente
        $stmt = $conn->prepare("INSERT INTO classificacao_risco (classificacao_risco, id_triagem, data) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $classificacao, $idTriagem);
        $stmt->execute();
        $stmt->close();


        return [
            "classificacao" => ucfirst($classificacao),
            "indice_final" => $indiceMaximo
        ];
    }

   public static function mdlMostrarPacientesCla() {
    $conn = Conexao::conectar();

    $sql = "SELECT cr.id_triagem, cr.classificacao_risco, cr.data, 
                   p.nome, p.id_paciente
            FROM classificacao_risco cr
            INNER JOIN triagem t ON cr.id_triagem = t.id_triagem
            INNER JOIN paciente p ON t.id_paciente = p.id_paciente
            WHERE cr.status = 'ativo'
            ORDER BY 
                CASE 
                    WHEN cr.classificacao_risco = 'Vermelho' THEN 1
                    WHEN cr.classificacao_risco = 'Laranja' THEN 2
                    WHEN cr.classificacao_risco = 'Amarelo' THEN 3
                    WHEN cr.classificacao_risco = 'Verde' THEN 4
                    WHEN cr.classificacao_risco = 'Azul' THEN 5
                    ELSE 6
                END,
                cr.data ASC";  // agora do mais antigo para o mais recente

    $res = mysqli_query($conn, $sql);

    $pacientesCla = [];

    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $pacientesCla[] = $row;
        }
    }

    mysqli_close($conn);
    return $pacientesCla;
}



     public static function mdlEditarClassificacao($tabela, $dados) {
    $conn = Conexao::conectar();

    $stmt = $conn->prepare("UPDATE $tabela SET classificacao_risco = ? WHERE id_triagem = ?");
    $grauRisco = ucfirst(strtolower($dados["grau_risco"]));
    $stmt->bind_param("si", $grauRisco, $dados["id"]);


    $resultado = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $resultado ? "ok" : "error";
}


public static function mdlMostrarPacientePorId($idPaciente) {
    $conn = Conexao::conectar();

    $stmt = $conn->prepare("
        SELECT 
            cr.id_triagem,
            cr.classificacao_risco,
            p.nome,
            p.id_paciente
        FROM classificacao_risco cr
        INNER JOIN triagem t ON cr.id_triagem = t.id_triagem
        INNER JOIN paciente p ON t.id_paciente = p.id_paciente
        WHERE p.id_paciente = ?
        ORDER BY cr.data DESC
        LIMIT 1
    ");
    $stmt->bind_param("i", $idPaciente);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $res ?: [];
}

public static function mdlInativarClassificacao($tabela, $id)
{
    $con = Conexao::conectar();

    $novoStatus = 'inativo';
    // Primeiro busca o status atual
      $stmt = $con->prepare("UPDATE $tabela SET status = ? WHERE id_triagem = ?");
    
    if (!$stmt) {
        die("Erro ao preparar statement: " . $con->error);
    }

    $stmt->bind_param("si", $novoStatus, $id); // status é string (s), id é inteiro (i)

    $resultado = $stmt->execute();

    $stmt->close();
    $con->close();

    return $resultado ? "ok" : "error";
}




}


