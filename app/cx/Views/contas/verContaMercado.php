<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}

if (!empty($this->Dados['dados_mer'][0])) {
    extract($this->Dados['dados_mer'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Conta Mercado</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->Dados['botao']['list_mer']) {
                            echo "<a href='" . URLADM . "conta-mercado/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                        }
                        if ($this->Dados['botao']['edit_mer']) {
                            echo "<a href='" . URLADM . "editar-conta-mercado/edit-conta/$id_mer' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                        }
                        if ($this->Dados['botao']['del_mer']) {
                            echo "<a href='" . URLADM . "apagar-conta-mercado/apagar-conta/$id_mer' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                        }
                        ?>
                    </span>
                    <div class="dropdown d-block d-md-none">
                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Ações
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar"> 
                            <?php
                            if ($this->Dados['botao']['list_mer']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "conta-mercado/listar'>Listar</a>";
                            }
                            if ($this->Dados['botao']['edit_mer']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "editar-conta-mercado/edit-conta/$id_mer'>Editar</a>";
                            }
                            if ($this->Dados['botao']['del_mer']) {
                                echo "<a class='dropdown-item' href='" . URLADM . "apagar-conta-mercado/apagar-conta/$id_mer' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";
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
                <dd class="col-sm-9"><?php echo $id_mer; ?></dd>

                <dt class="col-sm-3">Observações</dt>
                <dd class="col-sm-9"><?php echo $observacao; ?></dd>

                <dt class="col-sm-3">Valor</dt>
                <dd class="col-sm-9"><?php echo $valor; ?></dd>

                <dt class="col-sm-3">Vencimento</dt>
                <dd class="col-sm-9"><?php echo strftime('%d/%b/%Y', strtotime($vencimento)); ?></dd>

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
    $UrlDestino = URLADM . 'conta-mercado/listar';
    header("Location: $UrlDestino");
}
    