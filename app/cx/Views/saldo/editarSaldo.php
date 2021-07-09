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
                <h2 class="display-4 titulo">Editar Saldo</h2>
            </div>

            <?php
            if ($this->Dados['botao']['list_sal']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'saldo/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <input name="id_sal" type="hidden" value="<?php
                                                        if (isset($valorForm['id_sal'])) {
                                                            echo $valorForm['id_sal'];
                                                        }
                                                        ?>">
            <div class="row">
                <div class="col-md-6">
                    <!-- saldo -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Saldo</label>
                        <input name="saldo" type="number" step=".01" class="form-control" placeholder="Valor" value="<?php
                                                                                                                        if (isset($valorForm['saldo'])) {
                                                                                                                            echo $valorForm['saldo'];
                                                                                                                        }
                                                                                                                        ?>">
                    </div>
                </div>
                <div class="col-md-4">
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
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Ano</label>
                        <select name="ano" id="ano" class="form-control">
                            <option>Selecione</option>
                            <?php if (isset($valorForm['ano'])) { 
                                echo "<option value='{$valorForm['ano']}' selected>{$valorForm['ano']}</option>" ; 
                                } ?>
                            <option value='2020'>2020</option>
                            <option value='2021'>2021</option>
                            <option value='2022'>2022</option>
                        </select>
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditSal" type="submit" class="btn btn-warning" value="Atualizar">
        </form>
    </div>
</div>