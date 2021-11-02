<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Patrimonio</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_pat']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-patrimonio/ver-patrimonio/' . $valorForm['id_pat']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="id_pat" type="hidden" value="<?php
                                                        if (isset($valorForm['id_pat'])) {
                                                            echo $valorForm['id_pat'];
                                                        }
                                                        ?>">
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
                        <label><span class="text-danger">*</span> Categoria do Imóvel</label>
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
            <input name="EditPat" type="submit" class="btn btn-warning" value="Atualizar">
        </form>
    </div>
</div>