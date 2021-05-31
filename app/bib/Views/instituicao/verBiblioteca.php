<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
foreach ($this->Dados['contBiblioteca'] as $ct) {
                        extract($ct);
                    }
if (!empty($this->Dados['dados_biblioteca'][0])) {
    extract($this->Dados['dados_biblioteca'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Dados da Biblioteca</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_biblioteca']) {
                            echo "<a href='" . URLADM . "listar-biblioteca/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_biblioteca']) {
                            echo "<a href='" . URLADM . "editar-biblioteca/edit-biblioteca/$id_biblioteca' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($num_biblioteca > 1) {
                            if ($this->Dados['botao']['del_biblioteca']) {
                                echo "<a href='" . URLADM . "apagar-biblioteca/apagar-biblioteca/$id_biblioteca' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
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
                            if ($this->Dados['botao']['list_biblioteca']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "listar-biblioteca/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_biblioteca']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-biblioteca/edit-biblioteca/$id_biblioteca'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_biblioteca']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-biblioteca/apagar-biblioteca/$id_biblioteca' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
                    if (!empty($logo_biblioteca)) {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/biblioteca/" . $id_biblioteca . "/" . $logo_biblioteca . "' witdh='120' height='120'>";
                    } else {
                        echo "<img src='" . URLADM . "app/bib/assets/imagens/biblioteca/logo.jpeg' witdh='120' height='120'>";
                    }
                    ?>
                </dd>

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id_biblioteca; ?></dd>

                <dt class="col-sm-3">Biblioteca</dt>
                <dd class="col-sm-9"><?php echo '<h4>' . $nome_bib . ' </h4>'?></dd>
                
                <dt class="col-sm-3">Instituição</dt>
                <dd class="col-sm-9"><?php echo $nome_inst ?></dd> 
                
                <dt class="col-sm-3">Responsável 1</dt>
                <dd class="col-sm-9"><?php echo 'Nome: ' . $resp_bib_1 . 'Email: ' . $email_res_1 ?></dd>
                
                <dt class="col-sm-3">Responsável 2</dt>
                <dd class="col-sm-9"><?php echo 'Nome: ' . $resp_bib_2 . 'Email: ' . $email_res_2 ?></dd>

                <dt class="col-sm-3">Horário de Funcionamento</dt>
                <dd class="col-sm-9"><?php echo $horario_bib; ?></dd>
                
                <dt class="col-sm-3">Horário Especial</dt>
                <dd class="col-sm-9"><?php echo $horario_esp; ?></dd>

                <dt class="col-sm-3">Endereço</dt>
                <dd class="col-sm-9"><?php echo '<b>Endereço: </b>' . $endereco_bib. '<br/><b>Fone: </b>' . $fone_bib . '<br/><b>E-Mail: </b>' . $email_bib . '<br/><b>WhatsApp: </b>' . $whatsapp ?></dd>
                
                <dt class="col-sm-3">Tema</dt>
                <dd class="col-sm-9"><span class="badge badge-<?php echo $cor_cr ?>"><?php echo $cor_cr ?></span></dd>

                <dt class="col-sm-3">Inserido</dt>
                <dd class="col-sm-9"><?php echo date('d/M/Y', strtotime($created)); ?></dd>

                <dt class="col-sm-3">Alterado</dt>
                <dd class="col-sm-9"><?php
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Biblioteca não encontrada!</div>";
    $UrlDestino = URLADM . 'listar-biblioteca/listar';
    header("Location: $UrlDestino");
}
