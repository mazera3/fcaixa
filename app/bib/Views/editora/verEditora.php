<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_editora'][0])) {
    extract($this->Dados['dados_editora'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Editora</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_editora']) {
                            echo "<a href='" . URLADM . "editoras/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_editora']) {
                            echo "<a href='" . URLADM . "editar-editora/edit-editora/$ed_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_editora']) {
                            echo "<a href='" . URLADM . "apagar-editora/apagar-editora/$ed_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_editora']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editoraes/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_editora']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-editora/edit-editora/$ed_id'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_editora']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-editora/apagar-editora/$ed_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div><hr>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <dl class="row">
                <dt class="col-sm-3">Foto</dt>
                <dd class="col-sm-9">                    
                    <?php
                    if (!empty($logo_imagem)) {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/editora/" . $ed_id . "/" . $logo_imagem . "' witdh='120' height='150'>";
                    } else {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/editora/logo_editora.png' witdh='120' height='150'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $ed_id; ?></dd>

                <dt class="col-sm-3">Editora</dt>
                <dd class="col-sm-9"><?php echo $editora; ?></dd>
                
                <dt class="col-sm-3">Endereço</dt>
                <dd class="col-sm-9"><?php echo $endereco; ?></dd>
                
                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9"><?php echo $nome_uf . ' (' .$uf .')'; ?></dd>
                
                <dt class="col-sm-3">País</dt>
                <dd class="col-sm-9"><?php echo $nome_pais . ' (' .$sigla . ')'; ?></dd>

                <dt class="col-sm-3">Inserido</dt>
                <dd class="col-sm-9"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></dd>

                <dt class="col-sm-3">Alterado</dt>
                <dd class="col-sm-9"><?php
                    if (!empty($modified)) {
                        echo date('d/m/Y H:i:s', strtotime($modified));
                    }
                    ?>
                </dd>
            </dl>


        </div>
    </div>
    <?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Editora não encontrada!</div>";
    $UrlDestino = URLADM . 'editoras/listar';
    header("Location: $UrlDestino");
}
