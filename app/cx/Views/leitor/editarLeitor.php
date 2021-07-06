<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}

?>
<div class="container">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Leitor</h2>
            </div>
            <?php
            if ($this->Dados['botao']['vis_leitor']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-leitor/ver-leitor/' . $valorForm['leitor_id']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <hr>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="POST" action="" enctype="multipart/form-data">
            <input name="leitor_id" type="hidden" value="<?php
            if (isset($valorForm['leitor_id'])) {
                echo $valorForm['leitor_id'];
            }
            ?>">
        <div class="row">
            <div class="col-sm" id="cor_obrigatorios">
                <div class="row">
                    <!-- Classificação -->
                    <div class="col">
                        <label><span class="text-danger">⋇</span>Classificação</label>
                        <select name="classificacao_id" id="classificacao_id" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['classe'] as $classe) {
                                extract($classe);
                                if ($valorForm['classificacao_id'] == $clas_id) {
                                    echo "<option value='$clas_id' selected>$classificacao</option>";
                                } else {
                                    echo "<option value='$clas_id'>$classificacao</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Situação -->
                    <div class="col">
                        <label><span class="text-danger">⋇</span> Situação do Leitor</label>
                        <select name="sits_leitor_id" id="sits_leitor_id" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['stl'] as $stl) {
                                extract($stl);
                                if ($valorForm['sits_leitor_id'] == $id) {
                                    echo "<option value='$id' selected>$nome</option>";
                                } else {
                                    echo "<option value='$id'>$nome</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <!-- Nome -->
                        <label><span class="text-danger">⋇</span> Nome</label>
                        <input name="primeiro_nome" type="text" class="form-control" placeholder="Digite o primeiro nome" value="<?php
                        if (isset($valorForm['primeiro_nome'])) {
                            echo $valorForm['primeiro_nome'];
                        }
                        ?>">
                    </div>
                    <div class="col">
                        <!-- Sobrenome -->
                        <label><span class="text-danger">⋇</span> Sobrenome</label>
                        <input name="ultimo_nome" type="text" class="form-control" placeholder="Digite o sobrenome" value="<?php
                        if (isset($valorForm['ultimo_nome'])) {
                            echo $valorForm['ultimo_nome'];
                        }
                        ?>">
                    </div>
                </div>

                <!-- Matricula: cod_barras_leitor -->
                <div class="form-group">
                    <label><span class="text-danger">⋇</span> Matricula</label>
                    <input name="cod_barras_leitor" type="text" class="form-control" placeholder="Matricula" value="<?php
                    if (isset($valorForm['cod_barras_leitor'])) {
                        echo $valorForm['cod_barras_leitor'];
                    }
                    ?>"> 
                </div>

            </div>
            <div class="col-sm">

                <div class="row">
                    <!-- Municipio -->
                    <div class="col">
                        <label>Municipio</label>
                        <span tabindex="0" data-toggle="tooltip" data-placement="top" data-html="true" title="Municipio: Caso o municipio não esteja na lista, <a href='<?php echo URLADM . 'cadastrar-municipio/cad-municipio' ;?>' target='_blank'>cadastre um novo aqui</a>">
                            <i class="fas fa-question-circle"></i>
                        </span>
                        <select name="id_mun" id="id_mun" class="form-control">
                            <option value="">Selecione</option>
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
                    <!-- Bairro -->
                    <div class="col">
                        <label>Bairro</label>
                        <select name="bairro_id" id="bairro" class="form-control">
                            <option value="">Selecione</option>
                            <?php
                            foreach ($this->Dados['select']['bairro'] as $bairro) {
                                extract($bairro);
                                if ($valorForm['bairro_id'] == $br_id) {
                                    echo "<option value='$br_id' selected>$bairro</option>";
                                } else {
                                    echo "<option value='$br_id'>$bairro</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <!-- Fone -->
                    <div class="col">
                        <label><span class="text-danger"></span> Fone</label>
                        <input name="fone" type="text" class="form-control" placeholder="Fone" value="<?php
                        if (isset($valorForm['fone'])) {
                            echo $valorForm['fone'];
                        }
                        ?>">
                    </div>
                    <!-- Celular -->
                    <div class="col">
                        <label><span class="text-danger"></span> Celular</label>
                        <input name="celular" type="text" class="form-control" placeholder="Celular" value="<?php
                        if (isset($valorForm['celular'])) {
                            echo $valorForm['celular'];
                        }
                        ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Endereço -->
                        <div class="form-group">
                            <label>Endereço</label>
                            <textarea name="endereco" class="form-control" rows="2"><?php
                                if (isset($valorForm['endereco'])) {
                                    echo $valorForm['endereco'];
                                }
                                ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col">
                        <!-- Email -->
                        <label>E-Mail</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?php
                        if (isset($valorForm['email'])) {
                            echo $valorForm['email'];
                        }
                        ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <!-- Foto -->
                <div class="form-row">
                <div class="form-group col-md-6">
                    <input name="imagem_antiga" type="hidden" value="<?php
                    if (isset($valorForm['imagem_antiga'])) {
                        echo $valorForm['imagem_antiga'];
                    } elseif (isset($valorForm['foto_leitor'])) {
                        echo $valorForm['foto_leitor'];
                    }
                    ?>">

                    <label>Foto (180x270)</label>
                    <input name="imagem_nova" type="file" onchange="previewImagem();">
                </div>
                <div class="form-group col-md-6">
                    <?php
                    if (isset($valorForm['foto_leitor']) AND ! empty($valorForm['foto_leitor'])) {
                        $imagem_antiga = URLADM . 'app/cx/assets/imagens/leitor/' . $valorForm['leitor_id'] . '/' . $valorForm['foto_leitor'];
                    } elseif (isset($valorForm['imagem_antiga']) AND ! empty($valorForm['imagem_antiga'])) {
                        $imagem_antiga = URLADM . 'app/cx/assets/imagens/leitor/' . $valorForm['leitor_id'] . '/' . $valorForm['imagem_antiga'];
                    } else {
                        $imagem_antiga = URLADM . 'app/cx/assets/imagens/leitor/foto_leitor.png';
                    }
                    ?>
                    <img src="<?php echo $imagem_antiga; ?>" alt="Foto do leitor" id="preview-user" class="img-thumbnail" style="width: 180px; height: 270px;">
                </div>
            </div>
                <input name="EditLeitor" type="submit" class="btn btn-warning" value="Salvar">
            </div>
        </div>
    </form>
    <p>
        <span class="text-danger">⋇ Campo obrigatório</span>
    </p>
</div>