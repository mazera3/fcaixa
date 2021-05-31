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
                <h2 class="display-4 titulo">Cadastrar Instituicao</h2>
            </div>
            <?php
            if ($this->Dados['botao']['list_instituicao']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'instituicao/listar'; ?>" class="btn btn-outline-info btn-sm">Listar</a>
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
                <div class="col-md-8">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label><span class="text-danger">*</span> Instituicao (nome)</label>
                            <input name="nome_instituicao" type="text" class="form-control" placeholder="Nome da Instituicao" value="<?php
                            if (isset($valorForm['nome_instituicao'])) {
                                echo $valorForm['nome_instituicao'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> Sigla</label>
                            <input name="sigla_instituicao" type="text" class="form-control" placeholder="Sigla da Instituicao" value="<?php
                            if (isset($valorForm['sigla_instituicao'])) {
                                echo $valorForm['sigla_instituicao'];
                            }
                            ?>">
                            <small id="UfHelpBlock" class="form-text text-muted">
                                Ex: EEB Francisco Mazzola - EEBFM.
                            </small>
                        </div>
                        <div class="form-group col-md-3">
                            <label><span class="text-danger">*</span> INEP</label>
                            <input name="inep" type="text" class="form-control" placeholder="INEP da Instituicao" value="<?php
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
                            <input name="horario_instituicao" type="text" class="form-control" placeholder="Horário da Instituicao" value="<?php
                            if (isset($valorForm['horario_instituicao'])) {
                                echo $valorForm['horario_instituicao'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Endereço</label>
                            <input name="endereco_instituicao" type="text" class="form-control" placeholder="Endereço da Instituicao" value="<?php
                            if (isset($valorForm['endereco_instituicao'])) {
                                echo $valorForm['endereco_instituicao'];
                            }
                            ?>">
                        </div>
                    </div>
                    <!-- -->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Fone</label>
                            <input name="fone_instituicao" type="text" class="form-control" placeholder="Fone da Instituicao" value="<?php
                            if (isset($valorForm['fone_instituicao'])) {
                                echo $valorForm['fone_instituicao'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>E-mail</label>
                            <input name="email_instituicao" type="text" class="form-control" placeholder="Email da Instituicao" value="<?php
                            if (isset($valorForm['email_instituicao'])) {
                                echo $valorForm['email_instituicao'];
                            }
                            ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label><span class="text-danger">*</span> Categoria</label>
                            <select name="categoria_instituicao" id="categoria_instituicao" class="form-control">
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
                        <label><span class="text-danger"></span> Logo (200x200)</label>
                        <input name="imagem_nova" type="file" onchange="previewImagem();">
                    </div>
                    <div class="form-group">
                        <?php
                        $imagem_antiga = URLADM . 'app/bib/assets/imagens/instituicao/imagem_instituicao.png';
                        ?>
                        <img src="<?php echo $imagem_antiga; ?>" alt="Logo" id="preview-user" class="img-thumbnail" style="width: 200px; height: 200px;">
                    </div>
                </div>
            </div>
            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadInstituicao" type="submit" class="btn btn-warning" value="Salvar">
        </form>
    </div>
</div>
