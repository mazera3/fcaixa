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
                <h2 class="display-4 titulo">Editar Material</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_mat']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-material/ver-material/' . $valorForm['cod_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="cod_id" type="hidden" value="<?php
            if (isset($valorForm['cod_id'])) {
                echo $valorForm['cod_id'];
            }
            ?>">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Material</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição do Material" value="<?php
                        if (isset($valorForm['descricao'])) {
                            echo $valorForm['descricao'];
                        }
                        ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label><span class="text-danger">*</span> Flag</label>
                        <select name="flag" id="flag" class="form-control">
                            <option value='N' selected>Não</option>
                            <option value='S'>Sim</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['arq_imagem'])) {
                            echo $valorForm['arq_imagem'];
                        }
                        ?>">

                        <label><span class="text-danger">*</span> Imagem (120x120)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['arq_imagem']) AND!empty($valorForm['arq_imagem'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/material/' . $valorForm['cod_id'] . '/' . $valorForm['arq_imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/material/' . $valorForm['cod_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/material/mat.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem da bandeira" id="preview-user" class="img-thumbnail" style="width: 120px; height: 120px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditMaterial" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
