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
                <h2 class="display-4 titulo">Listar Saidas</h2>
            </div>
            <div class="mr-auto p-2">
                <form method="GET" action="">
                    <label>Ano</label>
                    <?php $a = date('Y') - 1; ?>
                    <?php $b = date('Y') ?>
                    <?php $c = date('Y') + 1; ?>
                    <?php $d = date('Y') + 2; ?>
                    <?php $e = date('Y') + 3; ?>
                    <select name="ano" id="ano">
                        <?php
                        echo "<option value='$a'>$a</option>";
                        echo "<option value='$b' selected>$b</option>";
                        echo "<option value='$c'>$c</option>";
                        echo "<option value='$d'>$d</option>";
                        echo "<option value='$e'>$e</option>";
                        ?>
                    </select>
                    <label>Mês</label>
                    <select name="mes" id="mes">
                        <option>Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['mes'] as $m) {
                            extract($m);
                            if ($mes_id == $id_mes) {
                                echo "<option value='$id_mes' selected>$mes</option>";
                            } else {
                                echo "<option value='$id_mes'>$mes</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" class="btn btn-warning btn-sm" value="Enviar">
                </form>
            </div>
            <div class="p-2">
                <?php
                echo "<a href='" . URLADM . "saida/listar?all=1' class='btn btn-outline-primary btn-sm'>Listar Todos</a> ";
                ?>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_sai']) {
                    echo "<a href='" . URLADM . "cadastrar-saida/cad-saida' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listSai'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma Saida encontrada!
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
                    foreach ($this->Dados['listSai'] as $sai) {
                        extract($sai);
                    ?>
                        <tr>
                            <th><?php echo $id_sai; ?></th>
                            <td><?php echo $descricao; ?></td>
                            <td><?php echo $categoria; ?></td>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $mes . '/' . $ano; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_sai']) {
                                        echo "<a href='" . URLADM . "ver-saida/ver-saida/$id_sai' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_sai']) {
                                        echo "<a href='" . URLADM . "editar-saida/edit-saida/$id_sai' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_sai']) {
                                        echo "<a href='" . URLADM . "apagar-saida/apagar-saida/$id_sai' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_sai']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-saida/ver-saida/$id_sai'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_sai']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-saida/edit-saida/$id_sai'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_sai']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-saida/apagar-saida/$id_sai' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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