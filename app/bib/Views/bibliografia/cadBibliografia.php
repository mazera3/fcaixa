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
                <h2 class="display-4 titulo">Cadastrar Bibliografia</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_bibliografia']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'bibliografias/listar'; ?>" class="btn btn-outline-info btn-sm">Listar Bibliografias</a>
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
                            <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Autor: Caso o autor não esteja na lista, cadastre um novo.">
                                <i class="fas fa-question-circle"></i>
                            </span>
                            <?php
                            if ($this->Dados['botao']['cad_autor_modal']) {
                                ?>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addAutorModal">
                                    Cadastrar
                                </button>
                                <?php
                            }
                            ?>
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
                            <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Editora: Caso a editora não esteja na lista, cadastre uma nova.">
                                <i class="fas fa-question-circle"></i>
                            </span>
                            <?php
                            if ($this->Dados['botao']['cad_editora_modal']) {
                                ?>
                                <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addEditoraModal">
                                    Cadastrar
                                </button>
                                <?php
                            }
                            ?>
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
                    <!-- imput -->
                    <br/>
                    <input name="CadBibliografia" type="submit" class="btn btn-warning" value="Salvar">
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                    <!-- Capa -->
                    <div class="form-group">
                        <label>Capa (180x270)</label>
                        <input name="capa_nova" type="file" onchange="previewCapa();">
                    </div>
                    <div class="form-group">
                        <?php
                        $capa_antiga = URLADM . 'app/bib/assets/imagens/bibliografia/icone_bibliografia.jpg';
                        ?>
                        <img src="<?php echo $capa_antiga; ?>" alt="Capa do Livro" id="preview-capa" class="img-thumbnail" style="width: 90px; height: 135px;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <!-- janela Modal do Autor -->
    <?php
    if ($this->Dados['botao']['cad_autor_modal']) {
        ?>
        <span class="enderecocad_1" data-enderecocad_1="<?php echo URLADM; ?>cadastrar-autor-modal/cad-autor"></span>
        <div class="modal fade addModal_1" id="addAutorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel_1">Cadastrar Autor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="msgCad_1"></span>
                        <!-- form cadastrar -->
                        <form method="POST" id="insert_form_1" enctype="multipart/form-data"> 

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
                                        foreach ($this->Dados['selectAutor']['uf'] as $uf) {
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
                                        foreach ($this->Dados['selectAutor']['pais'] as $pais) {
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
                                        $autor_antigo = URLADM . 'app/bib/assets/imagens/autor/icone_autor.png';
                                        ?>
                                        <img src="<?php echo $autor_antigo; ?>" alt="Imagem do autor" id="preview-autor" class="img-thumbnail" style="width: 120px; height: 180px;">
                                    </div>
                                </div>
                            </div>
                            <p>
                                <span class="text-danger">* </span>Campo obrigatório
                            </p>
                            <input name="CadAutor" id="CadAutor" type="submit" class="btn btn-warning" value="Salvar">
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="modal fade" id="addSucessoModal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-success text-center">Autor Cadastrado com sucesso!</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- janela Modal da Editora -->
    <?php
    if ($this->Dados['botao']['cad_editora_modal']) {
        ?>
        <span class="enderecocad_2" data-enderecocad_2="<?php echo URLADM; ?>cadastrar-editora-modal/cad-editora"></span>
        <div class="modal fade addModal_2" id="addEditoraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel_2">Cadastrar Editora</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="msgCad_2"></span>
                        <!-- form cadastrar Editora-->
                        <form method="POST" id="insert_form_2" enctype="multipart/form-data"> 

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
                                        foreach ($this->Dados['selectEditora']['uf'] as $uf) {
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
                                        foreach ($this->Dados['selectEditora']['pais'] as $pais) {
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
                                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/editora/logo_editora.png';
                                        ?>
                                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo da editora" id="preview-editora" class="img-thumbnail" style="width: 120px; height: 120px;">
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
            </div>
        </div>
        <?php
    }
    ?>
    <div class="modal fade" id="addSucessoModal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-success text-center">Editora Cadastrada com sucesso!</h2>
                </div>
            </div>
        </div>
    </div>

