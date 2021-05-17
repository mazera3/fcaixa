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
                <h2 class="display-4 titulo">Cadastrar Coleção</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_col']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'colecao/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                        <label><span class="text-danger">*</span> Coleção (Descricao)</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição da coleção" value="<?php
                        if (isset($valorForm['descricao'])) {
                            echo $valorForm['descricao'];
                        }
                        ?>">
                    </div>
                    <div class="row">
                        <!-- Flag -->
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Flag</label>
                            <select name="flag" id="flag" class="form-control">
                                <option value="N" selected>Não</option>
                                <option value="S">Sim</option>
                            </select>
                        </div>
                        <!-- retorno -->
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Dias de Retororno</label>
                            <input name="dias_retorno" type="number" min="0" class="form-control" placeholder="Dias" value="<?php
                            if (isset($valorForm['dias_retorno'])) {
                                echo $valorForm['dias_retorno'];
                            }
                            ?>">
                        </div>
                        <!-- taxa -->
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Taxa (₵/dia)</label>
                            <input name="taxa_diaria_atraso" type="number" min="0" class="form-control" placeholder="Taxa" value="<?php
                            if (isset($valorForm['taxa_diaria_atraso'])) {
                                echo $valorForm['taxa_diaria_atraso'];
                            }
                            ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Logo Imagem -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Logo (180x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/bairro/logo_imagem.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem" id="preview-user" class="img-thumbnail" style="width: 180px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadColecao" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
