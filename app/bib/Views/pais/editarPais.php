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
                <h2 class="display-4 titulo">Editar Pais</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_pais']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-pais/ver-pais/' . $valorForm['pais_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="pais_id" type="hidden" value="<?php
            if (isset($valorForm['pais_id'])) {
                echo $valorForm['pais_id'];
            }
            ?>">
            <div class="form-row">
                <!-- Nome do País -->
                <div class="col-md-6">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Pais (nome)</label>
                            <input name="nome_pais" type="text" class="form-control" placeholder="Nome do Pais" value="<?php
                            if (isset($valorForm['nome_pais'])) {
                                echo $valorForm['nome_pais'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <!-- Sigla do estado -->
                            <label><span class="text-danger">*</span> Sigla</label>
                            <input name="sigla" type="text" class="form-control" placeholder="Sigla do Pais" value="<?php
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
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['bandeira'])) {
                            echo $valorForm['bandeira'];
                        }
                        ?>">

                        <label><span class="text-danger">*</span> Bandeira (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['bandeira']) AND!empty($valorForm['bandeira'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/pais/' . $valorForm['pais_id'] . '/' . $valorForm['bandeira'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/pais/' . $valorForm['pais_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/pais/preview_img.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem da bandeira" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditPais" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>