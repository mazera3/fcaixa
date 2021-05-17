<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<span class="endereco" data-endereco="<?php echo URLADM; ?>"></span>
<span class="enderecoList" data-enderecoList="<?php echo URLADM; ?>carregar-usuarios-js/listar/"></span>
<span class="conteudo" data-conteudo="listar"></span>

<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Usuários</h2>
            </div>
            <?php
            if ($this->Dados['botao']['cad_usuario']) {
                ?>
                <a href="<?php echo URLADM . 'cadastrar-usuario/cad-usuario'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </button>
                    </div>
                </a>
                <?php
            }
            if ($this->Dados['botao']['cad_usuario_modal']) {
                ?>
            <span class="enderecocad" data-enderecocad="<?php echo URLADM; ?>cadastrar-usuario-modal/cad-usuario"></span>
                <div class="p-2">
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#addUsuarioModal">
                        Cadastrar Modal
                    </button>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- pesquisar -->
        <form class="form-inline" method="POST" action="">
            <div class="form-group">
                <label>Pesquisar</label>
                <input name="pesqUser" type="text" id="pesqUser" class="form-control mx-sm-3" placeholder="Nome ou email do usuário">
            </div>
        </form><hr>

        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <span id="conteudo"></span>
    </div>
</div>
<div class="modal fade" id="visulUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalhes do Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="visul_usuario"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- cadastrar modal -->
<?php
if ($this->Dados['botao']['cad_usuario_modal']) {
    ?>
<span class="enderecocad" data-enderecocad="<?php echo URLADM; ?>cadastrar-usuario-modal/cad-usuario"></span>
    <div class="modal fade addModal" id="addUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span id="msgCad"></span>
                    <form method="POST" id="insert_form" enctype="multipart/form-data"> 

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Nome</label>
                                <input name="nome" type="text" class="form-control" placeholder="Digite o nome completo" value="<?php
                                if (isset($valorForm['nome'])) {
                                    echo $valorForm['nome'];
                                }
                                ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Apelido</label>
                                <input name="apelido" type="text" class="form-control" placeholder="Como gostaria de ser chamado" value="<?php
                                if (isset($valorForm['apelido'])) {
                                    echo $valorForm['apelido'];
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label><span class="text-danger">*</span> E-mail</label>
                                <input name="email" type="text" class="form-control" placeholder="Seu melhor e-mail" value="<?php
                                if (isset($valorForm['email'])) {
                                    echo $valorForm['email'];
                                }
                                ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label><span class="text-danger">*</span> Usuário</label>
                                <input name="usuario" type="text" class="form-control" id="nome" placeholder="Digite o usuário" value="<?php
                                if (isset($valorForm['usuario'])) {
                                    echo $valorForm['usuario'];
                                }
                                ?>">
                            </div>
                            <div class="form-group col-md-3">
                                <label><span class="text-danger">*</span> Senha</label>
                                <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha com mínimo 6 caracteres" value="<?php
                                if (isset($valorForm['senha'])) {
                                    echo $valorForm['senha'];
                                }
                                ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Nível de Acesso</label>
                                <select name="adms_niveis_acesso_id" id="adms_niveis_acesso_id" class="form-control">
                                    <option value="">Selecione</option>
                                    <?php
                                    foreach ($this->Dados['select']['nivac'] as $nivac) {
                                        extract($nivac);
                                        if ($valorForm['adms_niveis_acesso_id'] == $id_nivac) {
                                            echo "<option value='$id_nivac' selected>$nome_nivac</option>";
                                        } else {
                                            echo "<option value='$id_nivac'>$nome_nivac</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label><span class="text-danger">*</span> Situação</label>
                                <select name="adms_sits_usuario_id" id="adms_sits_usuario_id" class="form-control">
                                    <option value="">Selecione</option>
                                    <?php
                                    foreach ($this->Dados['select']['sit'] as $sit) {
                                        extract($sit);
                                        if ($valorForm['adms_sits_usuario_id'] == $id_sit) {
                                            echo "<option value='$id_sit' selected>$nome_sit</option>";
                                        } else {
                                            echo "<option value='$id_sit'>$nome_sit</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">

                                <label><span class="text-danger">*</span> Foto (150x150)</label>
                                <input name="imagem_nova" type="file" onchange="previewImagem();">
                            </div>
                            <div class="form-group col-md-6">
                                <?php
                                $imagem_antiga = URLADM . 'assets/imagens/usuario/preview_img.png';
                                ?>
                                <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do Usuário" id="preview-user" class="img-thumbnail" style="width: 150px; height: 150px;">
                            </div>
                        </div>

                        <p>
                            <span class="text-danger">* </span>Campo obrigatório
                        </p>
                        <input name="CadUsuario" id="CadUsuario" type="submit" class="btn btn-warning" value="Salvar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<!-- Modal para confirmação de cadastro com sucesso -->
<div class="modal fade" id="addSucessoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Usuário cadastrado com sucesso!
            </div>
        </div>
    </div>
</div>