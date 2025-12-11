<?php
require_once "controllers/template.controller.php";
require_once "controllers/usuario.controller.php";
require_once "controllers/paciente.controller.php";
require_once "controllers/triagem.controller.php";
require_once "controllers/trisint.controller.php";
require_once "controllers/utils/file.controller.php";
require_once "controllers/sintomas.controller.php";
require_once "controllers/medico.controller.php";
require_once "controllers/classificacao.controller.php";
require_once "controllers/consulta.controller.php";


require_once "models/paciente.models.php";
require_once "models/conexao.php";
require_once "models/triagem.models.php";
require_once "models/usuario.models.php";
require_once "models/trisint.models.php";
require_once "models/sintomas.models.php";
require_once "models/medico.models.php";
require_once "models/classificacao.models.php";
require_once "models/consulta.models.php";


$template = new ControllerTemplate();
$template->ctrTemplate();