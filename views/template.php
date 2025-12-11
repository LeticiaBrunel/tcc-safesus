<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- Alteraçãao modo Respomsividade -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Triagem Hospitalar </title>
    <!-- Google Font: Source Sans Pro -->
   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     

   

    <!-- Theme style Alterar para versão não comprimida-->
    <link rel="stylesheet" href="views/dist/css/adminlte.css">
    <link rel="stylesheet" href="views/css/personalizacao.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <!-- jQuery -->
    <script src="views/plugins/jquery/jquery.min.js"></script>

    <!-- REQUIRED SCRIPTS -->
    <!-- DataTables  & Plugins -->
    <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="views/plugins/jszip/jszip.min.js"></script>
    <script src="views/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="views/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    

    
    

    <!-- Bootstrap 4 -->
    <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <?php
    //Verificação de Sessão
    if (isset($_SESSION["iniciarSessao"]) && $_SESSION["iniciarSessao"] == "ok") {
        echo '<div class="wrapper">'; //wrapper passado para dentro do php
        //Cabeçalho
        include "modulos/componentes/cabecalho.php";
        //Menu Lateral
        include "modulos/componentes/menu-lateral.php";
        //Conteúdo
        // Verifica se existe a variável 'rota' na URL
        if (isset($_GET["rota"])) {
            // Usa a estrutura switch para verificar o valor de 'rota'
            switch ($_GET["rota"]) {
                case "cadpaciente": include "modulos/pages/cadpaciente.php";break;
                case "listapaciente":include "modulos/pages/listapaciente.php";break;
                case "usuario": include "modulos/pages/usuario.php";break;
                case "sintomas": include "modulos/pages/sintomas.php";break;
                case "cadTriSint":include "modulos/pages/cadTriSint.php"; break;
                case "cadtriagem":include "modulos/pages/cadtriagem.php";break;
                case "cadmedico":include "modulos/pages/cadmedico.php";break;
                case "cadsintomas":include "modulos/pages/cadsintomas.php";break;
                case "cadprofissional":include "modulos/pages/cadprofissional.php";break;
                case "listapacienteCla":include "modulos/pages/listapacienteCla.php";break;
                case "cadconsulta":include "modulos/pages/cadconsulta.php";break;
                case "sair":
                    include "modulos/pages/sair.php";break;
                // Caso o valor de 'rota' não corresponda a nenhuma das opções acima
                default:
                    include "modulos/pages/404.php";break;
            }
        } else {
            // Se 'rota' não for definida, carrega a página inicial
            include "modulos/pages/inicio.php";
        }
       //Roda Pé
        include "modulos/componentes/roda-pe.php";
        echo '</div>'; //Fechamento wrapper passado para dentro do php
    } else {
        include "modulos/pages/telalogin.php";
    }
    ?>
    <!-- ./wrapper -->
    <script src="views/js/template.js"></script>
    <script src="views/js/usuario.js"></script>
    <script src="views/js/paciente.js"></script>
    <script src="views/js/profissional.js"></script>
    <script src="views/js/sintoma.js"></script>
    <script src="views/js/TriSint.js"></script>
    <script src="views/js/consulta.js"></script>
    <script src="views/js/classificacao.js"></script>


</body>

</html>