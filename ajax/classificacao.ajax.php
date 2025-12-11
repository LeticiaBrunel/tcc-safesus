<?php
require_once "../models/classificacao.models.php";
require_once "../controllers/classificacao.controller.php";

if(isset($_POST["idPaciente"])){
    class AjaxPaciente {
        public $idPaciente;
        public function ajaxEditarPaciente(){
            $resposta = ModeloClassificacao::mdlMostrarPacientePorId($this->idPaciente);
            echo json_encode($resposta);
        }
    }

    $editar = new AjaxPaciente();
    $editar->idPaciente = intval($_POST["idPaciente"]);
    $editar->ajaxEditarPaciente();
    exit;
}


