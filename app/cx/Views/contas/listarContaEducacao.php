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
                <h2 class="display-4 titulo">Conta Educacao</h2>
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
                            if (date('m') == $id_mes) {
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
                $total_educacao = 0;
                foreach ($this->Dados['listEdu'] as $edu) {
                    extract($edu);
                    if ($situacao == 1) {
                        $total_educacao += $valor;
                    }
                }
                if (isset($ano)) {
                    echo "<a href='" . URLADM . "conta-educacao/listar?ms=$mes&an=$ano&edu=$total_educacao' class='btn btn-outline-danger btn-sm'>Atualizar Conta Educacao</a> ";
                }
                ?>
            </div>
            <div class="p-2">
                <?php
                echo "<a href='" . URLADM . "conta-educacao/listar?all=1' class='btn btn-outline-primary btn-sm'>Listar Todos</a> ";
                ?>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_edu']) {
                    echo "<a href='" . URLADM . "cadastrar-conta-educacao/cad-conta' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listEdu'])) {
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
                        <th class="d-none d-sm-table-cell">Valor</th>
                        <th class="d-none d-sm-table-cell">Data</th>
                        <th class="d-none d-sm-table-cell">Vencimento</th>
                        <th class="d-none d-sm-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listEdu'] as $edu) {
                        extract($edu);
                    ?>
                        <tr>
                            <th><?php echo $id_edu; ?></th>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $mes . '/' . $ano; ?></td>
                            <td><?php echo date('d/M/Y', strtotime($vencimento)); ?></td>
                            <td class="text-center">
                                <?php
                                if ($situacao == 1) {
                                    echo "<a href='" . URLADM . "conta-educacao/listar?id=$id_edu&pg=0'><span class='badge badge-pill badge-success'>Pago</span></a>";
                                } else {
                                    echo "<a href='" . URLADM . "conta-educacao/listar?id=$id_edu&pg=1'><span class='badge badge-pill badge-danger'>A Pagar</span></a>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_edu']) {
                                        echo "<a href='" . URLADM . "ver-conta-educacao/ver-conta/$id_edu' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_edu']) {
                                        echo "<a href='" . URLADM . "editar-conta-educacao/edit-conta/$id_edu' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_edu']) {
                                        echo "<a href='" . URLADM . "apagar-conta-educacao/apagar-conta/$id_edu' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_edu']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-conta-educacao/ver-conta/$id_edu'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_edu']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-conta-educacao/edit-conta/$id_edu'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_edu']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-conta-educacao/apagar-conta/$id_edu' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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