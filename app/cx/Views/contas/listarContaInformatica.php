<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
foreach ($this->Dados['listInf'] as $inf) {
    extract($inf);
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Conta Informática</h2>
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
                $total_informatica = 0;
                foreach ($this->Dados['listInf'] as $inf) {
                    extract($inf);
                    if ($situacao == 1) {
                        $total_informatica += $valor;
                    }
                }
                if (isset($ano)) {
                    echo "<a href='" . URLADM . "conta-informatica/listar?ms=$mes_id&an=$ano&inf=$total_informatica' class='btn btn-outline-danger btn-sm'>Atualizar Conta Informatica</a> ";
                }
                ?>
            </div>
            <div class="p-2">
                <?php
                echo "<a href='" . URLADM . "conta-informatica/listar?all=1' class='btn btn-outline-primary btn-sm'>Listar Todos</a> ";
                ?>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_inf']) {
                    echo "<a href='" . URLADM . "cadastrar-conta-informatica/cad-conta' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listInf'])) {
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
                        <th class="d-none d-sm-table-cell" width="40%">Observação</th>
                        <th class="d-none d-sm-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listInf'] as $inf) {
                        extract($inf);
                    ?>
                        <tr>
                            <th><?php echo $id_inf; ?></th>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $mes . '/' . $ano; ?></td>
                            <td><?php echo strftime('%d/%b/%Y', strtotime($vencimento)); ?></td>
                            <td><?php echo $observacao; ?></td>
                            <td class="text-center">
                                <?php
                                if ($situacao == 1) {
                                    echo "<a href='" . URLADM . "conta-informatica/listar?id=$id_inf&pg=0'><span class='badge badge-pill badge-success'>Pago</span></a>";
                                } else {
                                    echo "<a href='" . URLADM . "conta-informatica/listar?id=$id_inf&pg=1'><span class='badge badge-pill badge-danger'>A Pagar</span></a>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_inf']) {
                                        echo "<a href='" . URLADM . "ver-conta-informatica/ver-conta/$id_inf' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_inf']) {
                                        echo "<a href='" . URLADM . "editar-conta-informatica/edit-conta/$id_inf' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_inf']) {
                                        echo "<a href='" . URLADM . "apagar-conta-informatica/apagar-conta/$id_inf' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_inf']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-conta-informatica/ver-conta/$id_inf'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_inf']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-conta-informatica/edit-conta/$id_inf'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_inf']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-conta-informatica/apagar-conta/$id_inf' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            <h3><?php if(isset($extenso)){echo 'Total: R$ ' . number_format($total_informatica, 2, ',', '.') .' (' . $extenso . ')';} ?></h3>
            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>