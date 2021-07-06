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
                <h2 class="display-4 titulo">Cadastrar Categoria</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_cat']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'categoria/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <div class="row">
                <div class="col-md-6">
                    <!-- descrição -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> categoria</label>
                        <input name="categoria" type="text" class="form-control" placeholder="Categoria" value="<?php
                        if (isset($valorForm['categoria'])) {
                            echo $valorForm['categoria'];
                        }
                        ?>">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadCat" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>
