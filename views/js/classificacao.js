$(".tabelas").on("click", ".btnEditarPaciente", function() {
    var idPaciente = $(this).attr("idPaciente");

    $.ajax({
        url: "ajax/classificacao.ajax.php",
        method: "POST",
        data: { idPaciente: idPaciente },
        dataType: "json",
        success: function(resposta) {
            console.log("Resposta AJAX:", resposta);

            if (resposta && resposta["nome"]) {
                $("#editarNomePaciente").val(resposta["nome"]);
                
                // Normaliza o valor (para bater com os valores do <select>)
                var risco = resposta["classificacao_risco"].toLowerCase().trim();
                risco = risco
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(" ", "-");

                $("#editarGrauRisco").val(risco);
                $("#idTriagem").val(resposta["id_triagem"]); // ✅ usa id_triagem
                $("#modalEditarPaciente").modal("show");
            } else {
                alert("Erro: paciente não encontrado!");
            }
        },
        error: function(xhr, status, error) {
            console.error("Erro AJAX:", error);
            console.log(xhr.responseText);
        }
    });

});
 $(document).on("click", ".btnExcluirClassificacao", function(e) {
    e.preventDefault();

    var idTriagem = $(this).data("id-triagem"); // pega data-id-triagem
    var nome = $(this).data("nome") || "";

    if (!idTriagem) {
      console.warn("idTriagem não encontrado no botão.");
      Swal.fire("Erro", "ID da triagem inválido.", "error");
      return;
    }

    Swal.fire({
      icon: "warning",
      title: "Tem certeza?",
      text: '"' + nome + '" será excluido.',
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Sim, inativar!"
    }).then((result) => {
      if (result.isConfirmed) {
        // redireciona para controller que processa inativação
        window.location.href = "index.php?rota=listapacienteCla&inativar=" + encodeURIComponent(idTriagem);
      }
    });
  });
