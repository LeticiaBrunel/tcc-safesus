<!--MODAL ADICIONAR USUARIO-->

<div id="modalAdicionarUsuario" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="criarUsuario" value="1">
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Adicionar usuário</h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Campo Nome -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="novoNome" placeholder="Nome" required>
                        </div>
                    </div>
                    <!-- Campo Usuário -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" name="novoUsuario" placeholder="Usuário" required>
                        </div>
                    </div>
                    <!-- Campo Senha -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="novaSenha" placeholder="Senha" required>
                        </div>
                    </div>
                    <!-- Campo Perfil -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-users"></i></span>
                            </div>
                            <select class="form-control" name="novoPerfil">
                                <option value="">Selecionar perfil</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Direcao">Direção</option>
                                <option value="Comite">Comitê Organizacional</option>
                                <option value="Jurado">Jurado</option>
                                <option value="Lider">Líder de Equipe</option>
                                <option value="Publico">Público/Auditoria</option>
                            </select>
                        </div>
                    </div>
                    <!-- Campo Foto -->
                  
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST["criarUsuario"]) && $_POST["criarUsuario"] == "1") {
    $criarUsuario = new ControllerUsuarios();
    $criarUsuario->ctrCriarUsuario();
}
?>

