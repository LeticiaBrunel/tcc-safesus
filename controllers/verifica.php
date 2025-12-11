<?php
session_start(); //Inicia a sessão do inicio do script

//verifica se o usuário esta logado
//(se as variaveis de sessao estao definidas)
if(!isset($_SESSION['usuario'])){
    //redireciona o usuário para a página de login
    header("Location: pages/telaLogin.php");
    exit; //encerra o script
}
?>