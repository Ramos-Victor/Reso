<script>
$(document).on('click', '.editar', function() {
    var cd = $(this).attr('cd');
    $('#cd').val(cd);
    
    var nome = $(this).attr('nome');
    $('#nome').val(nome);
    
    var desc = $(this).attr('desc');
    $('#desc').val(desc);
    
    var sala = $(this).attr('sala');
    $('.modal#editar select#sala').val(sala); 

    var categoria = $(this).attr('categoria');
    $('.modal#editar select#categoria').val(categoria); 
    
    var status = $(this).attr('status');
    $('.modal #status').val(status);
    $('.modal option').each(function() {
        if ($(this).val() == status) {
            $(this).prop('selected', true);
        }
    });
});

$(document).on('click', '.deletar', function() {
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var nome = $(this).attr('nome');
    $('.modal #nome').val(nome);
});

$(document).on('click', '.ver', function() {
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var nome = $(this).attr('nome');
    $('.modal #nome').val(nome);
    var desc = $(this).attr('desc');
    $('.modal #desc').val(desc);
    var status = $(this).attr('status');
    $('.modal #status').val(status);
    var data = $(this).attr('data');
    $('.modal #data').val(data);
});
</script>
