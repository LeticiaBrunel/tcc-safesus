<?php
if (!isset($_SESSION)) {
    session_start();
}
$tipo = $_SESSION["tipo"] ?? '';
$nome = $_SESSION["nome"] ?? '';
$profissao = '';

switch ($tipo) {
    case 'adm':
        $profissao = 'Administrador';
        break;
    case 'rec':
        $profissao = 'Recepcionista';
        break;
    case 'enf':
        $profissao = 'Enfermeiro(a)';
        break;
    case 'med':
        $profissao = 'Médico(a)';
        break;
}
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #05136C;">

    <!-- Logo -->
    <a href="index.php" class="brand-link d-flex align-items-center">
        <img src="tudo/imgs/icons8-soma-48.png" alt="Logo" class="brand-image img-circle elevation-3" style="color: white;">
        <span class="brand-text font-weight-bold ml-2" style="color: white;">Hospital</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Painel do usuário -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="info" style="width: 100%;">
                <a href="#" class="d-block" style="color: white;">
                    <strong><?php echo $nome; ?></strong><br>
                    <small style="color: #d4d4d4;">
                        <?php
                        switch ($tipo) {
                            case 'adm': echo "Administrador(a)"; break;
                            case 'rec': echo "Recepcionista"; break;
                            case 'enf': echo "Enfermeiro(a)"; break;
                            case 'med': echo "Médico(a)"; break;
                        }
                        ?>
                    </small>
                </a>

                <!-- Linha hr de ponta a ponta com animação de brilho -->
                <hr style="
                    border: none;
                    height: 2px;
                    background: linear-gradient(
                        90deg,
                        rgba(255,255,255,0.2) 0%,
                        rgba(255,255,255,0.8) 50%,
                        rgba(255,255,255,0.2) 100%
                    );
                    background-size: 200% 100%;
                    animation: shine 2.5s linear infinite;
                    width: calc(100% + 30px);
                    margin: 10px -15px 0 -15px;
                ">
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <?php if (in_array($tipo, ["adm", "rec", "enf", "med"])): ?>
                <!-- PACIENTE -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" style="color: white;">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Paciente<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php if (in_array($tipo, ["adm", "rec"])): ?>
                        <li class="nav-item">
                            <a href="cadpaciente" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastro de Paciente</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (in_array($tipo, ["adm", "enf"])): ?>
                        <li class="nav-item">
                            <a href="listapaciente" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de Paciente</p>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (in_array($tipo, ["adm", "med"])): ?>
                        <li class="nav-item">
                            <a href="listapacienteCla" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de Paciente Classificados</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if (in_array($tipo, ["adm", "med"])): ?>
                <!-- SINTOMAS -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" style="color: white;">
                        <i class="fas fa-notes-medical nav-icon"></i>
                        <p>Sintomas<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="cadsintomas" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastro de Sintomas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="sintomas" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de Sintomas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <?php if ($tipo === "adm"): ?>
                <!-- PROFISSIONAIS -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link" style="color: white;">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>Profissionais<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="cadprofissional" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastro de Profissional</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="cadmedico" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastro de Medico</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="usuario" class="nav-link" style="color: white;">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lista de Profissionais</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</aside>

<!-- Animação CSS para o efeito shine na linha -->
<style>
@keyframes shine {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}
</style>
