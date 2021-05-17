<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_col'][0])) {
    extract($this->Dados['dados_col'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Colecao</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_col']) {
                            echo "<a href='" . URLADM . "colecao/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_col']) {
                            echo "<a href='" . URLADM . "editar-colecao/edit-colecao/$col_id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_col']) {
                            echo "<a href='" . URLADM . "apagar-colecao/apagar-colecao/$col_id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_col']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "uf/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_col']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-colecao/edit-colecao/$col_id'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_col']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-colecao/apagar-colecao/$col_id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
                <dt class="col-sm-3">Logo</dt>
                <dd class="col-sm-9">                    
                    <?php
                    if (!empty($logo_imagem)) {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/colecao/" . $col_id . "/" . $logo_imagem . "' witdh='150' height='150'>";
                    } else {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/colecao/preview_img.png' witdh='150' height='150'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $col_id; ?></dd>

                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9"><?php echo $descricao; ?></dd>

                <dt class="col-sm-3">Flag</dt>
                <dd class="col-sm-9"><?php echo $flag; ?></dd>

                <dt class="col-sm-3">Retorno</dt>
                <dd class="col-sm-9"><?php echo $dias_retorno . ' Dias'; ?></dd> 

                <dt class="col-sm-3">Taxa diária por ataso (₵)</dt>
                <dd class="col-sm-9"><?php echo $taxa_diaria_atraso . ' centavos'; ?></dd>

                <dt class="col-sm-3">Contagem de bibliografia</dt>
                <dd class="col-sm-9"><?php
                    foreach ($this->Dados['qtCol'] as $qt) {
                        extract($qt);
                    }
                    $i = 0;
                    while ($i <= $num_result) {
                        if ($this->Dados['contCol'][$i][col_id] == $col_id) {
                            print_r($this->Dados['contCol'][$i][cont]);
                        }
                        $i++;
                    }
                    ?></dd>

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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Coleção não encontrada!</div>";
    $UrlDestino = URLADM . 'colecao/listar';
    header("Location: $UrlDestino");
}
    