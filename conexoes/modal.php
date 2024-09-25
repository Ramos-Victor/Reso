<div class="modal fade" id="addconexao" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Criar Conexão
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control" rows="5" placeholder="Nome conexão"></input>
                <br>
                <input type="text" name="code" class="form-control" rows="5" placeholder="Código de acesso conexão"></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn text-white" name="action" value="Criar" style="background-color:#03305c">
            </div>
        </form>
    </div>
</div>