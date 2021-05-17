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
                <h2 class="display-4 titulo">Editar Autor</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_aut']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-autor/ver-autor/' . $valorForm['aut_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="aut_id" type="hidden" value="<?php
            if (isset($valorForm['aut_id'])) {
                echo $valorForm['aut_id'];
            }
            ?>">
            <div class="row">
                <div class="col-sm-6">
                    <label><span class="text-danger">*</span> Autor</label>
                    <input name="autor" type="text" class="form-control" placeholder="Nome do autor" value="<?php
                    if (isset($valorForm['autor'])) {
                        echo $valorForm['autor'];
                    }
                    ?>">

                    <label>E-Mail</label>
                    <input name="email" type="text" class="form-control" placeholder="email" value="<?php
                    if (isset($valorForm['email'])) {
                        echo $valorForm['email'];
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
                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                </div>
                <div class="col-sm-6">
                    <input name="imagem_antiga" type="hidden" value="<?php
                    if (isset($valorForm['imagem_antiga'])) {
                        echo $valorForm['imagem_antiga'];
                    } elseif (isset($valorForm['foto_imagem'])) {
                        echo $valorForm['foto_imagem'];
                    }
                    ?>">

                    <label><span class="text-danger">*</span> Foto (180x270)</label>
                    <input name="imagem_nova" type="file" onchange="previewImagem();">
                    <?php
                    if (isset($valorForm['foto_imagem']) AND!empty($valorForm['foto_imagem'])) {
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/autor/' . $valorForm['aut_id'] . '/' . $valorForm['foto_imagem'];
                    } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/autor/' . $valorForm['aut_id'] . '/' . $valorForm['imagem_antiga'];
                    } else {
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/autor/foto_imagem.png';
                    }
                    ?>
                    <img src="<?php echo $imagem_antiga; ?>" alt="Foto" id="preview-user" class="img-thumbnail" style="width: 180px; height: 270px;">
                    </br>
                    <input name="EditAutor" type="submit" class="btn btn-warning" value="Salvar">
                </div>
            </div>
        </form>
    </div>
