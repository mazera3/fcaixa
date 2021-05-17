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
                <h2 class="display-4 titulo">Cadastrar Editora</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_ed']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'editoras/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                    <!-- Editora (nome) -->

                    <label><span class="text-danger">*</span> Editora (nome)</label>
                    <input name="editora" type="text" class="form-control" placeholder="Nome da Editora" value="<?php
                    if (isset($valorForm['editora'])) {
                        echo $valorForm['editora'];
                    }
                    ?>">

                    <!-- Endereço -->

                    <label>Endereço</label>
                    <textarea name="endereco" class="form-control" rows="1"><?php
                        if (isset($valorForm['endereco'])) {
                            echo $valorForm['endereco'];
                        }
                        ?>
                    </textarea>

                    <!-- Estado -->

                    <label>Estado</label>
                    <select name="id_uf" id="id_uf" class="form-control">
                        <option value="1">Selecione</option>
                        <?php
                        foreach ($this->Dados['select']['uf'] as $uf) {
                            extract($uf);
                            if ($valorForm['id_uf'] == $uf_id) {
                                echo "<option value='$uf_id' selected>$nome</option>";
                            } else {
                                echo "<option value='$uf_id'>$nome</option>";
                            }
                        }
                        ?>
                    </select>
                    <!-- Pais -->
                    <label>Pais</label>
                    <select name="id_pais" id="id_pais" class="form-control">
                        <option value="1">Selecione</option>
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
                        <label><span class="text-danger"></span> Logo (120x120)</label>
                        <input name="editora_nova" type="file" onchange="previewEditora();">
                    </div>
                    <div class="form-group">
                        <?php
                        $editora_antiga = URLADM . 'app/bib/assets/imagens/editora/logo_editora.png';
                        ?>
                        <img src="<?php echo $editora_antiga; ?>" alt="Logo da editora" id="preview-editora" class="img-thumbnail" style="width: 120px; height: 120px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadEd" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
