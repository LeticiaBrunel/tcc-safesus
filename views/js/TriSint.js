function inicializarAutocomplete() {
  $(".sint").autocomplete({
    source: function (request, response) {
      $.ajax({
        url: "ajax/sintomas.ajax.php",
        dataType: "json",
        data: { term: request.term },
        success: function (data) {
          response(data);
        },
      });
    },
    minLength: 2,
    select: function (event, ui) {
      $(this).val(ui.item.value);
      $(this).closest(".sintoma-select").find(".id_sintoma").val(ui.item.id);
      return false;
    },
  });
}

function reindexarSintomas() {
  $("#sintoma-container .sintoma-select").each(function (index) {
    const sint = $(this).find(".sint");
    if (sint.length) {
      sint.attr("name", "sint[" + index + "]").removeAttr("required");
    }
    const idSint = $(this).find(".id_sintoma");
    if (idSint.length) {
      idSint.attr("name", "id_sintoma[" + index + "]");
    }
  });
}

function adicionarSintoma() {
  const container = $("#sintoma-container");
  const primeiro = container.find(".sintoma-select:first").clone(false, false);

  primeiro.find("input").val("");
  primeiro.find(".is-invalid").removeClass("is-invalid");
  primeiro.find(".invalid-feedback").remove();

  if (!primeiro.find(".campo-sintoma").length) {
    const campos = primeiro.find(".sint, .id_sintoma");
    campos.wrapAll('<div class="campo-sintoma" style="flex: 1;"></div>');
  }

  primeiro.find(".sint").removeAttr("required");

  if (!primeiro.find(".btn-remove-sintoma").length) {
    primeiro.append(`
      <button type="button" class="btn btn-danger btn-remove-sintoma" title="Remover sintoma">
        <i class="fas fa-trash"></i>
      </button>
    `);
  }

  container.append(primeiro);
  reindexarSintomas();
  inicializarAutocomplete();

  // Atualiza validação para todos os campos
  $("#sintoma-container .sint").each(function () {
    const $input = $(this);
    const $container = $input.closest(".campo-sintoma");

    $input.rules("remove");
    $container.find("span.invalid-feedback").remove();
    $input.removeClass("is-invalid");

    $input.rules("add", {
     /* required: true,
      messages: {
        required: "Por favor, selecione um sintoma",
      },*/
    });
  });
}

let validator;

$(document).ready(function () {
  $("#sintoma-container .sint").removeAttr("required");
  inicializarAutocomplete();
  reindexarSintomas();

  validator = $("#quickForm").validate({
    ignore: "[readonly]",
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback d-block");
      const container = $(element).closest(".campo-sintoma");

      // Remove a mensagem de erro anterior SEM CONDICIONAL (sempre remove para evitar duplicação)
      container.find("span.invalid-feedback").remove();

      container.append(error);
    },
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
      const container = $(element).closest(".campo-sintoma");
      container.find("span.invalid-feedback").remove();
    }
  });

  // Regras iniciais
  $("#sintoma-container .sint").each(function () {
    $(this).rules("remove");
    $(this).rules("add", {
      required: true,
      messages: {
        required: "Por favor, selecione um sintoma",
      },
    });
  });

  $(document).on("click", ".btn-add-sintoma", function () {
    adicionarSintoma();
  });

  $(document).on("click", ".btn-remove-sintoma", function () {
    const container = $(this).closest(".sintoma-select");
    container.remove();
    reindexarSintomas();

    $("#sintoma-container .sint").each(function () {
      const $input = $(this);
      const $container = $input.closest(".campo-sintoma");

      $container.find("span.invalid-feedback").remove();
      $input.removeClass("is-invalid");

      $input.rules("remove");
      $input.rules("add", {
        required: true,
        messages: {
          required: "Por favor, selecione um sintoma",
        },
      });
    });
  });

  $("form#quickForm").on("submit", function (e) {
  reindexarSintomas();

  let vazio = false;
  $("#sintoma-container .sint").each(function () {
    if (!$(this).val().trim()) {
      vazio = true;
      $(this).addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid");
    }
  });

  $(".alert-sintoma").remove();
 
  if (vazio) {
    e.preventDefault();
    $("#sintoma-container").after(`
      <div class="alert alert-danger alert-sintoma">
        Por favor, selecione pelo menos um sintoma antes de continuar.
      </div>
    `);
  }
});

    // Limpa erros antigos antes de validar
    $("#sintoma-container .sint").each(function () {
      const $input = $(this);
      const $container = $input.closest(".campo-sintoma");

      $input.rules("remove");
      $container.find("span.invalid-feedback").remove();
      $input.removeClass("is-invalid");

    
      $input.rules("add", {
       /* required: true,
        messages: {
          required: "Por favor, selecione um sintoma",
        },*/
      });
    });

    if (!$("#quickForm").valid()) {
      e.preventDefault();

      const firstErr = $(this).find(".is-invalid:first");
      if (firstErr.length) firstErr.focus();
    }
  });