
/*EDITAR USUARIO*/
$(".tabelas").on("click", ".btnEditarUsuario", function(){
	var idUsuario = $(this).attr("idUsuario");
	var dados = new FormData();
	dados.append("idUsuario", idUsuario);
	$.ajax({
		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: dados,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(resposta){
  $("#editarNome").val(resposta["nome"]);
 $("#editarUsuario").val(resposta["login"]);
$("#loginAtual").val(resposta["login"]);
$("#editarProf").val(resposta["tipo"]);
$("#passwordAtual").val(resposta["senha"]);

  // Atualiza o select de perfil
  $("#editarPerfil").html('<option value="'+resposta["tipo"]+'">'+resposta["tipo"]+'</option>');

  $('#modalEditarUsuario').modal('show');
}
	});
})	

/*ATIVAR USUARIO*/
$(".tabelas").on("click", ".btnAtivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var dados = new FormData();
	dados.append("ativarId", idUsuario);
	dados.append("ativarUsuario", estadoUsuario);

  	$.ajax({
	  url:"ajax/usuarios.ajax.php",
	  method: "POST",
	  data: dados,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(resposta){
      		if(window.matchMedia("(max-width:767px)").matches){
				Swal.fire({
					icon: "success",
					title: "Usuário Atualizado",
					showConfirmButton: true,
					confirmButtonText: "Fechar"
				});
	      	}
      }
  	})
  	if(estadoUsuario == "0"){
  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desativado');
  		$(this).attr('estadoUsuario',1);
  	}else{
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Ativado');
  		$(this).attr('estadoUsuario',0);
  	}
})

/*EXCLUIR USUARIO*/
$(".tabelas").on("click", ".btnExcluirUsuario", function(){
  var idUsuario = $(this).attr("idUsuario");
  var usuario = $(this).attr("usuario");

  Swal.fire({
    icon: "warning",
    title: "Tem certeza que deseja excluir usuário?",
    text: `"${usuario}" será excluído.`,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Sim, excluir usuário!'
  }).then(function(result){
    if(result.value){
      // Corrigido para o parâmetro certo
      window.location = "index.php?rota=usuario&inativar=" + idUsuario;
    }
  });
});




