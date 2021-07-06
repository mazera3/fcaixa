<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['form']);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastrar Descricao</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_des']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'descricao/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                        <label><span class="text-danger">*</span> Descricao</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição" value="<?php
                                                                                                                if (isset($valorForm['descricao'])) {
                                                                                                                    echo $valorForm['descricao'];
                                                                                                                }
                                                                                                                ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            <option value="1">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['cat'] as $cat) {
                                extract($cat);
                                if ($valorForm['categoria_id'] == $id_cat) {
                                    echo "<option value='$id_cat' selected>$categoria</option>";
                                } else {
                                    echo "<option value='$id_cat'>$categoria</option>";
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
            <input name="CadDes" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>