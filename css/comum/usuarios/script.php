<script>
$(document).on('click', '.editar', function() {
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var nome = $(this).attr('nome');
    $('.modal #nome').val(nome);
    var cargo = $(this).attr('cargo');
    $('.modal #cargo').val(cargo);
    var data = $(this).attr('data');
    $('.modal #data').val(data);
    $('.modal select option').each(function() {
        if ($(this).val() == cargo) {
            $(this).prop('selected', true);
        }
    });
});

$(document).on('click', '.deletar', function() {
    var cd = $(this).attr('cd');
    $('.modal #cd').val(cd);
    var nome = $(this).attr('nome');
    $('.modal #nome').val(nome);
    var cargo = $(this).attr('cargo');
    $('.modal #cargo').val(cargo);
    var data = $(this).attr('data');
    $('.modal #data').val(data);
});
</script>