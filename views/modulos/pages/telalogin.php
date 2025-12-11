<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="tudo/tudo.css">
</head>

<body>
    <div class="tela-login">
        <!-- Lado azul -->
        <div class="lado-azul">
            <div class="conteudo-azul">
                <img src="tudo/imgs/equipe-medica.png" alt="Ícone saúde">

                <h2>SAFESUS</h2>
            </div>
        </div>

        <!-- Lado cinza -->
        <div class="lado-cinza">
            <div class="conteudo-cinza">
                <h2>Bem-vindo(a)!</h2>
                <p>Para começar, nos diga quem está acessando:</p>

                <form id="quickForm" method="POST" class="formLogin">
                    <div class="form-group">
                        <label for="tipo">Cargo:</label>
                        <select id="tipo" name="tipo">
                            <option value="">--Selecione--</option>
                            <option value="rec">Recepcionista</option>
                            <option value="med">Médico(a)</option>
                            <option value="enf">Enfermeiro(a)</option>
                            <option value="adm">Administrador(a)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="ingUsuario">Documento:</label>
                        <input type="text" id="ingUsuario" name="ingUsuario" placeholder="Insira seu documento">
                    </div>

                    <div class="form-group">
    <label for="ingPassword">Senha:</label>
    <div class="senha-container">
        <input type="password" id="ingPassword" name="ingPassword" placeholder="Insira sua senha">
        <img src="tudo/imgs/icons8-visível-100.png" id="toggleSenha" class="toggle-senha" alt="Mostrar senha">
    </div>
</div>



                    <input type="submit" value="Entrar" class="btn">

                    <?php
                    $login = new ControllerUsuarios();
                    $login->ctrIngressoUsuario();
                    ?>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#quickForm').validate({
            rules: {
                tipo: { required: true },
                ingUsuario: { required: true },
                ingPassword: { required: true }
            },
            messages: {
                tipo: "Por favor, selecione seu cargo",
                ingUsuario: "Por favor, insira seu documento",
                ingPassword: "Por favor, insira sua senha"
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
    </script>
  <script>
const toggleSenha = document.getElementById('toggleSenha');
const senhaInput = document.getElementById('ingPassword');

toggleSenha.addEventListener('click', function() {
    if (senhaInput.type === 'password') {
        senhaInput.type = 'text';
        toggleSenha.src = 'tudo/imgs/icons8-invisível-100.png'; // ícone para "ocultar"
    } else {
        senhaInput.type = 'password';
        toggleSenha.src = 'tudo/imgs/icons8-visível-100.png'; // ícone para "mostrar"
    }
});
</script>



</body>
</html>
