<div id="modalEditarUsuario" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="editarUsuarios" value="1">
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">Editar usuário</h4>
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
                            <input type="text" class="form-control" id="editarNome" name="editarNome" value="" required>
                        </div>
                    </div>
                    <!-- Campo Usuário -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editarUsuario" name="editarUsuario" value="" required>
                        </div>
                    </div>
                    <!-- Campo Senha -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="editarSenha" placeholder="Nova Senha" maxlength="8" >
                        </div>
                    </div>
                    <!-- Campo Perfil -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-users"></i></span>
                            </div>
                            <select id="editarProf" name="editarProf" class="form-control select2 select2-danger" style="width: 100%;">
                 <option value="">--Selecione--</option>
                <option value="rec">Recepcionista</option>
                <option value="med">Médico(a)</option>
                 <option value="enf">Enfermeiro(a)</option>
                 <option value="adm">Administrador(a)</option>
                </select>
                        </div>
                    </div>
                    <!-- Campo Foto -->
                  <input type="hidden" id="loginAtual" name="loginAtual">
                  <input type="hidden" id="passwordAtual" name="passwordAtual">
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar usuário</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST["editarUsuarios"]) && $_POST["editarUsuarios"] == "1") {
    $editarUsuario  = new ControllerUsuarios();
    $editarUsuario->ctrEditarUsuario();
}
?>

