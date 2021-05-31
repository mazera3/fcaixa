<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
foreach ($this->Dados['contInstituicao'] as $ct) {
                        extract($ct);
                    }
if (!empty($this->Dados['dados_instituicao'][0])) {
    extract($this->Dados['dados_instituicao'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Dados da Instituicao</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_instituicao']) {
                            echo "<a href='" . URLADM . "instituicao/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_instituicao']) {
                            echo "<a href='" . URLADM . "editar-instituicao/edit-instituicao/$id_instituicao' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($num_instituicao > 1) {
                            if ($this->Dados['botao']['del_instituicao']) {
                                echo "<a href='" . URLADM . "apagar-instituicao/apagar-instituicao/$id_instituicao' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                            }
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_instituicao']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "instituicao/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_instituicao']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-instituicao/edit-instituicao/$id_instituicao'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_instituicao']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-instituicao/apagar-instituicao/$id_instituicao' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
                <dt class="col-sm-2">Logo</dt>
                <dd class="col-sm-10">                    
                    <?php
                    if (!empty($logo_instituicao)) {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/instituicao/" . $id_instituicao . "/" . $logo_instituicao . "' witdh='120' height='120'>";
                    } else {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/instituicao/imagem_instituicao.png' witdh='120' height='120'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-2">ID</dt>
                <dd class="col-sm-10"><?php echo $id_instituicao; ?></dd>

                <dt class="col-sm-2">Instituicao</dt>
                <dd class="col-sm-10"><?php echo '<h4>' . $nome_instituicao . ' - ' . $sigla_instituicao . ' </h4> <b>INEP: </b>' . $inep . ' - ' . $categoria_instituicao; ?></dd>

                <dt class="col-sm-2">Horário</dt>
                <dd class="col-sm-10"><?php echo $horario_instituicao; ?></dd>

                <dt class="col-sm-2">Endereço</dt>
                <dd class="col-sm-10"><?php echo '<b>Endereço: </b>' . $endereco_instituicao . ' - <b>Fone: </b>' . $fone_instituicao . ' - <b>E-Mail: </b>' . $email_instituicao; ?></dd>
                <dt class="col-sm-2">Tipo de Ensino</dt>
                <dd class="col-sm-10"><?php echo $tipo_ensino; ?></dd>

                <dt class="col-sm-2">Inserido</dt>
                <dd class="col-sm-10"><?php echo date('d/M/Y', strtotime($created)); ?></dd>

                <dt class="col-sm-2">Alterado</dt>
                <dd class="col-sm-10"><?php
                    if (!empty($modified)) {
                        echo date('d/M/Y', strtotime($modified));
                    }
                    ?>
                </dd>
            </dl>


        </div>
    </div>
    <?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Instituicao não encontrada!</div>";
    $UrlDestino = URLADM . 'instituicao/listar';
    header("Location: $UrlDestino");
}
