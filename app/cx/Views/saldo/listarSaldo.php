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
                <h2 class="display-4 titulo">Listar Saldo Mensal</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_sal']) {
                    echo "<a href='" . URLADM . "cadastrar-saldo/cad-saldo' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listSal'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhum saldo encontrado!
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
                        <th class="d-none d-sm-table-cell">Saldo</th>
                        <th class="d-none d-sm-table-cell">Mês</th>
                        <th class="d-none d-sm-table-cell">Criado</th>
                        <th class="d-none d-sm-table-cell">Modificado</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listSal'] as $sal) {
                        extract($sal);
                    ?>
                        <tr>
                            <th><?php echo $id_sal; ?></th>
                            <td><?php echo $saldo; ?></td>
                            <td><?php echo $mes_id . '/' . $ano; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></td>
                            <td><?php
                                if (!empty($modified)) {
                                    echo date('d/m/Y H:i:s', strtotime($modified));
                                }
                                ?></td>

                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['edit_sal']) {
                                        echo "<a href='" . URLADM . "editar-saldo/edit-saldo/$id_sal' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_sal']) {
                                        echo "<a href='" . URLADM . "apagar-saldo/apagar-saldo/$id_sal' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['edit_sal']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-saldo/edit-saldo/$id_sal'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_sal']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-saldo/apagar-saldo/$id_sal' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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