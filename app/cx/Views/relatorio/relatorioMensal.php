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
                <h2 class="display-4 titulo">Relatório Mensal</h2>
            </div>
            <div class="btn-group dropleft">
                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="fas fa-print" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php
                    if ($this->Dados['botao']['xls']) {
                        echo "<li><a href='" . URLADM . "relatorio-anual/listar/?xls=1'>Baixar Relatório XLS</a></li> ";
                    }
                    if ($this->Dados['botao']['pdf']) {
                        echo "<li><a href='" . URLADM . "relatorio-anual/listar/?pdf=1'>Baixar Relatório PDF</a></li> ";
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
                                <th colspan="2" class="text-center">ENTRADAS</th>
                            </tr>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_entrada = 0;
                            foreach ($this->Dados['listRelEnt'] as $re) {
                                extract($re);
                                $total_entrada += $valor;
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?></td>
                                <?php
                            }
                                ?>
                                </tr>
                                <tr>
                                    <td>----------------------------------------</td>
                                    <td>------------------</td>
                                </tr>
                                <?php foreach ($this->Dados['listSal'] as $sa) {
                                    extract($sa);
                                ?>
                                    <tr>
                                        <td class="font-italic font-weight-bold">Saldo Anterior <?php echo '(' . $extenso . ')'; ?></td>
                                        <td class="text-success"><?php echo 'R$ ' . number_format($saldo, 2, ',', '.'); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td>----------------------------------------</td>
                                    <td>------------------</td>
                                </tr>
                                <tr>
                                    <td><b>Total de Entradas:</b></td>
                                    <td class="text-primary"><?php echo 'R$ ' . number_format($total_entrada, 2, ',', '.'); ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Saídas -->
                <div class="col">
                    <table class="table table-striped table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">SAÍDAS</th>
                            </tr>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_saida = 0;
                            foreach ($this->Dados['listRelSai'] as $rs) {
                                extract($rs);
                                $total_saida += $valor;
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo 'R$ ' . number_format($valor, 2, ',', '.'); ?></td>
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
                                    <td class="text-danger"><?php echo 'R$ ' . number_format($total_saida, 2, ',', '.');  ?></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered table-sm">
                <?php $saldo = ($total_entrada + $saldo - $total_saida);
                $saldo = 'R$ ' . number_format($saldo, 2, ',', '.');
                ?>
                <tbody>
                    <tr style="background-color: #cccccc">
                        <td width="50%"><b>SALDO <?php if ($saldo >= 0) {
                                                        echo "POSITIVO (+)";
                                                    } else {
                                                        echo "NEGATIVO (-)";
                                                    } ?></b></td>
                        <td width="50%"><?php if ($saldo >= 0) {
                                            echo "<span class='text-primary'>$saldo</span>";
                                        } else {
                                            echo "<span class='text-danger'>$saldo</span>";
                                        } ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>