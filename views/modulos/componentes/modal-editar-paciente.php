<div id="modalEditarPaciente" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
       

        <div class="modal-header bg-primary">
          <h4 class="modal-title text-white">Editar Paciente</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="editarPaciente">Nome do Paciente</label>
            <input type="text" class="form-control" name="editarNomePaciente" id="editarNomePaciente" readonly>
          </div>

          <div class="form-group">
            <label for="editarIndice">Grau de risco</label>
<select id="editarGrauRisco" name="editarGrauRisco" class="form-control select2 select2-danger" style="width: 100%;">
                <option value="vermelho">Emergencia</option>
                <option value="laranja">Muito urgente</option>
                 <option value="amarelo">Urgente</option>
                 <option value="verde">Pouco urgente</option>
                <option value="azul">Não urgente</option>

                </select>          </div>
        </div>
<input type="hidden" name="idTriagem" id="idTriagem" value="">


        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar paciente</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if (isset($_POST["idTriagem"])) {
    $editarPaciente = new ControllerClassificacao();
    $editarPaciente->ctrEditarPaciente();
}
?>
