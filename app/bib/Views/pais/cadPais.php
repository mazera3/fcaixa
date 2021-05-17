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
                <h2 class="display-4 titulo">Cadastrar País</h2>
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

            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label><span class="text-danger">*</span> País (nome)</label>
                            <input name="nome_pais" type="text" class="form-control" placeholder="Nome do País" value="<?php
                            if (isset($valorForm['nome_pais'])) {
                                echo $valorForm['nome_pais'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Sigla</label>
                            <input name="sigla" type="text" class="form-control" placeholder="Sigla do País" value="<?php
                            if (isset($valorForm['sigla'])) {
                                echo $valorForm['sigla'];
                            }
                            ?>">
                            <small id="UfHelpBlock" class="form-text text-muted">
                                Ex: Brasil - BR; Estados Unidos - USA.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Logo (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/pais/preview_img.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Bandeira" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadPais" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
