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
                <h2 class="display-4 titulo">Editar Bairro</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_br']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-bairro/ver-bairro/' . $valorForm['br_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="br_id" type="hidden" value="<?php
            if (isset($valorForm['br_id'])) {
                echo $valorForm['br_id'];
            }
            ?>">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Bairro</label>
                        <input name="bairro" type="text" class="form-control" placeholder="Nome do bairro" value="<?php
                        if (isset($valorForm['bairro'])) {
                            echo $valorForm['bairro'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Municipio</label>
                        <select name="id_mun" id="id_mun" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['mun'] as $mun) {
                                extract($mun);
                                if ($valorForm['id_mun'] == $mun_id) {
                                    echo "<option value='$mun_id' selected>$municipio</option>";
                                } else {
                                    echo "<option value='$mun_id'>$municipio</option>";
                                }
                            }
                            ?>
                        </select>
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

                        <label><span class="text-danger">*</span> Logo (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['logo_imagem']) AND!empty($valorForm['logo_imagem'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/bairro/' . $valorForm['br_id'] . '/' . $valorForm['logo_imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/bairro/' . $valorForm['br_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/bairro/bandeira.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo de Imagem " id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditBairro" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>