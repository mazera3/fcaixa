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
                <h2 class="display-4 titulo">Editar Bibliografia</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_bib']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-bibliografia/ver-bibliografia/' . $valorForm['bib_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="bib_id" type="hidden" value="<?php
            if (isset($valorForm['bib_id'])) {
                echo $valorForm['bib_id'];
            }
            ?>">
            <div class="row">
                <div class="col-sm" id="cor_obrigatorios">
                    <div class="row">
                        <!-- Tipo de material -->
                        <div class="col">
                            <label><span class="text-danger">⋇</span> Tipo de material</label>
                            <select name="tipo_material_id" id="tipo_material_id" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($this->Dados['select']['mat'] as $mat) {
                                    extract($mat);
                                    if ($valorForm['tipo_material_id'] == $cod_id) {
                                        echo "<option value='$cod_id' selected>$descricao_mat</option>";
                                    } else {
                                        echo "<option value='$cod_id'>$descricao_mat</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Coleção -->
                        <div class="col">
                            <label><span class="text-danger">⋇</span> Coleção</label>
                            <select name="colecao_id" id="colecao_id" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($this->Dados['select']['col'] as $c) {
                                    extract($c);
                                    if ($valorForm['colecao_id'] == $col_id) {
                                        echo "<option value='$col_id' selected>$descricao_col</option>";
                                    } else {
                                        echo "<option value='$col_id'>$descricao_col</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Titulo -->
                            <label><span class="text-danger">⋇</span> Título</label>
                            <input name="titulo" type="text" class="form-control" placeholder="Título principal" value="<?php
                            if (isset($valorForm['titulo'])) {
                                echo $valorForm['titulo'];
                            }
                            ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Autor -->
                            <label><span class="text-danger">⋇</span> Autor Principal</label>
                            <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Autor: Caso o autor não esteja na lista, cadastre um novo.</a>">
                                <i class="fas fa-question-circle"></i>
                            </span>
                            <select name="autor_id" id="autor_id" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($this->Dados['select']['aut'] as $aut) {
                                    extract($aut);
                                    if ($valorForm['autor_id'] == $aut_id) {
                                        echo "<option value='$aut_id' selected>$autor</option>";
                                    } else {
                                        echo "<option value='$aut_id'>$autor</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <!-- Editora -->
                            <label><span class="text-danger">⋇</span> Editora</label>
                            <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Editora: Caso a editora não esteja na lista, cadastre uma nova.</a>">
                                <i class="fas fa-question-circle"></i>
                            </span>
                            <select name="editora_id" id="editora_id" class="form-control">
                                <option value="">Selecione</option>
                                <?php
                                foreach ($this->Dados['select']['ed'] as $ed) {
                                    extract($ed);
                                    if ($valorForm['editora_id'] == $ed_id) {
                                        echo "<option value='$ed_id' selected>$editora</option>";
                                    } else {
                                        echo "<option value='$ed_id'>$editora</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br/><br/>
                    <p>
                        <span class="text-danger">⋇ Campo obrigatório</span>
                    </p>
                </div>
                <div class="col-sm">
                    <div class="row">
                        <div class="col">
                            <!-- Subtitulo -->
                            <label>Subtítulo</label>
                            <input name="sub_titulo" type="text" class="form-control" placeholder="Subtítulo" value="<?php
                            if (isset($valorForm['sub_titulo'])) {
                                echo $valorForm['sub_titulo'];
                            }
                            ?>">
                        </div>
                        <div class="col">
                            <!-- chamada -->
                            <label>Chamada (prateleira)</label>
                            <input name="chamada" type="text" class="form-control" placeholder="número de chamada" value="<?php
                            if (isset($valorForm['chamada'])) {
                                echo $valorForm['chamada'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- isbn -->
                            <label>isbn</label>
                            <input name="isbn" type="text" class="form-control" placeholder="isbn" value="<?php
                            if (isset($valorForm['isbn'])) {
                                echo $valorForm['isbn'];
                            }
                            ?>">
                        </div>
                        <div class="col">
                            <!-- Ano -->
                            <label>Ano</label>
                            <input name="ano" type="text" class="form-control" placeholder="Ano" value="<?php
                            if (isset($valorForm['ano'])) {
                                echo $valorForm['ano'];
                            }
                            ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- Tópico -->
                            <div class="form-group">
                                <label>Tópicos</label>
                                <textarea name="topicos" class="form-control" rows="1"><?php
                                    if (isset($valorForm['topicos'])) {
                                        echo $valorForm['topicos'];
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- situação -->
                            <label>Situação</label>
                            <select name="sit_id" id="sit_id" class="form-control">
                                <option value="1">Disponível</option>
                                <?php
                                foreach ($this->Dados['select']['sit'] as $sit) {
                                    extract($sit);
                                    if ($valorForm['sit_id'] == $id) {
                                        echo "<option value='$id' selected>$nome_sit</option>";
                                    } else {
                                        echo "<option value='$id'>$nome_sit</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <!-- Flag OPAC -->
                            <label>Exibir no OPAC?</label>
                            <select name="opac_flag" id="flag" class="form-control">
                                <option value="S" selected>Sim</option>
                                <option value="N">Não</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input name="imagem_antiga" type="hidden" value="<?php
                            if (isset($valorForm['imagem_antiga'])) {
                                echo $valorForm['imagem_antiga'];
                            } elseif (isset($valorForm['capa_imagem'])) {
                                echo $valorForm['capa_imagem'];
                            }
                            ?>">

                            <label><span class="text-danger">*</span> Capa (180x270)</label>
                            <input name="imagem_nova" type="file" onchange="previewImagem();">
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            if (isset($valorForm['capa_imagem']) AND!empty($valorForm['capa_imagem'])) {
                                $imagem_antiga = URLADM . 'app/bib/assets/imagens/bibliografia/' . $valorForm['bib_id'] . '/' . $valorForm['capa_imagem'];
                            } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                                $imagem_antiga = URLADM . 'app/bib/assets/imagens/bibliografia/' . $valorForm['bib_id'] . '/' . $valorForm['imagem_antiga'];
                            } else {
                                $imagem_antiga = URLADM . 'app/bib/assets/imagens/bibliografia/icone_bibliografia.jpg';
                            }
                            ?>
                            <img src="<?php echo $imagem_antiga; ?>" alt="Imagem da capa_imagem" id="preview-user" class="img-thumbnail" style="width: 180px; height: 270px;">
                        </div>
                    </div>

                    <p>
                        <span class="text-danger">* </span>Campo obrigatório
                    </p>
                    <input name="EditBibliografia" type="submit" class="btn btn-warning" value="Salvar">
                </div>
            </div>
        </form>
    </div>
</div>
