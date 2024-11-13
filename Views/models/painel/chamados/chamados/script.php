<script>
    $(document).on('click', '.andamento', function() {
    var cd = $(this).attr('cd');
    $('#modalAndamento #cd').val(cd);

    var titulo = $(this).attr('titulo');
    $('#modalAndamento #Titulo').val(titulo);

    var descricao = $(this).attr('descricao');
    $('#modalAndamento #Descricao').val(descricao);

    var equipamento = $(this).attr('equipamento');
    $('#modalAndamento #Equipamento').val(equipamento);

    var status = $(this).attr('status');
    $('#modalAndamento #Status').val(status);

    var abertura = $(this).attr('abertura');
    $('#modalAndamento #Abertura').val(abertura);

    var usuario = $(this).attr('usuario');
    $('#modalAndamento #Usuario').val(usuario);
});

$(document).on('click', '.editar', function() {
    var cd = $(this).attr('cd');
    $('#modalEditar #cd').val(cd);

    var titulo = $(this).attr('titulo');
    $('#modalEditar #Titulo').val(titulo);

    var descricao = $(this).attr('descricao');
    $('#modalEditar #Descricao').val(descricao);

    var equipamento = $(this).attr('equipamento');
    $('#modalEditar select#Equipamento').val(equipamento);

    var status = $(this).attr('status');
    $('#modalEditar #Status').val(status);

    var abertura = $(this).attr('abertura');
    $('#modalEditar #Abertura').val(abertura);

    var usuario = $(this).attr('usuario');
    $('#modalEditar #Usuario').val(usuario);
});

$(document).on('click', '.concluir', function() {
    var cd = $(this).attr('cd');
    $('#modalConclusao #cd').val(cd);
    var titulo = $(this).attr('titulo');
    $('#modalConclusao #titulo').val(titulo);
});

$(document).on('click', '.deletar', function() {
    var cd = $(this).attr('cd');
    $('#deletar #cd').val(cd);
    var titulo = $(this).attr('titulo');
    $('#deletar #titulo').val(titulo);
});

</script>

