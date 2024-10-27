<div class="modal fade" id="addconexao" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Criar Conexão
            </div>
            <div class="modal-body">
                <input type="text" name="nome" class="form-control" rows="5" placeholder="Nome conexão" required></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn text-white" name="action" value="Criar" style="background-color:#03305c">
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="entrarconexao" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                Entrar na conexão
            </div>
            <div class="modal-body">
                <input type="text" name="code" class="form-control" placeholder="Digite o código da conexão que deseja entrar" required></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn text-white" name="action" value="Entrar" style="background-color:#03305c">
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="ver" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                VER CONEXÃO
            </div>
            <div class="modal-body">
                <label for="cd" class="">Codigo da conexão</label>
                <input type="text" name="cd" id="cd" class="form-control" rows="5" readonly></input>
                <br>
                <label for="nome" class="">Nome da conexão</label>
                <input type="text" name="nome" id="nome" class="form-control" rows="5" readonly></input>
                <br>
                <label for="cargo" class="">Cargo dentro da conexão</label>
                <input type="text" name="cargo" id="cargo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="codigo" class="">Codigo de acesso conexão</label>
                <input type="text" name="codigo" id="codigo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="data" class="">Data</label>
                <input type="text" name="data" id="data" class="form-control" rows="5" readonly></input>
                <br>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-primary copiar"
                        onclick="copiarTexto()"
                        title="copiar" data-dismiss="modal"
                        >
                            Copiar
                    </button>
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-success text-white" name="action" value="Acessar">
            </div>
        </form>
    </div>
    <script>
    function copiarTexto(){
        let textoCopiado = document.getElementById("codigo");
        textoCopiado.select();
        textoCopiado.setSelectionRange(0,99999);

        document.execCommand("copy");
    }
</script>
</div>

<div class="modal fade" id="sair" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                SAIR DA CONEXÃO
            </div>
            <div class="modal-body">
                <label for="cd" class="">Codigo da conexão</label>
                <input type="text" name="cd" id="cd" class="form-control" rows="5" readonly></input>
                <br>
                <label for="nome" class="">Nome da conexão</label>
                <input type="text" name="nome" id="nome" class="form-control" rows="5" readonly></input>
                <br>
                <label for="cargo" class="">Cargo dentro da conexão</label>
                <input type="text" name="cargo" id="cargo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="codigo" class="">Codigo de acesso conexão</label>
                <input type="text" name="codigo" id="codigo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="data" class="">Data</label>
                <input type="text" name="data" id="data" class="form-control" rows="5" readonly></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-danger text-white" name="action" value="Sair">
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="deletar" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                DELETAR CONEXÂO
            </div>
            <div class="modal-body">
                <label for="cd" class="">Codigo da conexão</label>
                <input type="text" name="cd" id="cd" class="form-control" rows="5" readonly></input>
                <br>
                <label for="nome" class="">Nome da conexão</label>
                <input type="text" name="nome" id="nome" class="form-control" rows="5" readonly></input>
                <br>
                <label for="cargo" class="">Cargo dentro da conexão</label>
                <input type="text" name="cargo" id="cargo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="codigo" class="">Codigo de acesso conexão</label>
                <input type="text" name="codigo" id="codigo" class="form-control" rows="5" readonly></input>
                <br>
                <label for="data" class="">Data</label>
                <input type="text" name="data" id="data" class="form-control" rows="5" readonly></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-danger text-white" name="action" value="Deletar">
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="editar" data-backdrop="static">
    <div class="modal-dialog modal-md div modal-content">
        <form method="post" enctype="multipart/form-data" class="form-group">
            <div class="modal-header">
                EDITAR CONEXÂO
            </div>
            <div class="modal-body">
                <label for="cd" class="">Codigo da conexão</label>
                <input type="text" name="cd" id="cd" class="form-control" rows="5" readonly></input>
                <br>
                <label for="nome" class="">Nome da conexão</label>
                <input type="text" name="nome" id="nome" class="form-control" rows="5" required></input>
                <br>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Fechar
                </button>
                <input type="submit" class="btn btn-primary text-white" name="action" value="Editar">
            </div>
        </form>
    </div>
</div>

