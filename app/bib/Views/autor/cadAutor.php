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
                <h2 class="display-4 titulo">Cadastrar Autor</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_aut']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'autores/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                <!-- Autor -->
                <div class="col-md-6">
                    <label><span class="text-danger">*</span> Autor (nome completo)</label>
                    <input name="autor" type="text" class="form-control" placeholder="Nome do Autor" value="<?php
                    if (isset($valorForm['autor'])) {
                        echo $valorForm['autor'];
                    }
                    ?>">
                    <!-- Email -->
                    <label>Email</label>
                    <input name="email" type="text" class="form-control" placeholder="Email do Autor" value="<?php
                    if (isset($valorForm['email'])) {
                        echo $valorForm['email'];
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
                <div class="col-md-6">
                    <!-- Logo -->
                    <div class="form-group">
                        <label><span class="text-danger"></span> Foto (120x180)</label>
                        <input name="foto_nova" type="file" onchange="previewAutor();">
                    </div>
                    <div class="form-group">
                        <?php
                        $foto_antiga = URLADM . 'app/bib/assets/imagens/autor/icone_autor.png';
                        ?>
                        <img src="<?php echo $foto_antiga; ?>" alt="Imagem do autor" id="preview-autor" class="img-thumbnail" style="width: 120px; height: 180px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadAutor" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
