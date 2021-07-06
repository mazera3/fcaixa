<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Entradas</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_ent']) {
                    echo "<a href='" . URLADM . "cadastrar-entrada/cad-entrada' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>
            
        </div>
        <?php
        
        if (empty($this->Dados['listEnt'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma descrição encontrada!
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
                        <th class="d-none d-sm-table-cell">Categoria</th>
                        <th class="d-none d-sm-table-cell">Valor</th>
                        <th class="d-none d-sm-table-cell">Mês</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listEnt'] as $ent) {
                        extract($ent);
                    ?>
                        <tr>
                            <th><?php echo $id_ent; ?></th>
                            <td><?php echo $descricao; ?></td>
                            <td><?php echo $categoria; ?></td>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $mes .'/'. $ano; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_ent']) {
                                        echo "<a href='" . URLADM . "ver-entrada/ver-entrada/$id_ent' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_ent']) {
                                        echo "<a href='" . URLADM . "editar-entrada/edit-entrada/$id_ent' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_ent']) {
                                        echo "<a href='" . URLADM . "apagar-entrada/apagar-entrada/$id_ent' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_ent']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-entrada/ver-entrada/$id_ent'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_ent']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-entrada/edit-entrada/$id_ent'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_ent']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-entrada/apagar-entrada/$id_ent' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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