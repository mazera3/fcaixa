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
                <h2 class="display-4 titulo">Editar Classificação</h2>
            </div>

            <?php
            if ($this->Dados['botao']['list_class']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'classificacao/listar'; ?>" class="btn btn-outline-primary btn-sm">Listar</a>
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
            <input name="clas_id" type="hidden" value="<?php
            if (isset($valorForm['clas_id'])) {
                echo $valorForm['clas_id'];
            }
            ?>">
                <!-- Classificação -->
                    <div class="form-group col-sm-6">
                        <label>Classificação (nome)</label>
                        <input name="classificacao" type="text" class="form-control" placeholder="Classificação" value="<?php
                        if (isset($valorForm['classificacao'])) {
                            echo $valorForm['classificacao'];
                        }
                        ?>">
                    </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditClass" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>