$(document).ready(function () {

    // ======= Máscara conforme o tipo =======
    function aplicarMascaraDocumento(tipo) {
        const $doc = $('#docp');
        $doc.inputmask('remove'); // remove máscara antiga

        if (tipo === 'med') {
            $doc.attr("placeholder", "Ex: CRM/SP 123456");
            $doc.inputmask("CRM/[AA] 999999", {
                definitions: { 'A': { validator: "[A-Za-z]", casing: "upper" } },
                placeholder: "",
              
            });
        } else if (tipo === 'enf') {
            $doc.attr("placeholder", "Ex: Coren-SP-123456");
            $doc.inputmask("Coren-[AA]-999999", {
                definitions: { 'A': { validator: "[A-Za-z]", casing: "upper" } },
                placeholder: "",
              
            });
        } else if (tipo === 'adm' || tipo === 'rec') {
            $doc.attr("placeholder", "Ex: 123.456.789-00");
            $doc.inputmask("999.999.999-99", { placeholder: "_" });
        } else {
            $doc.attr("placeholder", "Digite o Documento");
        }
    }

    // ======= Validação de CPF =======
    function validarCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');
        if (cpf.length !== 11) return false;
        if (/^(\d)\1+$/.test(cpf)) return false;

        let soma = 0, resto;
        for (let i = 1; i <= 9; i++) soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.substring(9, 10))) return false;

        soma = 0;
        for (let i = 1; i <= 10; i++) soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.substring(10, 11))) return false;

        return true;
    }

    // ======= Método de validação personalizado =======
    $.validator.addMethod("docValido", function (value, element) {
        const tipo = $('#tipoProfissional').val();
        const val = $(element).inputmask('unmaskedvalue').trim();

        if (!val) return false; // campo vazio

        if (tipo === 'adm' || tipo === 'rec') {
            return validarCPF(val);
        }

        // Médico ou enfermeiro: só exige preenchimento
        if (tipo === 'med' || tipo === 'enf') {
            return val.length > 0;
        }

        return false; // se não escolher tipo
    }, "Documento inválido ou incompleto");

    // ======= Inicializa a máscara conforme o valor inicial =======
    const tipoInicial = $('#tipoProfissional').val();
    if (tipoInicial) aplicarMascaraDocumento(tipoInicial);

    // ======= Reaplica máscara ao mudar tipo =======
    $('#tipoProfissional').on('change', function () {
        aplicarMascaraDocumento($(this).val());
        $('#docp').val('');
        $('#docp').removeClass('is-invalid');
    });

    // ======= Validação geral do formulário =======
  $(document).ready(function () {
  // Ativa máscaras
  $("[data-inputmask]").inputmask();

  // Configura validação
  $("#quickForm").validate({
        rules: {
            nomep: { required: true },
            tipoProfissional: { required: true },
            docp: { required: true, docValido: true },
            senhap: { required: true, minlength: 8, maxlength: 8 }
        },
        messages: {
            nomep: "Por favor, insira o nome do profissional",
            tipoProfissional: "Por favor, selecione o cargo do profissional",
            docp: {
                required: "Por favor, insira o documento",
                docValido: "Documento inválido ou incompleto"
            },
            senhap: {
                required: "Por favor, insira uma senha",
                minlength: "A senha deve ter 8 caracteres",
                maxlength: "A senha deve ter 8 caracteres"
            }
        },
       errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");
      element.closest(".form-group").append(error);
    },
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },
    submitHandler: function (form) {
      // 🔹 Aqui vai o envio real se tudo estiver válido
      form.submit();
    }
  });

  // 🔹 Se o botão for clicado, força verificação de todos os campos
  $(".btn-primary").on("click", function (e) {
    if (!$("#quickForm").valid()) {
      e.preventDefault(); // impede envio se tiver erro
      
    }
  });
});

    // ======= Força revalidação ao sair do campo =======
    $('#docp').on('blur', function () {
        $(this).valid();
    });

});