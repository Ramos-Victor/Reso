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

