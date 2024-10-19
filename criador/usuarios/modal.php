<div class="modal fade" id="editar" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                EDITAR USUARIO
            </div>
            <div class="modal-body">
                <label for="cd" class="">Codigo do Usuario</label>
                <input type="text" name="cd" id="cd" class="form-control" rows="5" readonly></input>
                <br>
                <label for="nome" class="">Nome do Usuario</label>
                <input type="text" name="nome" id="nome" class="form-control" rows="5" readonly></input>
                <br>
                <select name="cargo" id="cargo" class="form-control" aria-label="Default select example">
                    <option value="comum">comum</option>
                    <option value="suporte">suporte</option>
                    <option value="admin">admin</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dimiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-primary text-white" name="action" value="Editar">
            </div>
        </form>
    </div>
</div>