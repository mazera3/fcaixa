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
                <h2 class="display-4 titulo">Editar Cópia</h2>
            </div>

            <?php
            if ($this->Dados['botao']['list_copia']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'copias/listar'; ?>" class="btn btn-outline-primary btn-sm">Listar</a>
                </div>
                <?php
            }
            ?>

        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data"> 
            <input name="cop_id" type="hidden" value="<?php
            if (isset($valorForm['cop_id'])) {
                echo $valorForm['cop_id'];
            }
            ?>">
            <!-- descricao -->
            <div class="form-group col-sm-6">
                <label>Descricao</label>
                <input name="descricao" type="text" class="form-control" placeholder="descricao" value="<?php
                if (isset($valorForm['descricao'])) {
                    echo $valorForm['descricao'];
                }
                ?>">
            </div>
            <!-- cod_bar -->
            <div class="form-group col-sm-6">
                <label>Codigo de Barras</label>
                <input name="cod_bar" type="text" class="form-control" placeholder="código de barras" value="<?php
                if (isset($valorForm['cod_bar'])) {
                    echo $valorForm['cod_bar'];
                }
                ?>">
            </div>
            <!-- sit_copia -->
            <div class="form-group col-sm-6">
                <label>Situação da Cópia</label>
                <select name="sit_copia" id="sit_copia" class="form-control">
                    <option value="">Selecione</option>
                    <?php
                    foreach ($this->Dados['select']['stc'] as $s) {
                        extract($s);
                        if ($valorForm['sit_copia'] == $stc_id) {
                            echo "<option value='$stc_id' selected>$nome_stc</option>";
                        } else {
                            echo "<option value='$stc_id'>$nome_stc</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditCopia" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>