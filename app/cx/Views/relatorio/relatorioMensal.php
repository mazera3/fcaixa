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
            <input type="submit" class="btn btn-warning btn-sm" value="Enviar">
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
                            foreach ($this->Dados['listRelEnt'] as $re) {
                                extract($re);
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo $valor; ?></td>
                                <?php
                            }
                                ?>
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
                            foreach ($this->Dados['listRelSai'] as $rs) {
                                extract($rs);
                            ?>
                                <tr>
                                    <td><?php echo $descricao; ?></td>
                                    <td><?php echo $valor; ?></td>
                                <?php
                            }
                                ?>
                                </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
</div>