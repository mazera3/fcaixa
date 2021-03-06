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
                <h2 class="display-4 titulo">Editar Categoria</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_cat']) {
            ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-categoria/ver-categoria/' . $valorForm['id_cat']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="id_cat" type="hidden" value="<?php
                                                        if (isset($valorForm['id_cat'])) {
                                                            echo $valorForm['id_cat'];
                                                        }
                                                        ?>">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> categoria</label>
                        <input name="categoria" type="text" class="form-control" placeholder="Categoria" value="<?php
                                                                                                                if (isset($valorForm['categoria'])) {
                                                                                                                    echo $valorForm['categoria'];
                                                                                                                }
                                                                                                                ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> c??digo</label>
                        <input name="cod_cat" type="number" step="1" min="1" class="form-control" placeholder="C??digo" value="<?php
                                                                                                                if (isset($valorForm['cod_cat'])) {
                                                                                                                    echo $valorForm['cod_cat'];
                                                                                                                }
                                                                                                                ?>">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigat??rio
            </p>
            <input name="EditCat" type="submit" class="btn btn-warning" value="Atualizar">
        </form>
    </div>
</div>