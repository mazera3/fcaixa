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
                <h2 class="display-4 titulo">Editar Escola</h2>
            </div>

            <?php
            if ($this->Dados['botao']['vis_escola']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'ver-escola/ver-escola/' . $valorForm['id_escola']; ?>" class="btn btn-outline-primary btn-sm">Visualizar</a>
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
            <input name="id_escola" type="hidden" value="<?php
            if (isset($valorForm['id_escola'])) {
                echo $valorForm['id_escola'];
            }
            ?>">
            <div class="form-row">
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Escola (nome)</label>
                            <input name="nome_escola" type="text" class="form-control" placeholder="Nome da Escola" value="<?php
                            if (isset($valorForm['nome_escola'])) {
                                echo $valorForm['nome_escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Sigla</label>
                            <input name="sigla_escola" type="text" class="form-control" placeholder="Sigla da Escola" value="<?php
                            if (isset($valorForm['sigla_escola'])) {
                                echo $valorForm['sigla_escola'];
                            }
                            ?>">
                            <small id="UfHelpBlock" class="form-text text-muted">
                                Ex: EEB Francisco Mazzola - EEBFM.
                            </small>
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> INEP</label>
                            <input name="inep" type="text" class="form-control" placeholder="INEP da Escola" value="<?php
                            if (isset($valorForm['inep'])) {
                                echo $valorForm['inep'];
                            }
                            ?>">
                            <small id="UfHelpBlock" class="form-text text-muted">
                                Ex: EEB Francisco Mazzola: INEP: 42083060.
                            </small>
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Horário</label>
                            <input name="horario_escola" type="text" class="form-control" placeholder="Horário da Escola" value="<?php
                            if (isset($valorForm['horario_escola'])) {
                                echo $valorForm['horario_escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Endereço</label>
                            <input name="endereco_escola" type="text" class="form-control" placeholder="Endereço da Escola" value="<?php
                            if (isset($valorForm['endereco_escola'])) {
                                echo $valorForm['endereco_escola'];
                            }
                            ?>">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Fone</label>
                            <input name="fone_escola" type="text" class="form-control" placeholder="Fone da Escola" value="<?php
                            if (isset($valorForm['fone_escola'])) {
                                echo $valorForm['fone_escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>E-mail</label>
                            <input name="email_escola" type="text" class="form-control" placeholder="Email da Escola" value="<?php
                            if (isset($valorForm['email_escola'])) {
                                echo $valorForm['email_escola'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Categoria</label>
                            <select name="categoria_escola" id="categoria_escola" class="form-control">
                                <option value="Outra" selected>Categoria</option>
                                <option value="Pública">Pública</option>
                                <option value="Privada">Privada</option>
                            </select>
                        </div>
                    </div>
                    <!-- tipo_ensino -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Tipo de Ensino</label>
                            <textarea name="tipo_ensino" class="form-control" rows="2"><?php
                                if (isset($valorForm['tipo_ensino'])) {
                                    echo $valorForm['tipo_ensino'];
                                }
                                ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Logo -->
                    <div class="form-group">
                        <input name="imagem_antiga" type="hidden" value="<?php
                        if (isset($valorForm['imagem_antiga'])) {
                            echo $valorForm['imagem_antiga'];
                        } elseif (isset($valorForm['logo_escola'])) {
                            echo $valorForm['logo_escola'];
                        }
                        ?>">
                        <label>Logo (200x200)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        if (isset($valorForm['logo_escola']) AND !empty($valorForm['logo_escola'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/escola/' . $valorForm['id_escola'] . '/' . $valorForm['logo_escola'];
                        } elseif (isset($valorForm['imagem_antiga']) AND!empty($valorForm['imagem_antiga'])) {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/escola/' . $valorForm['id_escola'] . '/' . $valorForm['imagem_antiga'];
                        } else {
                            $imagem_antiga = URLADM . 'app/bib/assets/imagens/escola/imgagem_escola.png';
                        }
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo" id="preview-user" class="img-thumbnail" style="width: 120px; height: 120px;">
                    </div>
                </div>
                <p>
                    <span class="text-danger">* </span>Campo obrigatório
                </p>
                <input name="EditEscola" type="submit" class="btn btn-warning" value="Salvar">
                </form>
            </div>
    </div>
