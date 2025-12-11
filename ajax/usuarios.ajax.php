<?php

require_once "../controllers/usuario.controller.php";
require_once "../models/usuario.models.php";

class AjaxUsuarios{
	/*EDITAR USUARIO*/
	public $idUsuario;
	public function ajaxEditarUsuario(){
        $item = "id_usuario";
        $valor = $this->idUsuario;
        $resposta = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($resposta);
	}
	/*ATIVAR USUARIO*/
	public $ativarUsuario;
	public $ativarId;
	public function ajaxAtivarUsuario(){
		$tabela = "usuarios";
		$item1 = "status";
		$valor1 = $this->ativarUsuario;
		$item2 = "id_usuario";
		$valor2 = $this->ativarId;
		$resposta = ModeloUsuarios::mdlAtualizarUsuario($tabela, $item1, $valor1, $item2, $valor2);
	}

}

/*EDITAR USUARIO*/
if(isset($_POST["idUsuario"])){
	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();
}

/*ATIVAR USUARIO*/
if(isset($_POST["ativarUsuario"])){
	$ativarUsuario = new AjaxUsuarios();
	$ativarUsuario -> ativarUsuario = $_POST["ativarUsuario"];
	$ativarUsuario -> ativarId = $_POST["ativarId"];
	$ativarUsuario -> ajaxAtivarUsuario();
}
