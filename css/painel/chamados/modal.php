<?php
    include_once './equipamentos/function.php';
?>

<!-- Modal Criar Chamado -->
<div class="modal fade" id="abrirChamado" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header">
                    <h5 class="modal-title">Abrir Chamado</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="titulo" class="form-control mb-2" placeholder="Título do Chamado" required>
                    <textarea name="descricao" class="form-control mb-2" placeholder="Descrição do Problema" required rows="3"></textarea>
                    <select name="equipamento" class="form-control mb-2">
                        <option value="" selected>Selecione um Equipamento (opcional)</option>
                        <?php
                            $equipamentos = ListarEquipamentos();
                            foreach ($equipamentos as $equipamento) {
                        ?>
                        <option value="<?= $equipamento['cd_equipamento'] ?>"><?= $equipamento['nm_equipamento'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" name="action" value="Abrir">Abrir Chamado</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para confirmar a mudança de status para "Em Andamento" com detalhes -->
<div class="modal fade" id="modalAndamento" tabindex="-1" role="dialog" aria-labelledby="modalAndamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAndamentoLabel">Detalhes do Chamado</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><strong>Título</strong></label>
                        <input type="text" id="Titulo" class="form-control" name="titulo" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Descrição</strong></label>
                        <textarea id="Descricao" class="form-control" name="descricao" rows="3" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <label><strong>Equipamento</strong></label>
                        <input type="text" id="Equipamento" class="form-control" name="equipamento" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Status</strong></label>
                        <input type="text" id="Status" class="form-control" name="status" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Data de Abertura</strong></label>
                        <input type="text" id="Abertura" class="form-control" name="abertura" readonly>
                    </div>
                    <div class="form-group">
                        <label><strong>Aberto por:</strong></label>
                        <input type="text" id="Usuario" class="form-control" name="usuario" readonly>
                    </div>
                    <input type="hidden" name="cd" id="cd">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning" name="action" value="EmAndamento">Confirmar Andamento</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalConclusao" tabindex="-1" role="dialog" aria-labelledby="modalConclusaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConclusaoLabel">Concluir Chamado</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="titulo" class="form-control mb-2" id="titulo" readonly>
                    <label for="recado"><strong>Deixe um Recado:</strong></label>
                    <textarea id="recado" class="form-control" name="recado" rows="3" required></textarea>
                    <input type="hidden" name="cd" id="cd">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" name="action" value="ConcluirChamado">Concluir Chamado</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletar" tabindex="-1" role="dialog" aria-labelledby="deletarLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletarLabel">Confirmar Deleção</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja deletar este chamado?</p>
                    <input type="hidden" name="cd" id="cd">
                    <input type="text" name="titulo" id="titulo" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</div>
