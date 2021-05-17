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
                <h2 class="display-4 titulo">Editar Editora</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_edi']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-editora/ver-editora/' . $valorForm['ed_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="ed_id" type="hidden" value="<?php
            if (isset($valorForm['ed_id'])) {
                echo $valorForm['ed_id'];
            }
            ?>">
            <div class="form-row">
                <div class="col-sm-6">
                    <!-- Editora (nome) -->
                    <label><span class="text-danger">*</span> Editora</label>
                    <input name="editora" type="text" class="form-control" placeholder="Nome do editora" value="<?php
                    if (isset($valorForm['editora'])) {
                        echo $valorForm['editora'];
                    }
                    ?>">
                    <!-- Endereço -->
                    <label>Endereço</label>
                    <textarea name="endereco" class="form-control" rows="2"><?php
                        if (isset($valorForm['endereco'])) {
                            echo $valorForm['endereco'];
                        }
                        ?>
                    </textarea>
                    <!-- Estado -->
                    <label>Estado</label>
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
                    <!-- Pais -->
                    <label>Pais</label>
                    <select name="id_pais" id="id_pais" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['pais'] as $pais) {
                            extract($pais);
                            if ($valorForm['id_pais'] == $pais_id) {
                                echo "<option value='$pais_id' selected>$nome_pais</option>";
                            } else {
                                echo "<option value='$pais_id'>$nome_pais</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['logo_imagem'])) {
                            echo $valorForm['logo_imagem'];
                        }
                        ?>">

                        <label>Logo (180x180)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['logo_imagem']) AND!empty($valorForm['logo_imagem'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/editora/' . $valorForm['ed_id'] . '/' . $valorForm['logo_imagem'];
                        } elseif (isset($valorForm['imagem_antiga']) AND !empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/editora/' . $valorForm['ed_id'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/editora/logo_editora.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo" id="preview-user" class="img-thumbnail" style="width: 180px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="EditEditora" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
