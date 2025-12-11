<?php
session_start();
include('../models/conexao.php');

// Verifica se os campos foram enviados
if (!isset($_POST['login']) || !isset($_POST['senha'])) {
    header("Location: telalogin.php");
    exit();
}

$login = trim($_POST['login']);
$senha = md5(trim($_POST['senha']));

// Verifica se os campos estão vazios
if (empty($login) || empty($senha)) {
    $_SESSION['erro'] = "Todos os campos devem ser preenchidos.";
    header("Location: telalogin.php");
    exit();
}

// Consulta no banco
$sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
$res = mysqli_query($id, $sql);

// Checa se a consulta retornou dados
if (mysqli_num_rows($res) > 0) {
    $_SESSION['usuario'] = $login;
       echo '<script> window.location = "../views/modulos/pages/inicio.php" </script>';
    exit();
} else {
    $_SESSION['erro'] = "Login ou senha incorretos.";
    header("Location: tudo/telalogin.php");
    exit();
}
?>
