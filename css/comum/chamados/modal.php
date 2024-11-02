<?php
    include_once '../equipamentos/function.php';
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
                    <input type="text" name="titulo" class="form-control" placeholder="Título do Chamado" required>
                    <br>
                    <textarea name="descricao" class="form-control" placeholder="Descrição do Problema" required rows="3"></textarea>
                    <br>
                    <select name="equipamento" class="form-control">
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
                    <input type="submit" class="btn btn-success text-white" name="action" value="Abrir">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para confirmar a mudança de status para "Em Andamento" com detalhes -->
<div class="modal fade" id="modalAndamento" tabindex="-1" role="dialog" aria-labelledby="modalAndamentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAndamentoLabel">Detalhes do Chamado</h5>
                </div>
                <div class="modal-body">
                    <!-- Detalhes do chamado com inputs form-control -->
                    <div class="form-group">
                        <label for="chamadoTitulo"><strong>Título</strong></label>
                        <input type="text" id="Titulo" class="form-control" name="titulo" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="chamadoDescricao"><strong>Descrição</strong></label>
                        <textarea id="Descricao" class="form-control" name="descricao" rows="3" readonly></textarea>
                    </div>

                    <div class="form-group mt-2">
                        <label for="chamadoEquipamento"><strong>Equipamento</strong></label>
                        <input type="text" id="Equipamento" class="form-control" name="equipamento" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="chamadoStatus"><strong>Status</strong></label>
                        <input type="text" id="Status" class="form-control" name="status" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="chamadoAbertura"><strong>Data de Abertura</strong></label>
                        <input type="text" id="Abertura" class="form-control" name="abertura" readonly>
                    </div>

                    <div class="form-group mt-2">
                        <label for="chamadoUsuario"><strong>Aberto por:</strong></label>
                        <input type="text" id="Usuario" class="form-control" name="usuario" readonly>
                    </div>

                    <input type="hidden" name="cd_chamado" id="cd">
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConclusaoLabel">Concluir Chamado</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="titulo" class="form-control "id="titulo" readonly>
                        <br>
                        <label for="recado"><strong>Deixe um Recado:</strong></label>
                        <textarea id="recado" class="form-control" name="recado" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="cd_chamado" id="cd">
                    
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletarLabel">Confirmar Deleção</h5>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja deletar este chamado?</p>
                    <input type="hidden" name="cd_chamado" id="cd">
                    <input type="text" name="titulo" id="titulo" class="form-control" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" name="action" value="DeletarChamado">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</div>