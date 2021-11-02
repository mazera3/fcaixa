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
                <h2 class="display-4 titulo">Cadastrar Categoria de Imóvel</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_imv']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'cat-imovel/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                <div class="col-md-4">
                    <!-- categoria -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span>Categoria do Imovel</label>
                        <input name="imovel" type="text" class="form-control" placeholder="casa, terreno, etc..." value="<?php
                                                                                                                            if (isset($valorForm['imovel'])) {
                                                                                                                                echo $valorForm['imovel'];
                                                                                                                            }
                                                                                                                            ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <!-- descrição -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span>Descrição da Categoria</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição da categoria" value="<?php
                                                                                                                                if (isset($valorForm['descricao'])) {
                                                                                                                                    echo $valorForm['descricao'];
                                                                                                                                }
                                                                                                                                ?>">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadImv" type="submit" class="btn btn-warning" value="Cadastrar">
        </form>
    </div>
</div>