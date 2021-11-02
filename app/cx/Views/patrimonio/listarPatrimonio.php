<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
$soma = 0;
foreach ($this->Dados['listPat'] as $pat) {
    extract($pat);
    $soma += $valor;
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Bens Patrimoniais</h2>
            </div>
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo"><?php echo 'Total: R$ ' . number_format($soma, 2, ',', '.'); ?></h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_pat']) {
                    echo "<a href='" . URLADM . "cadastrar-patrimonio/cad-patrimonio' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listPat'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma patrimonio encontrada!
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
                    <tr>
                        <th>ID</th>
                        <th class="d-none d-sm-table-cell">Descrição</th>
                        <th class="d-none d-sm-table-cell">Valor</th>
                        <th class="d-none d-sm-table-cell">Tipo de Imóvel</th>
                        <th class="d-none d-sm-table-cell">Ano Venal</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listPat'] as $pat) {
                        extract($pat);
                    ?>
                        <tr>
                            <th><?php echo $id_pat; ?></th>
                            <td><?php echo $patrimonio; ?></td>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $imovel; ?></td>
                            <td><?php echo $ano; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_pat']) {
                                        echo "<a href='" . URLADM . "ver-patrimonio/ver-patrimonio/$id_pat' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_pat']) {
                                        echo "<a href='" . URLADM . "editar-patrimonio/edit-patrimonio/$id_pat' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_pat']) {
                                        echo "<a href='" . URLADM . "apagar-patrimonio/apagar-patrimonio/$id_pat' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_pat']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-patrimonio/ver-patrimonio/$id_pat'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_pat']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-patrimonio/edit-patrimonio/$id_pat'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_pat']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-patrimonio/apagar-patrimonio/$id_pat' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>