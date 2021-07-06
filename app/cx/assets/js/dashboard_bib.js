$(document).ready(function () {
    var conteudo = jQuery('.conteudo').attr("data-conteudo");
    if (typeof conteudo !== "undefined") {
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
// visualizar usuario modal
$(document).ready(function () {
    $(document).on('click', '.view_data', function () {
        var user_id = $(this).attr('id');
        //alert(user_id);
        if (user_id !== '') {
            var dados = {
                user_id: user_id
            };
            var endereco = jQuery('.endereco').attr("data-endereco");
            $.post(endereco + user_id, dados, function (retorna) {
                //Carregar o conteúdo para o usuário
                $("#visul_usuario").html(retorna);
                $('#visulUsuarioModal').modal('show');
            });
        }
    });
});
// apagar usuario modal
$(document).ready(function () {
    $(document).on('click', 'del_data', function () {
        var user_id = $(this).attr('id');
        //alert(user_id);
        $.post('../../biblivre/apagar-usuario-modal/apagar-usuario/' + user_id, function (retorna) {
            alert(user_id);
            //$('#visulUsuarioModal').modal('show');
        });
    });
});
//Cadastro genérico 1
$("#insert_form_1").on("submit", function (event) {
    event.preventDefault();

    var enderecocad_1 = jQuery('.enderecocad_1').attr("data-enderecocad_1");
    //console.log(enderecocad);
    $.ajax({
        method: "POST",
        url: enderecocad_1,
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (retorna) {
            if (retorna['erro']) {
                //console.log(retorna);
                //console.log("Sucesso");
                //$('#msgCad').html(retorna['msg']);
                $('.addModal_1').modal('hide');
                $('#addSucessoModal_1').modal('show');
                listar(1);
            } else {
                //console.log(retorna);
                //console.log("Erro");
                $('#msgCad_1').html(retorna['msg']);
            }
        }
    });
});

//Cadastro genérico 2
$("#insert_form_2").on("submit", function (event) {
    event.preventDefault();

    var enderecocad_2 = jQuery('.enderecocad_2').attr("data-enderecocad_2");
    //console.log(enderecocad);
    $.ajax({
        method: "POST",
        url: enderecocad_2,
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (retorna) {
            if (retorna['erro']) {
                //console.log(retorna);
                //console.log("Sucesso");
                //$('#msgCad').html(retorna['msg']);
                $('.addModal_2').modal('hide');
                $('#addSucessoModal_2').modal('show');
                listar(1);
            } else {
                //console.log(retorna);
                //console.log("Erro");
                $('#msgCad_2').html(retorna['msg']);
            }
        }
    });
});
