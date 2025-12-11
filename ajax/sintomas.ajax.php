<?php
require_once "../models/sintomas.models.php";
require_once "../controllers/sintomas.controller.php";

if(isset($_POST["idSintoma"])){
    class AjaxSintomas {
        public $idSintoma;
        public function ajaxEditarSintomas(){
            $resposta = ControllerSintoma::ctrMostrarSintoma("id_sintomas", $this->idSintoma);
            echo json_encode($resposta);
        }
    }

    $editar = new AjaxSintomas();
    $editar->idSintoma = intval($_POST["idSintoma"]);
    $editar->ajaxEditarSintomas();
    exit;
}

// Autocomplete (opcional)
if(isset($_GET['term'])){
    $termo = $_GET['term'];
    $sintomas = ModeloSintoma::mdlBuscarSintomasPorTermo($termo);
    $resultado = [];
    foreach($sintomas as $s){
        $resultado[] = ["label"=>$s["sintomas"], "value"=>$s["sintomas"], "id"=>$s["id_sintomas"]];
    }
    echo json_encode($resultado);
    exit;
}
