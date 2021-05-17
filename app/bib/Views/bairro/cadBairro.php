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
                <h2 class="display-4 titulo">Cadastrar Bairro</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_br']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'bairros/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
            <!-- Nome do Bairro -->
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Bairro</label>
                        <input name="bairro" type="text" class="form-control" placeholder="Nome do Bairro" value="<?php
                        if (isset($valorForm['bairro'])) {
                            echo $valorForm['bairro'];
                        }
                        ?>">
                    </div>
                    <div class="form-group">
                        <!-- Municipio -->
                        <label><span class="text-danger">*</span> Municipio</label>
                        <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Municipio: Caso o municipio não esteja na lista, <a href='<?php echo URLADM . 'cadastrar-municipio/cad-municipio'; ?>' target='_blank'>cadastre um novo aqui</a>">
                            <i class="fas fa-question-circle"></i>
                        </span>
                        <select name="id_mun" id="id_mun" class="form-control">
                            <option value="1">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['munic'] as $munic) {
                                extract($munic);
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
                    <!-- Logo Imagem -->
                    <div class="form-group">
                        <label>Imagem (270x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/bairro/logo_imagem.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Imagem" id="preview-user" class="img-thumbnail" style="width: 270px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadBairro" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
