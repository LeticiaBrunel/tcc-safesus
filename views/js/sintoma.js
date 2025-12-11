document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btnExcluirSintoma").forEach(function (botao) {
        botao.addEventListener("click", function () {
            const id = this.getAttribute("idSintoma");
            const sintoma = this.getAttribute("sintoma");

            Swal.fire({
                icon: "warning",
                title: "Tem certeza que deseja excluir este sintoma?",
                text: `"${sintoma}" será excluído.`,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, excluir!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php?rota=sintomas&inativar=" + id;
                }
            });
        });
    });
});

$(".tabelas").on("click", ".btnEditarSintoma", function(){
    var idSintoma = $(this).attr("idSintoma");
    $.ajax({
        url:"ajax/sintomas.ajax.php",
        method: "POST",
        data: { idSintoma: idSintoma }, // objeto simples
        dataType: "json",
        success: function(resposta){
            $("#editarNomeSintoma").val(resposta["sintomas"]);
            $("#editarIndiceUrgencia").val(resposta["indice_urgencia"]);
            $("#idSintoma").val(resposta["id_sintomas"]);
            $("#modalEditarSintoma").modal("show");
        }
    });
});

