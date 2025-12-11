<?php
require_once "../models/consulta.models.php"; // Ajuste o caminho
$term = $_GET['term'] ?? '';
$medicos = ModeloConsulta::mdlListarMedicos(); // Busca todos os médicos
$result = [];
foreach ($medicos as $medico) {
    if (stripos($medico['nome'], $term) !== false) { // Filtra por nome
        $result[] = [
            'label' => $medico['nome'],
            'value' => $medico['nome'],
            'id_medico' => $medico['id_medico']
        ];
    }
}
header('Content-Type: application/json');
echo json_encode($result);
?>