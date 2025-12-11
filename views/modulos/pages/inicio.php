
  <style>
    /* Cabeçalho */
.content-header h1 {
  font-size: 35px;
  font-weight: 600;
}

.content-header .emoji {
  font-size: 28px;
}


.date-info {
  color: #0033cc;
  font-size: 15px;
}

.date-info .status {
  color: #333;
}

/* Card principal */
.info-box {
  border: 1px solid #000000ff;
  overflow: hidden;
  position: relative;
  transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.3s ease;
  background-color: #fff;
  width: 65%;
  height: 350px; 
  display: flex;
  flex-direction: column; 
  justify-content: center;
  align-items: center;
  cursor: pointer;
  text-align: center;
  font-family: sans-serif;
}

/* Imagem centralizada */
.info-box img {
  width: 170px;
  height: 170px;
  object-fit: contain;
  margin: 10px auto 50px auto;
  display: block;
}

/* Texto */
.info-box-text {
  font-size: 35px;
  font-weight: 600;
  color: #000;
  margin-top: 10px;
}

/* Hover */
.info-box:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 30px rgba(0, 0, 0, 0.2);
  background-color: #f8f9fa;
}

/* Efeito ripple */
.ripple {
  position: relative;
  overflow: hidden;
}

.ripple::after {
  content: "";
  position: absolute;
  width: 5px;
  height: 5px;
  background: rgba(0, 0, 0, 0.2);
  display: block;
  border-radius: 50%;
  transform: scale(0);
  opacity: 1;
  transition: transform 0.6s ease, opacity 1s ease;
}

.ripple:active::after {
  transform: scale(25);
  opacity: 0;
  transition: 0s;
}

/* Espaçamento entre colunas */
.col-md-4 {
  display: flex;
  justify-content: center;
  margin-bottom: 25px;
}
.info-box {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 40px; /* espaço entre os cards */
  margin-top: 40px;
}
  .content-header{
    padding: 45px;
  }


  </style>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Conteúdo principal -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <h1 style="color: black; font-weight: bold; font-family:sans-serif;">
        Olá, <small style="color: black; font-weight: bold; font-family:sans-serif;">
          <?php
          // Exibe tipo de usuário
          switch ($tipo) {
              case 'adm': echo "Administrador(a)"; break;
              case 'rec': echo "Recepcionista"; break;
              case 'enf': echo "Enfermeiro(a)"; break;
              case 'med': echo "Médico(a)"; break;
          }
          ?>
        </small>
        <span class="emoji">👋</span>
      </h1>

      <!-- Mensagem personalizada -->
      <?php if (isset($_SESSION['nome'])): ?>
        <p style="font-size:23px; color:#555; margin-top:4px; font-family:sans-serif;">
          Bem-vindo(a), <strong><?php echo htmlspecialchars($_SESSION['nome']); ?></strong>!
        </p>
      <?php endif; ?>

    <p class="date-info" id="dataAtual"style="font-size:20px;"> • <span class="status">Sistema ativo</span></p>
    </div>
  </section>


    <section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Card Paciente -->
      <?php if (in_array($tipo, ['adm', 'med', 'enf', 'rec'])): ?>
      <div class="col-md-4">
        <?php
        // Define a função do botão Paciente conforme tipo
        switch($tipo){
            case 'adm': $pacienteLink = 'cadpaciente'; break;
            case 'med': $pacienteLink = 'listapacienteCla'; break;
            case 'enf': $pacienteLink = 'listapaciente'; break;
            case 'rec': $pacienteLink = 'cadpaciente'; break;
        }
        ?>
        <a href="<?php echo $pacienteLink; ?>" class="info-box ripple" style="color: black; text-decoration: none;">
          <div class="info-box-content">
            <span class="info-box-text">
              <?php echo ($tipo == 'rec') ? ' Paciente' : 'Pacientes'; ?>
            </span>
          </div>
        <img src="tudo\imgs\homem-usuario.png" alt="Logo"  >        
      </a>
      </div>
      <?php endif; ?>

      <!-- Card Profissionais (somente admin) -->
      <?php if ($tipo == 'adm'): ?>
      <div class="col-md-4">
        <a href="cadprofissional" class="info-box ripple" style="color: black; text-decoration: none;">
          <div class="info-box-content">
            <span class="info-box-text">Profissionais</span>
          </div>
      <img src="tudo\imgs\equipe-medica (1).png" alt="Logo" >        

        </a>
      </div>
      <?php endif; ?>

      <!-- Card Sintomas (admin e médico) -->
      <?php if (in_array($tipo, ['adm', 'med'])): ?>
      <div class="col-md-4">
        <?php
        $sintomasLink = ($tipo == 'med') ? 'cadsintomas' : 'cadsintomas';
        ?>
        <a href="<?php echo $sintomasLink; ?>" class="info-box ripple" style="color: black; text-decoration: none;">
          <div class="info-box-content">
            <span class="info-box-text">Sintomas</span>
          </div>
<img src=" tudo\imgs\sintomas (1).png " alt="Logo" >  
        </a>
      </div>
      <?php endif; ?>

    </div>
  </div>
</section>


  </div>


<script>
  // Função para formatar a data em português (ex: 31 de Outubro, 2025)
  function formatarDataHoje() {
    const hoje = new Date();
    const opcoes = { day: '2-digit', month: 'long', year: 'numeric' };
    return hoje.toLocaleDateString('pt-BR', opcoes);
  }

  // Inserir a data atual no elemento com id="dataAtual"
  document.getElementById('dataAtual').innerHTML = 
    `${formatarDataHoje()} • <span class="status">Sistema ativo</span>`;
</script>

