<div class="row">
    <div class="col-sm-12 mb-2" id="cor_orm_pesquisa">
        <form class="form" method="POST" name="pesq_copia" id="form_pesquisa" action="">
            <div class="row">
                <div class="col-sm-6">
                    <div class = "form-group form-control-sm">
                        <div class = "form-group">
                            <label>Localizar Código de Barras</label>
                            <input name="cod_bar" type="text" id="cod_bar" class="form-control" placeholder="Código de Barras" value="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <input name="PesqCopia" type="submit" class="btn btn-primary btn-sm mt-2" value="Pesquisar">
                </div>     
        </form>
    </div>
</div>
<!-- fim do formulario -->
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th class="d-none d-sm-table-cell">Código de Barras</th>
                    <th class="d-none d-lg-table-cell">Situação</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($this->Dados['listCopia'] as $copia) {
                    extract($copia);
                    ?>
                    <tr>
                        <th><?php echo $cop_id; ?></th>
                        <td class="d-none d-sm-table-cell"><?php echo $cod_bar; ?></td>
                        <td class="d-none d-lg-table-cell">
                            <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_stc; ?></span>
                        </td>
                        <td class="text-center">
                            <span class="d-none d-md-block">
                                <?php
                                if ($this->Dados['botao']['ret_copia']) {
                                    echo "<a href='" . URLADM . "retirar-copia/retirar-copia/$cop_id' class='btn btn-outline-primary btn-sm'>Retirar</a> ";
                                }
                                if ($this->Dados['botao']['ret_copia']) {
                                    echo "<a href='" . URLADM . "retirar-copia/retirar-copia/$cop_id' class='btn btn-outline-danger btn-sm'>Devolver</a> ";
                                }
                                ?>
                            </span>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
if (empty($this->Dados['listCopia'])) {
    ?>
    <div class="alert alert-danger" role="alert">
        Nenhuma cópia encontrada!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
