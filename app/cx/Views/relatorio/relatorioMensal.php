<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (isset($this->Dados['listRelEnt'])) {
    foreach ($this->Dados['listRelEnt'] as $rl) {
        extract($rl);
    }
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Relatório Mensal <?php
                                                                if (isset($extenso)) {
                                                                    echo '('.$extenso . '/' . $ano .')';
                                                                }
                                                                ?></h2>
            </div>
            <?php
            if (isset($this->Dados['listSal'])) {
                foreach ($this->Dados['listSal'] as $s) {
                    extract($s);
                }
            }
            if (isset($this->Dados['somaEnt'])) {
                foreach ($this->Dados['somaEnt'] as $si) {
                    extract($si);
                }
            }
            if (isset($this->Dados['somaSai'])) {
                foreach ($this->Dados['somaSai'] as $so) {
                    extract($so);
                }
            }
            $saldo_atual = $total_entrada - $total_saida;
            ?>
            <div class="mr-auto p-2">
                <a href="<?php echo URLADM . 'relatorio-mensal/listar/?mes=' . $id_mes . '&ano=' . $ano . '&s=' . $saldo_atual . ''; ?>" class="btn btn-warning btn-sm">Atualizar Saldo Anterior</a>
            </div>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-print" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    if ($this->Dados['botao']['xls']) {
                        echo "<li><a href='" . URLADM . "relatorio-mensal/listar/?xls=1'>Baixar Relatório XLS</a></li> ";
                    }
                    if ($this->Dados['botao']['pdf']) {
                        echo "<li><a href='" . URLADM . "relatorio-mensal/listar/?pdf=1'>Baixar Relatório PDF</a></li> ";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        if (empty($this->Dados['listRelEnt']) and empty($this->Dados['listRelSai'])) {
        ?>
            <div class="alert alert-danger" role="alert">
                Nenhum relatório encontrado!
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
                        echo "<option value='$id_mes' selected>$extenso</option>";
                    } else {
                        echo "<option value='$id_mes'>$extenso</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" class="btn btn-dark btn-sm" value="Enviar">
        </form>
        <div class="table-responsive">
            <div class="row container">
                <!-- Entradas -->
                <div class="col">
                    <table class="table table-striped table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center alert alert-primary">ENTRADAS</th>
                            </tr>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_entrada_mes = 0;
                            foreach ($this->Dados['listRelEnt'] as $re) {
                                extract($re);
                                if ($situacao == 1) {
                                    $total_entrada_mes += $valor;
                                }
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($situacao == 1) {
                                            echo "<a href='" . URLADM . "relatorio-mensal/listar?id=$id_ent&rc=0'><span class='badge badge-pill badge-success'>Recebido</span></a>";
                                        } else {
                                            echo "<a href='" . URLADM . "relatorio-mensal/listar?id=$id_ent&rc=1'><span class='badge badge-pill badge-danger'>A Receber</span></a>";
                                        }
                                        ?>
                                    </td>
                                <?php
                            }
                                ?>
                                </tr>
                                <tr>
                                    <td>----------------------------------------</td>
                                    <td>------------------</td>
                                </tr>
                                <?php
                                if (isset($this->Dados['listSal'])) {
                                    foreach ($this->Dados['listSal'] as $sa) {
                                        extract($sa);
                                ?>
                                        <tr>
                                            <td class="alert alert-warning">Saldo Anterior <?php echo '(' . $extenso . '/' . $ano . ')'; ?></td>
                                            <td class="text-success"><?php echo 'R$ ' . number_format($saldo, 2, ',', '.'); ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td>----------------------------------------</td>
                                    <td>------------------</td>
                                </tr>
                                <tr>
                                    <td><b>Total de Entradas:</b></td>
                                    <td class="text-primary"><?php echo 'R$ ' . number_format($total_entrada_mes, 2, ',', '.'); ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Saídas -->
                <div class="col">
                    <table class="table table-striped table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center alert alert-primary">SAÍDAS</th>
                            </tr>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_saida_mes = 0;
                            foreach ($this->Dados['listRelSai'] as $rs) {
                                extract($rs);
                                if ($situacao == 1) {
                                    $total_saida_mes += $valor;
                                }
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($situacao == 1) {
                                            echo "<a href='" . URLADM . "relatorio-mensal/listar?id=$id_sai&pg=0'><span class='badge badge-pill badge-success'>Pago</span></a>";
                                        } else {
                                            echo "<a href='" . URLADM . "relatorio-mensal/listar?id=$id_sai&pg=1'><span class='badge badge-pill badge-danger' title='Vence: " . date('d/m/Y', strtotime($vencimento)) . "'>Pagar</span></a>";
                                        }
                                        ?>
                                    </td>
                                <?php
                            }
                                ?>
                                </tr>
                                <tr>
                                    <td>----------------------------------------</td>
                                    <td>------------------</td>
                                </tr>
                                <tr>
                                    <td><b>Total de Saídas:</b></td>
                                    <td class="text-danger"><?php echo 'R$ ' . number_format($total_saida_mes, 2, ',', '.');  ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered table-sm">
                <?php
                if (isset($saldo)) {
                    $saldo_mes = ($total_entrada_mes + $saldo - $total_saida_mes);
                    $saldo_rs = 'R$ ' . number_format($saldo_mes, 2, ',', '.');
                ?>
                    <tbody>
                        <tr style="background-color: #cccccc">
                            <td width="50%"><b>SALDO <?php if ($saldo_mes >= 0) {
                                                            echo "POSITIVO (+)";
                                                        } else {
                                                            echo "NEGATIVO (-)";
                                                        } ?></b></td>
                            <td width="50%"><?php if ($saldo_mes >= 0) {
                                                echo "<span class='text-primary'>$saldo_rs</span>";
                                            } else {
                                                echo "<span class='text-danger'>$saldo_rs</span>";
                                            }
                                        } ?></td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>
</div>