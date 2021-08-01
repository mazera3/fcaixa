<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_mec'][0])) {
    extract($this->Dados['dados_mec'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Ver Conta Mecanica</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_mec']) {
                            echo "<a href='" . URLADM . "conta-mecanica/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_mec']) {
                            echo "<a href='" . URLADM . "editar-conta-mecanica/edit-conta/$id_mec' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_mec']) {
                            echo "<a href='" . URLADM . "apagar-conta-mecanica/apagar-conta/$id_mec' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_mec']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "conta-mecanica/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_mec']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-conta-mecanica/edit-conta/$id_mec'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_mec']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-conta-mecanica/apagar-conta/$id_mec' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
            <dl class="row" style="background-color: #fcfccc;">

                <dt class="col-sm-3">ID</dt>
                <dd class="col-sm-9"><?php echo $id_mec; ?></dd>

                <dt class="col-sm-3">Observações</dt>
                <dd class="col-sm-9"><?php echo $observacao; ?></dd>

                <dt class="col-sm-3">Valor</dt>
                <dd class="col-sm-9"><?php echo $valor; ?></dd>

                <dt class="col-sm-3">Vencimento</dt>
                <dd class="col-sm-9"><?php echo date('d/M/Y', strtotime($vencimento)); ?></dd>

                <dt class="col-sm-3">Mês</dt>
                <dd class="col-sm-9"><?php echo $mes .'/'. $ano; ?></dd>

                <dt class="col-sm-3">Código</dt>
                <dd class="col-sm-9"><?php 
                if(!empty($codigo)){echo $codigo;}else{echo "****************";};
                ?></dd>

                <dt class="col-sm-3">Situação</dt>
                <dd class="col-sm-9"><?php
                if($situacao == 1){echo "<span class='text-primary'>PAGO </span>";}else{echo "<span class='text-danger'>À PAGAR</span>";}
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: Conta não encontrada!</div>";
    $UrlDestino = URLADM . 'conta-mecanica/listar';
    header("Location: $UrlDestino");
}
    