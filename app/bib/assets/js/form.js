var cont = 1;
//https://api.jquery.com/click/
$('#add-campo').click(function () {
    cont++;
    //https://api.jquery.com/append/
$('#formulario').append('<div class="form-group" id="campo' + cont + '">\n\
<fieldset class="border border-secondary"><legend>Campos</legend>\n\
<div class="row"><div class="col-sm-3"><label>Campo:</label></div><div class="col-sm-9">\n\
<select name="campo[]" class="custom-select">\n\
<option value="" selected></option>\n\
<option value="245">245 - TÍTULO PRINCIPAL (NR)</option>\n\
<option value="100">100 - ENTRADA PRINCIPAL - NOME PESSOAL (NR)</option>\n\
<option value="020">020 - ISBN - INTERNATIONAL STANDARD BOOK NUMBER (R)</option>\n\
</select></div></div>\n\
<div class="row"><div class="col-sm-3"><label>Indicadores:</label></div><div class="col-sm-3">\n\
<select name="ind1[]" class="custom-select">\n\
<option value="" selected></option>\n\
<option value="#">#</option>\n\
<option value="0">0</option>\n\
<option value="1">1</option>\n\
<option value="2">2</option>\n\
<option value="3">3</option>\n\
<option value="4">4</option>\n\
<option value="5">5</option>\n\
<option value="6">6</option>\n\
<option value="7">7</option>\n\
<option value="8">8</option>\n\
<option value="9">9</option>\n\
</select></div><div class="col-sm-3">\n\
<select name="ind2[]" class="custom-select">\n\
<option value="" selected></option>\n\
<option value="#">#</option>\n\
<option value="0">0</option>\n\
<option value="1">1</option>\n\
<option value="2">2</option>\n\
<option value="3">3</option>\n\
<option value="4">4</option>\n\
<option value="5">5</option>\n\
<option value="6">6</option>\n\
<option value="7">7</option>\n\
<option value="8">8</option>\n\
<option value="9">9</option>\n\
</select></div></div><div class="row"><div class="col-sm-3"><label>Subcampos:</label></div><div class="col-sm-9">\n\
<textarea name="subcampos[]" class="form-control" id="" rows="2"></textarea>\n\
</div></div>\n\
</fieldset>\n\
<button type="button" id="' + cont + '" class="btn-apagar text-danger"> Excluir Campo </button></div>');
});

$('form').on('click', '.btn-apagar', function () {
    var button_id = $(this).attr("id");
    $('#campo' + button_id + '').remove();
});
/*
$("#CadAulas").click(function () {
    //Receber os dados do formulário
    var dados = $("#add-aula").serialize();
    $.post(" ", dados, function (retorna) {
        $("#msg").slideDown('slow').html(retorna);

        //Limpar os campos
        //$('#add-aula')[0].reset();

        //Apresentar a mensagem leve
        retirarMsg();
    });
//Retirar a mensagem após 1700 milissegundos
    function retirarMsg() {
        setTimeout(function () {
            $("#msg").slideUp('slow', function () {});
        }, 2700);
    }
});
 * */