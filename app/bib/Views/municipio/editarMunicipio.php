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
                <h2 class="display-4 titulo">Editar Municipio</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_mun']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-municipio/ver-municipio/' . $valorForm['mun_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="mun_id" type="hidden" value="<?php
            if (isset($valorForm['mun_id'])) {
                echo $valorForm['mun_id'];
            }
            ?>">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Municipio</label>
                        <input name="municipio" type="text" class="form-control" placeholder="Nome do municipio" value="<?php
                        if (isset($valorForm['municipio'])) {
                            echo $valorForm['municipio'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Estado</label>
                        <select name="id_uf" id="id_uf" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['uf'] as $uf) {
                                extract($uf);
                                if ($valorForm['id_uf'] == $uf_id) {
                                    echo "<option value='$uf_id' selected>$nome_uf</option>";
                                } else {
                                    echo "<option value='$uf_id'>$nome_uf</option>";
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
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/municipio/' . $valorForm['mun_id'] . '/' . $valorForm['bandeira'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/municipio/' . $valorForm['mun_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/municipio/bandeira.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem da bandeira" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditMunicipio" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
