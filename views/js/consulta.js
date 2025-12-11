
$(function() {
  // Inicializa o autocomplete do médico (mantém aqui, pois precisa do DOM pronto)
  $("#medico").autocomplete({
    source: function(request, response) {
      $.ajax({
        url: "ajax/consulta.ajax.php",
        dataType: "json",
        data: { term: request.term },
        success: function(data) {
          response($.map(data, function(item) {
            return {
              label: item.label,
              value: item.value,
              id: item.id_medico
            };
          }));
        }
      });
    },
    minLength: 1,
    select: function(event, ui) {
      $("#medico").val(ui.item.value);
      $("#id_medico").val(ui.item.id);
      return false;
    }
  });
});

// Validação manual no submit (fora de $(function()) para isolamento)
$(document).ready(function() {
  $("#quickForm").on("submit", function(e) {
    var isValid = true;

    // Limpa erros anteriores
    $(".invalid-feedback").remove();
    $(".is-invalid").removeClass("is-invalid");

    // Verifica cada campo obrigatório
    if (!$("#diaConsulta").val().trim()) {
      $("#diaConsulta").addClass("is-invalid").after('<span class="invalid-feedback">Por favor, insira o diagnóstico</span>');
      isValid = false;
    }
    if (!$("#recConsulta").val().trim()) {
      $("#recConsulta").addClass("is-invalid").after('<span class="invalid-feedback">Por favor, insira a receita</span>');
      isValid = false;
    }
    if (!$("#obsConsulta").val().trim()) {
      $("#obsConsulta").addClass("is-invalid").after('<span class="invalid-feedback">Por favor, insira as observações</span>');
      isValid = false;
    }
    if (!$("#encaminhamento").val().trim()) {
      $("#encaminhamento").addClass("is-invalid").after('<span class="invalid-feedback">Por favor, insira o encaminhamento</span>');
      isValid = false;
    }
    if (!$("#medico").val().trim()) {
      $("#medico").addClass("is-invalid").after('<span class="invalid-feedback">Por favor, insira o nome do médico</span>');
      isValid = false;
    }

    // Se inválido, impede o submit
    if (!isValid) {
      e.preventDefault();
    }
  });
});
