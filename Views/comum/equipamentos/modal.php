<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/salas/function.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/Reso/Views/comum/categoria/function.php';
?>

<!-- Modal Criar Equipamento -->
<div class="modal fade" id="addequipamento" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header">
                    <h5 class="modal-title">Criar Equipamento</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="nome" class="form-control" placeholder="Nome do Equipamento" required>
                    <br>
                    <textarea name="desc" class="form-control" placeholder="Descrição do Equipamento" required rows="2"></textarea>
                    <br>
                    <?php
                            $categorias = ListarCategorias("<input type='text' class='form-control' placeholder='Cadastre categorias, elas serão exibidas aqui' readonly>");
                            if($categorias->num_rows>0){
                    ?>
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="" selected>Selecione uma categoria</option>
                            <?php 
                            if($categorias){
                                foreach($categorias as $index => $l){
                                    $selected = ($l['cd_categoria'] == $categoriaSelecionada) ? 'selected' : '';
                        ?>
                        <option value="<?= $l['cd_categoria']?>" <?= $selected ?>><?=$l['categoria_nm']?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                    <?php }?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Fechar
                    </button>
                    <input type="submit" class="btn btn-success text-white" name="action" value="Criar">
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Editar Equipamento -->
<div class="modal fade" id="editar" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post" class="form-group">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Equipamento</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cd" id="cd">
                    <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do Equipamento"
                        required>
                    <br>
                    <input type="text" name="desc" id="desc" class="form-control" placeholder="Descrição do Equipamento"
                        required>
                    <br>
                    <select name="sala" id="sala" class="form-control">
                         <option value="" disabled>Selecione uma Sala</option>
                        <?php
                            $salas = ListarSalas();

                            if($salas){
                                foreach($salas as $index => $l){
                        ?>
                        <option value="<?= $l['cd_sala']?>"><?=$l['nm_sala']?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                    <br>
                    <?php
                            $categorias = ListarCategorias("<input type='text' class='form-control' placeholder='Cadastre categorias, elas serão exibidas aqui' readonly>");
                            if($categorias->num_rows>0){
                    ?>
                    <select name="categoria" id="categoria" class="form-control">
                        <option value="" disabled>Selecione uma categoria</option>
                            <?php 
                            if($categorias){
                                foreach($categorias as $index => $l){
                                    $selected = ($l['cd_categoria'] == $categoriaSelecionada) ? 'selected' : '';
                        ?>
                        <option value="<?= $l['cd_categoria']?>" <?= $selected ?>><?=$l['categoria_nm']?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                    <?php }?>
                    <br>
                    <select name="status" class="form-control">
                        <option value="Ativo">Ativo</option>
                        <option value="Manutenção">Manutenção</option>
                        <option value="Desativado">Desativado</option>
                    </select>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary" name="action" value="Editar">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deletar" data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Equipamento</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cd" id="cd">
                    <input type="text" name="nome" id="nome"class="form-control" placeholder="Nome do Equipamento" readonly>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-danger text-white" name="action" value="Deletar">
                </div>
            </form>
        </div>
    </div>
</div>