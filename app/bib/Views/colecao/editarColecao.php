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
                <h2 class="display-4 titulo">Editar Colecao</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_mat']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-colecao/ver-colecao/' . $valorForm['col_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="col_id" type="hidden" value="<?php
            if (isset($valorForm['col_id'])) {
                echo $valorForm['col_id'];
            }
            ?>">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Colecao</label>
                        <input name="descricao" type="text" class="form-control" placeholder="Descrição do Colecao" value="<?php
                        if (isset($valorForm['descricao'])) {
                            echo $valorForm['descricao'];
                        }
                        ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Flag</label>
                            <select name="flag" id="flag" class="form-control">
                                <option value='N' selected>Não</option>
                                <option value='S'>Sim</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Retorno (dias)</label>
                            <input name="dias_retorno" type="text" class="form-control" placeholder="dias de retorno" value="<?php
                            if (isset($valorForm['dias_retorno'])) {
                                echo $valorForm['dias_retorno'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Taxa diária (₵/dia)</label>
                            <input name="taxa_diaria_atraso" type="text" class="form-control" placeholder="Taxa/dia por atraso (centavos)" value="<?php
                            if (isset($valorForm['taxa_diaria_atraso'])) {
                                echo $valorForm['taxa_diaria_atraso'];
                            }
                            ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['logo_imagem'])) {
                            echo $valorForm['logo_imagem'];
                        }
                        ?>">
                        <label>Logo (120x120)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['logo_imagem']) AND!empty($valorForm['logo_imagem'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/colecao/' . $valorForm['col_id'] . '/' . $valorForm['logo_imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/colecao/' . $valorForm['col_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/colecao/preview_img.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo" id="preview-user" class="img-thumbnail" style="width: 120px; height: 120px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditColecao" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
