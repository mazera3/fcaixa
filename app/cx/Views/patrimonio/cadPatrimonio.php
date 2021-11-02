<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastrar Patrimonio</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_pat']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'patrimonio/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <div class="row">
                <div class="col-md-6">
                    <!-- descrição -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Patrimonio</label>
                        <input name="patrimonio" type="text" class="form-control" placeholder="Patrimonio" value="<?php
                                                                                                                    if (isset($valorForm['patrimonio'])) {
                                                                                                                        echo $valorForm['patrimonio'];
                                                                                                                    }
                                                                                                                    ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Valor</label>
                        <input name="valor" type="number" step=".01" class="form-control" placeholder="valor" value="<?php
                                                                                                                        if (isset($valorForm['valor'])) {
                                                                                                                            echo $valorForm['valor'];
                                                                                                                        }
                                                                                                                        ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Imóvel</label>
                        <select name="cod_pat" id="cod_pat" class="form-control">
                            <option>Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['imv'] as $imv) {
                                extract($imv);
                                if ($valorForm['cod_pat'] == $id_imv) {
                                    echo "<option value='$id_imv' selected>$imovel</option>";
                                } else {
                                    echo "<option value='$id_imv'>$imovel</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadPat" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>