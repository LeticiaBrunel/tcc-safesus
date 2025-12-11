document.addEventListener("DOMContentLoaded", function () {

    // ==============================
    // Exclusão de paciente
    // ==============================
    document.querySelectorAll(".btnExcluirPaciente").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const id = this.getAttribute("idPaciente");
            const nome = this.getAttribute("nome");

            Swal.fire({
                icon: "warning",
                title: "Tem certeza que deseja excluir este paciente?",
                text: `"${nome}" será excluído.`,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, excluir!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?rota=listapaciente&inativar=" + id;
                }
            });
        });
    });

    // ==============================
    // Validações personalizadas
    // ==============================

    // Validador de CPF
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }
        let resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(cpf.charAt(9))) return false;

        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;

        return resto === parseInt(cpf.charAt(10));
    }

    // Validador de Data de Nascimento
    function validarDataNascimento(data) {
        const regex = /^\d{2}\/\d{2}\/\d{4}$/;
        if (!regex.test(data)) return false;

        const partes = data.split('/');
        const dia = parseInt(partes[0], 10);
        const mes = parseInt(partes[1], 10) - 1;
        const ano = parseInt(partes[2], 10);

        const dataObj = new Date(ano, mes, dia);
        const hoje = new Date();

        return dataObj &&
            dataObj.getDate() === dia &&
            dataObj.getMonth() === mes &&
            dataObj.getFullYear() === ano &&
            dataObj <= hoje &&
            ano > 1900;
    }

    // Validador de CNS (Cartão SUS)
    function isCnsValid(cns) {
    if (!cns) return false;
    cns = String(cns).replace(/\D/g, '');
    if (cns.length !== 15) return false;
    const first = cns.charAt(0);
    // CNS provisório
    if (["7","8","9"].includes(first)) {
        let sum = 0;
              for (let i = 0; i < 15; i++) sum += parseInt(cns[i],10) * (15-i);
        return sum % 11 === 0;
    }
    // CNS definitivo
    if (["1","2"].includes(first)) {
        let pis = cns.substring(0,11);
        let sum = 0;
        for (let i = 0; i < 11; i++) sum += parseInt(pis[i],10) * (15-i);
        let rest = sum % 11;
        let dv = 11 - rest;
        if (dv === 11) dv = 0;
        let sufixo = "000";
        if (dv === 10) {
            sufixo = "001";
            pis = (parseInt(pis,10) + 1).toString().padStart(11,'0');
            sum = 0;
            for (let i = 0; i < 11; i++) sum += parseInt(pis[i],10) * (15-i);
            rest = sum % 11;
            dv = 11 - rest;
            if (dv === 11) dv = 0;
        }
        let cnsRecon = pis + sufixo + dv;
        return cnsRecon === cns;
    }
    return false;
}
// Adiciona método ao jQuery Validate para CNS
$.validator.addMethod("validarCNS", function(value, element) {
    if (this.optional(element)) return true;
    let numeros = String(value).replace(/\D/g, '');
    if (numeros.length !== 15) return false;
    return isCnsValid(numeros);
}, "CNS inválido");
    // ==============================
    // Configuração do jQuery Validate
    // ==============================
    $(document).ready(function () {

        // Adiciona métodos personalizados
        $.validator.addMethod("cpfValido", function (value, element) {
            return this.optional(element) || validarCPF(value);
        }, "CPF inválido");

        $.validator.addMethod("dataNascimentoValida", function (value, element) {
            return this.optional(element) || validarDataNascimento(value);
        }, "Data de nascimento inválida");

        $.validator.addMethod("cnsValido", function (value, element) {
            return this.optional(element) || validarCNS(value);
        }, "Documento do SUS inválido");


    });
    


});
