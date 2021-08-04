<?php
if (!defined('URL')) {
    header("Loconion: /");
    exit();
}
//var_dump($this->Dados['listCon']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Contas</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_con']) {
                    echo "<a href='" . URLADM . "cadastrar-conta/cad-conta' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listCon'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma conta encontrada!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered table-sm">
                <thead>
                    <tr style="background-color: #acac;">
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Contas</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listCon'] as $con) {
                        extract($con);
                    ?>
                        <tr>
                            <th><?php echo $id_con; ?></th>
                            <td><?php echo $conta; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['ger_con']) {
                                        echo "<a href='" . URLADM . "gerar-conta/gerar/$id_con' class='btn btn-warning btn-sm' data-confirm-criar='Tem certeza de que deseja criar a conta selecionada?'>Gerar Conta</a> ";
                                    }
                                    if ($this->Dados['botao']['del_con']) {
                                        echo "<a href='" . URLADM . "apagar-conta/apagar-conta/$id_con' class='btn btn-danger btn-sm ml-4' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
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
</div>