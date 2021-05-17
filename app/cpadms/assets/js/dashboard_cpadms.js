$(document).ready(function () {
    var conteudo = jQuery('.conteudo').attr("data-conteudo");
    if(typeof conteudo !== "undefined"){
        var pagina = 1; //página inicial    
        listar(pagina);
    }
});

function listar(pagina, varcomp = null) {
    var dados = {
        pagina: pagina
    };
    var enderecoList = jQuery('.enderecoList').attr("data-enderecoList");
    $.post(enderecoList + pagina + '?tiporesult=1', dados, function (retorna) {
        $("#conteudo").html(retorna);
    });
}

$(function () {
    //Verificado se o usuário digitou algum valor no campo
    $("#pesqUser").keyup(function () {
        var pesqUser = $(this).val();

        //Verificar se há valor na variável "pesqUser".
        if (pesqUser !== '') {
            var dados = {
                palavraPesq: pesqUser
            };
            var enderecoList = jQuery('.enderecoList').attr("data-enderecoList");
            $.post(enderecoList + '1?tiporesult=2', dados, function (retorna) {
                //Carregar o conteúdo para o usuário
                $("#conteudo").html(retorna);
            });
        } else {
            var pagina = 1; //página inicial    
            listar(pagina);
        }
    });
});

$(document).ready(function () {
    $(document).on('click', '.view_data', function () {
        var user_id = $(this).attr('id');
        //alert(user_id);
        if (user_id !== '') {
            var dados = {
                user_id: user_id
            };
            var endereco = jQuery('.endereco').attr('data-endereco');
            $.post(endereco + 'ver-usuario-modal/ver-usuario/' + user_id, dados, function (retorna) {
                //Carregar o conteúdo para o usuário
                $("#visul_usuario").html(retorna);
                $('#visulUsuarioModal').modal('show');
            });
        }
    });
});

//Cadastro genérico
$("#insert_form").on("submit", function (event) {
    event.preventDefault();

    var enderecocad = jQuery('.enderecocad').attr("data-enderecocad");
    //console.log(enderecocad);
    $.ajax({
        method: "POST",
        url: enderecocad,
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (retorna) {
            if (retorna['erro']) {
                //console.log(retorna);
                //console.log("Sucesso");
                //$('#msgCad').html(retorna['msg']);
                $('.addModal').modal('hide');
                $('#addSucessoModal').modal('show');
                listar(1);
            } else {
                //console.log(retorna);
                //console.log("Erro");
                $('#msgCad').html(retorna['msg']);
            }
        }
    });
});

//Carregar modal define para apagar
$(document).ready(function () {
    $('a[delete-confirm]').click(function (ev) {
        var href = $(this).attr('href');
        if (!$('#conf-delete').length) {
            $('body').append('<div class="modal fade" id="conf-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Apagar</a></div></div></div></div>');
        }
        $('#dataComfirmOK').attr('href', href);
        $('#conf-delete').modal({show: true});
        return false;
    });
});