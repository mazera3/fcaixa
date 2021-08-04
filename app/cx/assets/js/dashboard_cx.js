//Carregar modal define para criar
$(document).ready(function () {
    $('a[data-confirm-criar]').click(function (ev) {
        var href = $(this).attr('href');
        if (!$('#confirm-criar').length) {
            $('body').append('<div class="modal fade" id="confirm-criar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">CRIAR CONTA<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja criar a conta selecionada?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Criar</a></div></div></div></div>');
        }
        $('#dataComfirmOK').attr('href', href);
        $('#confirm-criar').modal({ show: true });
        return false;
    });
});