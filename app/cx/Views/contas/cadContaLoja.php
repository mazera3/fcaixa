<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastrar Conta Loja</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_loj']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'conta-loja/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
                </div>
            <?php
            }
            ?>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row" style="background-color: #cfcfaf;">
                <div class="col-md-4">
                    <!-- Valor -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Valor (R$)</label>
                        <input name="valor" type="number" min="0" step=".01" class="form-control" value="<?php if (isset($valorForm['valor'])) {
                                                                                                                echo $valorForm['valor'];
                                                                                                            } ?>">
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Mes -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Mês</label>
                        <select name="mes_id" id="mes" class="form-control">
                            <option>Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['mes'] as $m) {
                                extract($m);
                                if ($valorForm['mes_id'] == $id_mes) {
                                    echo "<option value='$id_mes' selected>$id_mes - $mes</option>";
                                } else {
                                    echo "<option value='$id_mes'>$id_mes - $mes</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Situação -->
                    <div class="form-group">
                        <label>Situação</label>
                        <select name="situacao" class="form-control">
                            <option value="0">0</option>
                            <option value="1" selected>1</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Observações -->
                    <div class="form-group">
                        <label>Observações</label>
                        <textarea name="observacao" class="form-control" rows="2"><?php if (isset($valorForm['observacao'])) {
                                                                                        echo $valorForm['observacao'];
                                                                                    } ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row" style="background-color: #afcfaf;">
                <div class="col-md-4">
                    <!-- Vencimento -->
                    <div class="form-group">
                        <label>Vencimento</label>
                        <input name="vencimento" type="date" class="form-control" value="<?php if (isset($valorForm['vencimento'])) {
                                                                                                echo $valorForm['vencimento'];
                                                                                            } ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- Codigo de Barras -->
                    <div class="form-group">
                        <label>Código de Barras</label>
                        <input name="codigo" type="text" class="form-control" placeholder="Código de barras" value="<?php if (isset($valorForm['codigo'])) {
                                                                                                                        echo $valorForm['codigo'];
                                                                                                                    } ?>">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadLoj" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>