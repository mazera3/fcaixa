<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_cat'][0])) {
    extract($this->Dados['dados_cat'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Categoria</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_cat']) {
                            echo "<a href='" . URLADM . "categoria/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_cat']) {
                            echo "<a href='" . URLADM . "editar-categoria/edit-categoria/$id_cat' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_cat']) {
                            echo "<a href='" . URLADM . "apagar-categoria/apagar-categoria/$id_cat' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_cat']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "categoria/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_cat']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-categoria/edit-categoria/$id_cat'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_cat']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-categoria/apagar-categoria/$id_cat' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id_cat; ?></dd>

                <dt class="col-sm-3">Categoria</dt>
                <dd class="col-sm-9"><?php echo $categoria; ?></dd>

                <dt class="col-sm-3">Código</dt>
                <dd class="col-sm-9"><?php echo $cod_cat; ?></dd>

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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Categoria não encontrada!</div>";
    $UrlDestino = URLADM . 'categoria/listar';
    header("Location: $UrlDestino");
}
    