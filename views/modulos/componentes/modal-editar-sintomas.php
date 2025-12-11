<div id="modalEditarSintoma" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
       

        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Editar Sintoma</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="editarSintoma">Sintoma</label>
            <input type="text" class="form-control" name="editarNomeSintoma" id="editarNomeSintoma" required>
          </div>

          <div class="form-group">
            <label for="editarIndice">Índice de Urgência</label>
          <input type="number" class="form-control" name="editarIndiceUrgencia" id="editarIndiceUrgencia" required min="1" max="10">
          </div>
        </div>
        <input type="hidden" name="idSintoma" id="idSintoma" value="">

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar sintoma</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST["idSintoma"])) {
    $editarSintoma = new ControllerSintoma();
    $editarSintoma->ctrEditarSintoma();
}
?>