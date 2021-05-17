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
                <h2 class="display-4 titulo">Cadastrar Classificação</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_pais']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'pais/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <div class="form-row col-md-6">
                <label><span class="text-danger">*</span> Classificação</label>
                <input name="classificacao" type="text" class="form-control" placeholder="Classificação" value="<?php
                if (isset($valorForm['classificacao'])) {
                    echo $valorForm['classificacao'];
                }
                ?>">
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadClass" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
