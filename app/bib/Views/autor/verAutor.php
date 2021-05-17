<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_autor'][0])) {
    extract($this->Dados['dados_autor'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Autor</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_autor']) {
                            echo "<a href='" . URLADM . "autores/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_autor']) {
                            echo "<a href='" . URLADM . "editar-autor/edit-autor/$aut_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_autor']) {
                            echo "<a href='" . URLADM . "apagar-autor/apagar-autor/$aut_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_autor']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "autores/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_autor']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-autor/edit-autor/$aut_id'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_autor']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-autor/apagar-autor/$aut_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
                    if (!empty($foto_imagem)) {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/autor/" . $aut_id . "/" . $foto_imagem . "' witdh='120' height='150'>";
                    } else {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/autor/icone_autor.png' witdh='120' height='150'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $aut_id; ?></dd>

                <dt class="col-sm-3">Autor</dt>
                <dd class="col-sm-9"><?php echo $autor; ?></dd>

                <dt class="col-sm-3">E-mail</dt>
                <dd class="col-sm-9"><?php echo $email; ?></dd>   
                
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Autor não encontrado!</div>";
    $UrlDestino = URLADM . 'autores/listar';
    header("Location: $UrlDestino");
}
