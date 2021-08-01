<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
foreach ($this->Dados['listAgr'] as $agr) {
    extract($agr);
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Conta Agropecuaria</h2>
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
                $total_agropecuaria = 0;
                foreach ($this->Dados['listAgr'] as $agr) {
                    extract($agr);
                    if ($situacao == 1) {
                        $total_agropecuaria += $valor;
                    }
                }
                if (isset($ano)) {
                    echo "<a href='" . URLADM . "conta-agropecuaria/listar?ms=$mes_id&an=$ano&agr=$total_agropecuaria' class='btn btn-outline-danger btn-sm'>Atualizar Conta Agropecuaria</a> ";
                }
                ?>
            </div>
            <div class="p-2">
                <?php
                echo "<a href='" . URLADM . "conta-agropecuaria/listar?all=1' class='btn btn-outline-primary btn-sm'>Listar Todos</a> ";
                ?>
            </div>
            <div class="p-2">
                <?php
                if ($this->Dados['botao']['cad_agr']) {
                    echo "<a href='" . URLADM . "cadastrar-conta-agropecuaria/cad-conta' class='btn btn-outline-success btn-sm'>Cadastrar</a> ";
                }
                ?>
            </div>

        </div>
        <?php

        if (empty($this->Dados['listAgr'])) {
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
                    foreach ($this->Dados['listAgr'] as $agr) {
                        extract($agr);
                    ?>
                        <tr>
                            <th><?php echo $id_agr; ?></th>
                            <td><?php echo $valor; ?></td>
                            <td><?php echo $mes . '/' . $ano; ?></td>
                            <td><?php echo date('d/M/Y', strtotime($vencimento)); ?></td>
                            <td><?php echo $observacao; ?></td>
                            <td class="text-center">
                                <?php
                                if ($situacao == 1) {
                                    echo "<a href='" . URLADM . "conta-agropecuaria/listar?id=$id_agr&pg=0'><span class='badge badge-pill badge-success'>Pago</span></a>";
                                } else {
                                    echo "<a href='" . URLADM . "conta-agropecuaria/listar?id=$id_agr&pg=1'><span class='badge badge-pill badge-danger'>A Pagar</span></a>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_agr']) {
                                        echo "<a href='" . URLADM . "ver-conta-agropecuaria/ver-conta/$id_agr' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_agr']) {
                                        echo "<a href='" . URLADM . "editar-conta-agropecuaria/edit-conta/$id_agr' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_agr']) {
                                        echo "<a href='" . URLADM . "apagar-conta-agropecuaria/apagar-conta/$id_agr' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_agr']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "ver-conta-agropecuaria/ver-conta/$id_agr'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_agr']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "editar-conta-agropecuaria/edit-conta/$id_agr'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_agr']) {
                                            echo "<a class='dropdown-item' href='" . URLADM . "apagar-conta-agropecuaria/apagar-conta/$id_agr' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            <h3><?php if(isset($extenso)){echo 'Total: R$ ' . number_format($total_agropecuaria, 2, ',', '.') .' (' . $extenso . ')';} ?></h3>
            <?php
            echo $this->Dados['paginacao'];
            ?>
        </div>
    </div>
</div>