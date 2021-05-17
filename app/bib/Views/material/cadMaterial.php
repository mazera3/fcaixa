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
                <h2 class="display-4 titulo">Cadastrar Material</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_mat']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'material/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <div class="form-row">
                <div class="col-sm-6">
                    <!-- Descricao -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Material (descrição)</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição do Material" value="<?php
                        if (isset($valorForm['descricao'])) {
                            echo $valorForm['descricao'];
                        }
                        ?>">
                    </div>
                    <!-- Flag -->
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Flag</label>
                        <select name="flag" id="flag" class="form-control">
                            <option value="N" selected>Não</option>
                            <option value="S">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Logo (30x30)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/material/mat.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do material" id="preview-user" class="img-thumbnail" style="width: 120px; height: 120px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadMaterial" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
